<?php
App::uses('AppController', 'Controller');

class SettingsController extends AppController {

    public function edit()
    {
        if($this->request->is('post'))
        {
            $data = $this->request->data;
            foreach($data as $key => $value)
            {
                $setting = $this->Setting->find('first',['conditions'=>['Setting.key'=>$key]]);
                $setting['Setting']['value'] = $value;
                $this->Setting->save($setting);
            }

            return $this->redirect(array('action' => 'edit'));
        }

        $settings = $this->Setting->find('all');
        $this->set('settings',$settings);
    }

}
