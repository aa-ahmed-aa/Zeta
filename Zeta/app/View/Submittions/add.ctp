<div class="submittions form">
<?php echo $this->Form->create('Submittion'); ?>
	<fieldset>
		<legend><?php echo __('Add Submittion'); ?></legend>

	<?php
		
		echo $this->element('find');
		echo $this->Form->input('solution');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Submittions'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
