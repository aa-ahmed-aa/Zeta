<?php
App::uses('AppController', 'Controller');
App::uses("Dorm", 'Vendor/cppDorm');
/**
 * Submittions Controller
 *
 * @property Submittion $Submittion
 * @property PaginatorComponent $Paginator
 */
class SubmittionsController extends AppController {

    /**
     * Components
     *
     * @var array
     */
	public $components = array('Paginator');

    /**
     * index method
     *
     * @return void
     */
	public function index() {
			//send problems
			$this->loadModel('Problem');
			$Problems = $this->Problem->find('all');
			$this->set('problems' ,$Problems);
			
			//send users
			$this->loadModel('User');
			$option = array('order' => array('User.rank' => 'desc'));
			$users = $this->User->find('all',$option);
			$this->set('users' ,$users);

			//send submitions
			$submitions = $this->Submittion->find('all');
			$this->set('submitions' ,$submitions);
	}

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
	public function account($id = null) {
		if(AuthComponent::user('id') != $id && AuthComponent::user('role') != 1 )
		{
			$this->Session->setFlash(__('access Denied'));
			return $this->redirect(array('controller'=>'Submittions','action' => 'index'));
		}
		
		//send users
		$this->loadModel('User');
			
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid User'));
		}
		
		$options = array('conditions' => array('Submittion.user_id' => $id));
		$this->set('submittions', $this->Submittion->find('all', $options));
	}

    /*
     *  account for showing my submitions
     *
     */
	public function view($id = null) {
		
			if (!$this->Submittion->exists($id)) {
				throw new NotFoundException(__('Invalid submittion'));
			}
			
			$options = array('conditions' => array('Submittion.id' => $id));
			$this->set('submittion', $this->Submittion->find('first', $options));
		
	}
	
	
	/*
	*
	*	show teams submittions to be judged 
	*/
	public function judge()
	{
		if(AuthComponent::user('role') == 1) 
		{
			$this->set('submittions', $this->Submittion->find('all'));
		}
		else
		{
			$this->Session->setFlash(__('access Denied'));
			return $this->redirect(array('controller'=>'Submittions','action' => 'index'));
		}
	}

    /**
     * this will call the Dorm package to compiler user code and srun it
     * @param null $submition_id => the submition that will be judged
     */
    public function judgeUserProblem($submition_id = null)
    {
        $submition = $this->Submittion->findById($submition_id);

        //COMPILATION
        //go to user folder in files and create the input file and output files "files/compile"
        $compilation_path = WWW_ROOT . 'files' . DS . 'compile';

        $dorm = new Dorm();
        $dorm->setCompilationPath($compilation_path);

        if( ! $dorm->compile($submition['Submittion']['solution']) )
        {
            $sub = new Submittion();
            $sub->id = $submition['Submittion']['id'];
            $sub->response = "Compilation Error";

            if ( $this->Submittion->save($sub) )
            {
                $this->Session->setFlash(__('Compiled'));
                return $this->redirect(array('action' => 'judge'));
            }
            else{
//                dd($this->Submittion->validationErrors);
                $this->Session->setFlash(__('Compiled error'));
                return $this->redirect(array('action' => 'judge'));
            }
        }

        //RUN
        //call the dorm compile and return the response see Dorm::compile

        //RUNNING THE CODE

        return $this->redirect(array('action' => 'judge'));
    }
	
    /**
     * add method
     * @param $problem_id => the problem id to pass to the find element so user can submit this problem directlly
     * @return void
     */
	public function add($problem_id = null) {
		//send problems
		$this->loadModel('Problem');
		$Problems = $this->Problem->find('all');
		$this->set('problems' ,$Problems);
		
		if ($this->request->is('post')) {
			$this->Submittion->create();
			
			$this->request->data['Submittion']['user_id'] = $this->Auth->user('id');
			$this->request->data['Submittion']['response'] = '--';

			if ($this->Submittion->save($this->request->data)) {
				$this->Session->setFlash(__('The submittion has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The submittion could not be saved. Please, try again.'));
			}
		}
		$users = $this->Submittion->User->find('list');
		$this->set(compact('users'));
		$this->set('problem_id',$problem_id);
	}

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
	public function edit($id = null) {
		if(AuthComponent::user('role') == 1)
		{
			if (!$this->Submittion->exists($id)) {
				throw new NotFoundException(__('Invalid Submittion'));
			}
			if ($this->request->is(array('post', 'put'))) {
				$this->request->data['Submittion']['id'] = $id;

				if ($this->Submittion->save($this->request->data)) {
					$this->Session->setFlash(__('The Submittion has been saved.'));
					return $this->redirect(array('action' => 'judge'));
				} else {
					$this->Session->setFlash(__('The Submittion could not be saved. Please, try again.'));
				}
			} else {
				$options = array('conditions' => array('Submittion.' . $this->Submittion->primaryKey => $id));
				$this->set('submittion',$this->Submittion->find('first', $options));
				$this->request->data = $this->Submittion->find('first', $options);
			}
		}
		else
		{
			$this->Session->setFlash(__('access Denied'));
			return $this->redirect(array('controller'=>'Submittions','action' => 'index'));
		}
		
	}

	
	
	public function getMax( $array )
	{
		$max = 0;
		foreach( $array as $k => $v )
		{
			$max = max( array( $max, $v['key1'] ) );
		}
		return $max;
	}

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
	/*public function delete($id = null) {
		$this->Submittion->id = $id;
		if (!$this->Submittion->exists()) {
			throw new NotFoundException(__('Invalid submittion'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Submittion->delete()) {
			$this->Session->setFlash(__('The submittion has been deleted.'));
		} else {
			$this->Session->setFlash(__('The submittion could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}*/
}
