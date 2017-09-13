<?php	
      
		$a = array();
		foreach($problems as $problem)
		{
			array_push($a, $problem['Problem']['name']);
		}
		
		$list =array_combine($a,$a);
	
		
		echo $this->Form->input('problem', array(
			'options' => $list,
			'empty' => '(choose Problem)'
		));
?>
