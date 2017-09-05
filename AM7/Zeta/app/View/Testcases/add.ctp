<div class="Testcases form">
<?php echo $this->Form->create('Testcase'); ?>
	<fieldset>
		<legend><?php echo __('Add Testcase'); ?></legend>
	<?php
		echo $this->Form->input('problem_id');
		echo $this->Form->input('input');
		echo $this->Form->input('output');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Testcases'), array('action' => 'index')); ?></li>
	</ul>
</div>
