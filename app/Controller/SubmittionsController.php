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
			$problems = $this->Problem->find('all');
			$this->set('problems' ,$problems);
			
			//send users
			$this->loadModel('User');
			$option = array('order' => array('User.rank' => 'desc'));
			$users = $this->User->find('all',$option);
			$this->set('users' ,$users);

            $submmitions = [];
            foreach( $users as $user )
            {
                if($user['User']['role'] == 1)
                    continue;

                $submmition = [
                    'user_id' => $user['User']['id'],
                    'user_name' => $user['User']['username'],
                    'last_submittion_time' => $this->getUserLastSubmmitionTime($user['User']['id'])
                ];

                foreach($problems as $problem)
                {
                    $submmition['problems'][] = [
                        'name' => $problem['Problem']['name'],
                        'response' => $this->getResponseForUserProblem($user['User']['id'], $problem['Problem']['id'])
                    ];
                }

                $submmitions[] = $submmition;
            }

            $this->set('submitions' ,$submmitions);

            //get the contest starting time
            $this->loadModel('Setting');
            $startTime =  $this->Setting->find('first',['conditions'=>['Setting.key'=>'start_time']])['Setting']['value'];
            $this->set('contest_starting_time' ,$startTime);
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
        $this->Submittion->recursive = 2;
        $submition = $this->Submittion->findById($submition_id);

        $correct_input_file_name = $submition['Problem']['input_file'];
        $correct_output_file_name = $submition['Problem']['output_file'];

        $Testcases = $submition['Problem']['Testcase'];

        //this is the compile and run path for this submmition
        $compile_and_run_path = WWW_ROOT.'files'.DS .$submition['User']['id'].$submition['User']['username'];
        if( !file_exists($compile_and_run_path) )
            mkdir($compile_and_run_path);

        //create instance of the runner
        $dorm = new Dorm();
        $dorm->setCompilationPath($compile_and_run_path);

        file_put_contents($dorm->getCompilationPath() . DS . $correct_input_file_name, $Testcases[0]['input_text']);

        //compile the code once this process will output the exe file for user code
        if( ! $dorm->compile($submition['Submittion']['solution']) )
        {
            //will redirect
            $this->__save_respond($submition['Submittion']['id'], "Compiler Error", true);
        }

        //loop throw the test cases and prepare the input and output files
        foreach($Testcases as $testcase)
        {
            $input_file['file_name'] = $correct_input_file_name;
            $input_file['file_content'] = $testcase['input_text'];

            $output_file['file_name'] = $correct_output_file_name;
            $output_file['file_content'] = $testcase['output_text'];

            $response = $dorm->run($input_file, $output_file);

            //if this test fail responde with wrong answer and break
            if($response == WRONG_ANSWER )
            {
                $this->__save_respond($submition['Submittion']['id'],"Wrong Answer",true);
                break;
            }

            if($response == TIME_LIMIT_EXCEEDED)
            {
                $this->__save_respond($submition['Submittion']['id'],"Time Limit Exceeded",true);
                break;
            }

        }

        //passed all the testcases then it is accepted
        $this->__save_respond($submition['Submittion']['id'],"Accepted",true);

        return $this->redirect(array('action' => 'judge'));
    }

    private function __save_respond($submmition_id ,$respond, $redirect=false)
    {
        $sub = new Submittion();
        $sub->id = $submmition_id;
        $sub->response = $respond;

        $flash_type = ( $respond == "Accepted" ? "Success" : ( $respond == "Time Limit Exceeded" ? "Time" : "Fail" ) );

        if ( $this->Submittion->save($sub) )
        {
            $this->Session->setFlash(__($respond), $flash_type);
            if( $redirect )
                return $this->redirect(array('action' => 'judge'));
        }
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
				$this->Session->setFlash(__('The submittion has been saved.'),"Success");
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
					$this->Session->setFlash(__('The Submittion has been saved.'), "Success");
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

    public function getUserLastSubmmitionTime($user_id)
    {
        $last_submmition = $this->Submittion->find('first',['order'=>['Submittion.created DESC'], 'conditions'=>['Submittion.user_id'=>$user_id]]);

        if(empty($last_submmition))
        {
            $this->loadModel('Setting');
            $startTime =  $this->Setting->find('first',['conditions'=>['Setting.key'=>'start_time']])['Setting']['value'];
            return $startTime;
        }

        return $last_submmition['Submittion']['time'];
    }

    public function getUserSubmmitions($user_id)
    {
        $submmitions = $this->Submittion->find('all',['order'=>['Submittion.created DESC'], 'conditions'=>['Submittion.user_id'=>$user_id]]);
        return $submmitions;
    }

    public function getResponseForUserProblem($user_id = null , $problem_id = null)
    {
        if($user_id == null || $problem_id == null)
            return "--";

        $submmitions = $this->Submittion->find('all', ['conditions'=>['Submittion.user_id' => $user_id, 'Submittion.problem_id' => $problem_id]]);

        if( empty( $submmitions ) )
            return '--';

        foreach($submmitions as $submmition)
        {
            if( $submmition['Submittion']['response'] == 'Accepted' )
                return $submmition['Submittion']['response'];
        }
        return $submmitions[count($submmitions)-1]['Submittion']['response'];
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
