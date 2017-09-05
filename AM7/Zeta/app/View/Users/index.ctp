<h1> Users Ranks 
<div class="problems index">
	<?php if(AuthComponent::user('role') == 1 ): ?> 
		<table>
		<tr>
			<th>id</th>
			<th>User Name</th>
			<th>Rank</th>
			<th>Submitions Number</th>
			<th>Actions</th>
		</tr>
		<?php foreach ($users as $user): ?>
			<?php
			if($user['User']['role'] == 1)
				continue;
				?>
				
			<tr>
				<td><?php echo h($user['User']['id']); ?>&nbsp;</td>
				<td><?php echo h($user['User']['username']); ?>&nbsp;</td>
				<td><?php echo h($user['User']['rank']); ?>&nbsp;</td>
				<td><?php 
					$counter = 0;
					$idd = $user['User']['id'];
					foreach($submittions as $submition)
					{
						if($submition['Submittions']['user_id'] == $idd)
						{
							$counter++;
						}
					}
					echo $counter;
					
				?>&nbsp;</td>
				<td class="actions">
					<?php echo $this->Html->link(__('View Submittions'), array('controller' => 'submittions','action' => 'account', $user['User']['id'])); ?>
					<?php echo $this->Html->link(__('Add Rank'), array('action' => 'edit', $user['User']['id'])); ?>
				</td>
			
			</tr>
			
		<?php endforeach; ?>
		</table>	
	<?php endif; ?>

</div>