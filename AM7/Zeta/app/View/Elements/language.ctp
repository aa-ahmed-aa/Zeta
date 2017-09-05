<?php	
		$l = array(
			'C++',
			'Java',
		);
		
		$list =array_combine($l,$l);
	
		
		echo $this->Form->input('language', array(
			'options' => $list,
			'empty' => '(choose language)'
		));
?>
