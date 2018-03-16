<div class="problems view">

	<dl>
		<h1 style="font-size: 20px;"><?php echo 'Problem Name : '; ?> <?php echo h($problem['Problem']['name']); ?></h1>
		<br>
		<br>
		<h1 style="font-size: 20px;"><?php echo __('Description '); ?></h1><br>
		<dd>
			<?php echo nl2br(h($problem['Problem']['Description'])); ?>
		
		</dd>
		<br><br>
			<p class="Subre"><?php echo $this->Html->link(__('Submit'), array('controller' => 'submittions', 'action' => 'add', $problem['Problem']['id']));  ?></p>
			
         
	</dl>
</div>
