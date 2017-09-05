<?php
App::uses('AppController', 'Controller');
/**
 * Testcases Controller
 *
 * @property Testcase $Testcase
 * @property PaginatorComponent $Paginator
 */
class TestcasesController extends AppController {

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
		//$this->Testcases->recursive = 0;
		$this->set('Testcases', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Testcase->exists($id)) {
			throw new NotFoundException(__('Invalid Testcase'));
		}
		$options = array('conditions' => array('Testcase.' . $this->Testcase->primaryKey => $id));
		$this->set('Testcase', $this->Testcase->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if(AuthComponent::user('role') == 1){
				if ($this->request->is('post')) {
					$this->Testcase->create();
					if ($this->Testcase->save($this->request->data)) {
						$this->Session->setFlash(__('The Testcase has been saved.'));
						return $this->redirect(array('action' => 'index'));
					} else {
						$this->Session->setFlash(__('The Testcase could not be saved. Please, try again.'));
					}
				}
			}else{
					$this->Session->setFlash(__('You are Not Authorized to Add Testcases'));
					return $this->redirect(array('controller'=>'Submittions','action' => 'index'));
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
		if(AuthComponent::user('role') == 1)
		{
			if (!$this->Testcase->exists($id)) {
				throw new NotFoundException(__('Invalid Testcase'));
			}
			if ($this->request->is(array('post', 'put'))) {
				if ($this->Testcase->save($this->request->data)) {
					$this->Session->setFlash(__('The Testcase has been saved.'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The Testcase could not be saved. Please, try again.'));
				}
			} else {
				$options = array('conditions' => array('Testcase.' . $this->Testcase->primaryKey => $id));
				$this->request->data = $this->Testcase->find('first', $options);
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
		$this->Testcase->id = $id;
		if (!$this->Testcase->exists()) {
			throw new NotFoundException(__('Invalid Testcase'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Testcase->delete()) {
			$this->Session->setFlash(__('The Testcase has been deleted.'));
		} else {
			$this->Session->setFlash(__('The Testcase could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
