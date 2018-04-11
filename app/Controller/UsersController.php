<?php
App::uses('AppController', 'Controller');
App::import('Controller','Submitions');

/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
	
	public function beforeFilter(){
		$this->Auth->allow('add');
	}
	
	public function getUsernameById($id){
		$data = $this->User->findById($id);
		return $data;
	}
	
	public function login (){
			if($this->request->is('post')){
				if($this->Auth->login()){
					return $this->redirect($this->Auth->redirect());
				}else{
					$this->Session->setFlash('Invalid username or Password');
				}
			}
	}
	
	public function logout(){
		$this->Auth->logout();
		$this->redirect('/users/login');
	}
	
	
	
	
//------------------------------------------------------------------------------------------------------------------
/**
 * index method
 *
 * @return void
 */
	public function index() {
		if(AuthComponent::user('role') == 1 ){
			$this->User->recursive = 0;
			$this->set('users', $this->Paginator->paginate());
			
			$this->loadModel('Submittions');
			$submittions = $this->Submittions->find('all');
			$this->set('submittions' ,$submittions);
		}
		else 
		{
			$this->Session->setFlash(__('access Denied'));
			return $this->redirect(array('controller'=>'Submittions','action' => 'index'));
		}
	}

  /**
   * view method
   *
   * @throws NotFoundException
   * @param string $id
   * @return void
   */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

   /**
    * add method
    *
    * @return void
    */
	public function add() {
		if ($this->request->is('post')) {
			if(AuthComponent::user('role') == 1){
					$this->User->create();
					$this->request->data['User']['password'] = AuthComponent::password($this->request->data['User']['password']);
					if ($this->User->save($this->request->data)) {
						$this->Session->setFlash(__('The user has been saved.'));
						return $this->redirect(array('action' => 'index'));
					} else {
						$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
					}
				}else{
					$this->Session->setFlash('You Are Not Authorized To Add Users');
				}
		}
	}

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
	public function edit($id = null) {
		if(AuthComponent::user('role') == 1){
			if (!$this->User->exists($id)) {
				throw new NotFoundException(__('Invalid user'));
			}
			if ($this->request->is(array('post', 'put'))) {
				$this->request->data['User']['password'] = AuthComponent::password($this->request->data['User']['password']);
				$this->request->data['User']['id'] = $id;
				
				
				if ($this->User->save($this->request->data)) {
					$this->Session->setFlash(__('The user has been saved.'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
				}
			} else {
				$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
				$this->request->data = $this->User->find('first', $options);
			}
		}
		else 
		{
			$this->Session->setFlash(__('access Denied'));
			return $this->redirect(array('controller'=>'Submittions','action' => 'index'));
		}
		
	}

    public function rankUser( $userId, $redirect = true )
    {
        //get all user submmition
        $this->User->recursive = 2;
        $userSubmmitions = $this->User->Submittion->find('all' , ['group' => array('Submittion.problem_id'),'conditions'=>['User.id'=>$userId,'Submittion.response'=>'Accepted']]);


        //current user rank
        $userRank = 0 ;

        //get start time
        $this->loadModel('Setting');
        $startTime =  $this->Setting->find('first',['conditions'=>['Setting.key'=>'start_time']])['Setting']['value'];
        $Tstart = $this->convertStringTimeToMinuts($startTime);

        //loop on submitions get the accepted problems and calc rank
        foreach($userSubmmitions as $index => $userSubmmition)
        {
            //get current submmition time in minuts
            $date = new DateTime($userSubmmition['Submittion']['time']);
            $Tsub = $this->convertStringTimeToMinuts( $date->format('H:i:s') );

            //get problem rank
            $problem_rank = $userSubmmitions[$index]['Problem']['rank'];

            //submition_rank = ( problem_rank - ( Tstart - Tsub / 60 ) )
            $submittion_rank = ( $problem_rank - intval( abs( $Tsub - $Tstart ) ) ) ;

            //get the number of wrong answers for this problem
            $wrongAnswerCount =count( $this->User->Submittion->find('all' , ['conditions'=>['User.id'=>$userId, 'Problem.id'=>$userSubmmition['Submittion']['problem_id'] ,'Submittion.response !='=>'Accepted']]) );
            $submittion_rank -= ( $wrongAnswerCount * 5 );

            //check if the rank is not less than 40% of the problem rank
            $a40P_of_rank = ( 40 * $problem_rank) /100 ;
            if( $submittion_rank < $a40P_of_rank )
            {
                $submittion_rank = $a40P_of_rank;
            }

            //add to user rank
            $userRank += $submittion_rank;
        }

        //save user rank
        $user = new User();
        $user->id = $userId;
        $user->rank = $userRank;
        if ( $this->User->save($user) )
        {
            if ( $redirect == true )
            {
                $this->Session->setFlash(__("Rank Calculated"), 'Success');
                return $this->redirect(array('action' => 'index'));
            }
        }

    }

    public function rankAllUsers()
    {
        $users = $this->User->find('all', ['conditions'=>['User.role' => 0]]);
//        dd($users);
        foreach( $users as $index => $user )
        {
            $this->rankUser($user['User']['id'], false);
        }

        $this->Session->setFlash(__("Rank Calculated"), 'Success');
        return $this->redirect(array('action' => 'index'));

    }

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('The user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

    public function convertStringTimeToMinuts( $stringTime )
    {
        $startTime = explode(':',$stringTime);
        $startTime = ($startTime[0]*60)+($startTime[1])+($startTime[2]>30?1:0);
        return $startTime;
    }
}
