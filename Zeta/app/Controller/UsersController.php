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
}
