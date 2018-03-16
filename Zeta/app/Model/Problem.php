<?php
App::uses('AppModel', 'Model');
/**
 * Problem Model
 *
 */
class Problem extends AppModel {

    /**
     * Validation rules
     *
     * @var array
     */
	public $validate = array(
		'name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),

			),
		),
		'Description' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),

			),
		),
	);

    /**
     * @see Testcase
     */

    /**
     * @see Submittion
     */
    public $hasMany = array(
        'Testcase' => array(
            'className' => 'Testcase',
            'foreignKey' => 'problem_id',
            'dependent' => true,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'Submittion' => array(
            'className' => 'Submittion',
            'foreignKey' => 'problem_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );

}
