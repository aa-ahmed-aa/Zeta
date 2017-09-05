<div class="Testcases view">

	<dl>
		<h1 style="font-size: 20px;"><?php echo 'Testcase Name : '; ?> <?php echo h($Testcase['Testcase']['problem_id']); ?></h1>
		<br><br>
			<p class="Subre"><?php echo $this->Html->link(__('Submit'), array('controller' => 'submittions', 'action' => 'add'));  ?></p>
			
         
	</dl>
</div>
