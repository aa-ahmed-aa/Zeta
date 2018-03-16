<?php	
		$a = array(
			'Time Limit Exceed',
			'Wrong Answer',
			'Accpted',
			'Compilation Error'
		);
		
		$list =array_combine($a,$a);
	
		
		echo $this->Form->input('response', array(
			'options' => $list,
			'empty' => '(choose Problem)'
		));
?>