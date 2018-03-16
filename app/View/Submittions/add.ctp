<div class="submittions form">
<?php echo $this->Form->create('Submittion'); ?>
	<fieldset>
		<legend><?php echo __('Add Submittion'); ?></legend>

	<?php
		
		echo $this->element('find',array('problem_id'=>$problem_id) );
		echo $this->Form->input('solution');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
