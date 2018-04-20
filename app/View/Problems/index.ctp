<div class="problems index">
	<h2 style="font-size:30px;"><?php echo __('Problems'); ?></h2><br>
	<table class="table table-hover">
	  <thead>
		<tr>

			<th style="font-weight: bold;font-size: 20px;"><?= __('Problem Name'); ?></th>
		</tr>
	  </thead>
	  <tbody>
		<?php foreach ($problems as $problem): ?>
			<tr>
				<td><?php echo h($problem['Problem']['name']); ?>&nbsp;</td>
				
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $problem['Problem']['id'])); ?>
					<?php if(AuthComponent::user('role') == 1 ) 
					{
						echo $this->Html->link(__('Edit'), array('action' => 'edit', $problem['Problem']['id'])); 
						echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $problem['Problem']['id']), array(), __('Are you sure you want to delete # %s?', $problem['Problem']['id'])); 
					}
					?>
				</td>
			</tr>
		<?php endforeach; ?>
	  </tbody>
	</table>
</div>
