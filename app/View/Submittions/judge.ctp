<?php if(AuthComponent::user('role') == 1 ): ?> 
		<div class="problems index">
			<h2><?php echo __('Problems'); ?></h2>
			<table class="table table-hover">
				  <thead>
					<tr>
						<th>id</th>
						<th>Problem Name</th>
						<th>Time</th>
						<th>Response</th>
						<th>Solution</th>
					</tr>
				  </thead>
				  <tbody>
					<?php foreach ($submittions as $submittion): ?>
						
						<tr>
							<td><?php echo h($submittion['Submittion']['id']); ?>&nbsp;</td>
							<td><?php echo h($submittion['Submittion']['problem']); ?>&nbsp;</td>
							<td><?php echo h($submittion['Submittion']['time']); ?>&nbsp;</td>
							<td><?php echo h($submittion['Submittion']['response']); ?>&nbsp;</td>
							<td class="actions">
								<?php echo $this->Html->link(__('View'), array('action' => 'view', $submittion['Submittion']['id'])); ?>
								<?php echo $this->Html->link(__('Judge Problem'), array('action' => 'edit', $submittion['Submittion']['id'])); ?>
							</td>
						</tr>
						
					<?php endforeach; ?>
				  </tbody>
			</table>
		</div>
<?php endif; ?>
