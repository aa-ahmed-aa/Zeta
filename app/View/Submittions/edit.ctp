<?php if(AuthComponent::user('role') == 1):?>
	<div class="submittions form">
	<?php echo $this->Form->create('Submittion'); ?>
		<fieldset>
			<legend><?php echo __('Judge Problem'); ?></legend>
        <h1 style="font-size:40px;font-weight: bold;">Problem: <?= nl2br(h($submittion['Problem']['name'])); ?></h1>
            <br/><br/>
        <h1 style="font-size:30px;font-weight: bold;">UserName: </h1><?= nl2br(h($submittion['User']['username'])); ?>
            <br/><br/>
        <h1 style="font-size:20px;font-weight: bold;">Solution</h1>
            <?= nl2br(h($submittion['Submittion']['solution'])); ?>
        <?php

			echo $this->element('respond');
		?>
		</fieldset>
	<?php echo $this->Form->end(__('Submit')); ?>
	</div>
<?php endif ; ?>
