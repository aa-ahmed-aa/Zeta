<?php
App::uses('AppController', 'Controller');

class NotesController extends AppController {

	public function index() {
        if(AuthComponent::user('role') == 1){
            $notes = $this->Note->find('all');
            $this->set('notes', $notes);
        }else if(AuthComponent::user('role') == 0){
            $notes = $this->Note->find('all',['conditions'=>['Note.show'=>1]]);
            $this->set('notes', $notes);
        }

	}

    public function add_question()
    {
        if(AuthComponent::user('role') == 1){
            if ($this->request->is('post')) {
                $this->Note->create();
//                $this->request->data['Note']['show']=1;
                if ($this->Note->saveAll($this->request->data)) {
                    $this->Session->setFlash(__('The problem has been saved.'), 'default', array(), 'good');
                    return $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('The problem could not be saved. Please, try again.'));
                }
            }
        }else{
            $this->Session->setFlash(__('You are Not Authorized to Add Problems'));
            return $this->redirect(array('controller'=>'Submittions','action' => 'index'));
        }
    }

    public function edit_question($id)
    {
        if(AuthComponent::user('role') == 1)
        {
            if (!$this->Note->exists($id)) {
                throw new NotFoundException(__('Invalid problem'));
            }
            if ($this->request->is(array('post', 'put'))) {
                if ($this->Note->saveAll($this->request->data)) {
                    $this->Session->setFlash(__('The Note has been saved.'),"Success");
                    return $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('The Note could not be saved. Please, try again.'));
                }
            } else {
                $options = array('conditions' => array('Note.id' => $id));
                $this->request->data = $this->Note->find('first', $options);
            }
        }
        else
        {
            $this->Session->setFlash(__('access Denied'));
            return $this->redirect(array('controller'=>'Submittions','action' => 'index'));
        }
    }

    public function delete_question($id)
    {
        if(AuthComponent::user('role') == 1)
        {

            $this->Note->id = $id;

            if (!$this->Note->exists()) {
                throw new NotFoundException(__('Invalid Note'));
            }

            $this->request->allowMethod('post', 'delete');
            if ($this->Note->delete()) {
                $this->Session->setFlash(__('The note has been deleted.'));
            } else {
                $this->Session->setFlash(__('The note could not be deleted. Please, try again.'));
            }
            return $this->redirect(array('action' => 'index'));
        }
        else
        {
            $this->Session->setFlash(__('access Denied'));
            return $this->redirect(array('controller'=>'Notes','action' => 'index'));
        }
    }

    public function get_first_active_note()
    {
        $note = $this->Note->find('first',['conditions'=>['Note.always'=>1] ]  );
//        dd($note);
        die(json_encode($note));
    }
}