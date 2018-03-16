<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Add Rank'); ?></legend>
	<?php
		echo 'User : ';
		echo  $this->Form->input('rank');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Set')); ?>
</div>