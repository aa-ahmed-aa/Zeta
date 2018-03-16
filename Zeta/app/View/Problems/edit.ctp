<div class="problems form">
<?php echo $this->Form->create('Problem'); ?>
	<fieldset>
		<legend><?php echo __('Edit Problem'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('Description');

        echo $this->Form->input('Testcase.0.input_file',array('required' => true));
        echo $this->Form->input('Testcase.0.input_text',array('type'=>'textarea','required' => true));
        echo $this->Form->input('Testcase.0.output_file',array('required' => true));
        echo $this->Form->input('Testcase.0.output_text',array('type'=>'textarea','required' => true));

	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>