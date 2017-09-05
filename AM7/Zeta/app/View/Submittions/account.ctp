<div class="problems index">
	<h2 style="font-size:30px;"><?php echo __('My Submitions'); ?></h2><br>
	<table class="table table-hover">
	  <thead>
		<tr>
			<th><?php echo '#' ?></th>
			<th><?php echo 'Problems' ?></th>
			<th><?php echo 'Language' ?></th>
			<th><?php echo 'Response' ?></th>
			<th><?php echo 'Actions' ?></th>
		</tr>
	  </thead>
	  <tbody>
		<?php foreach ($submittions as $submittion): ?>
			<tr>
				<td><?php echo h($submittion['Submittion']['id']); ?>&nbsp;</td>
				<td><?php echo h($submittion['Submittion']['problem']); ?>&nbsp;</td>
				<td><?php echo h($submittion['Submittion']['language']); ?>&nbsp;</td>	
				<td><?php echo h($submittion['Submittion']['response']); ?>&nbsp;</td>
				
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $submittion['Submittion']['id'])); ?>
				</td>
			</tr>
		<?php endforeach; ?>
	  </tbody>
	</table>
</div>
