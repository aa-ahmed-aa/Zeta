<?php if(AuthComponent::user('role') == 1):?>
	<div class="submittions form">
	<?php echo $this->Form->create('Submittion'); ?>
		<fieldset>
			<legend><?php echo __('Judge Problem'); ?></legend>
		<?php

			echo nl2br(h($submittion['Submittion']['solution']));
			echo $this->element('respond');
		?>
		</fieldset>
	<?php echo $this->Form->end(__('Submit')); ?>
	</div>
<?php endif ; ?>
