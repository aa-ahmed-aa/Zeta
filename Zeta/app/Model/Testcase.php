<?php
App::uses('AppModel', 'Model');
/**
 * Testcase Model
 *
 */
class Testcase extends AppModel {

    public $belongsTo = array(
        'Problem' => array(
            'className' => 'Problem',
            'foreignKey' => 'problem_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
}
