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
			
			$options = array('conditions' => array('Submittion.' . $this->Submittion->primaryKey => $id));
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
     * add method
     *
     * @return void
     */
	public function add($problem_id = null) {
		//send problems
		$this->loadModel('Problem');
		$Problems = $this->Problem->find('all');
		$this->set('problems' ,$Problems);
		
		if ($this->request->is('post')) {
            dd($this->request->data);
			$this->Submittion->create();
			
			$this->request->data['Submittion']['user_id'] = $this->Auth->user('id');
			$this->request->data['Submittion']['response'] = '--';

            if( !Dorm::compile( $this->request->data['Submittion']['solution'] ) )
            {
                $this->Session->setFlash(__('Compilation Error'));
                die("Compilation error");
                return $this->redirect(array('action' => 'index'));
            }

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
					return $this->redirect(array('action' => 'index'));
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
