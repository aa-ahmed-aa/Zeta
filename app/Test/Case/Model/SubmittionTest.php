<?php
App::uses('Submittion', 'Model');

/**
 * Submittion Test Case
 *
 */
class SubmittionTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.submittion',
		'app.user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Submittion = ClassRegistry::init('Submittion');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Submittion);

		parent::tearDown();
	}

}
