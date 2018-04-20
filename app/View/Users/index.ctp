<?php //dd($users); ?>
<div class="problems index">

    <?= $this->Html->link(__('Rank All Users'),array('controller' => 'users','action' => 'rankAllUsers' ),array('class'=>'sys_links')); ?>

    <br/>
    <br/>
    <br/>
    <br/>
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
				<td><?= h($user['User']['id']); ?>&nbsp;</td>
				<td><?= h($user['User']['username']); ?>&nbsp;</td>
				<td><?= h($user['User']['rank']); ?>&nbsp;</td>
				<td><?= count($user['Submittion']); ?>&nbsp;</td>
				<td class="actions">
					<?php echo $this->Html->link(__('View Submittions'), array('controller' => 'submittions','action' => 'account', $user['User']['id'])); ?>
					<?php echo $this->Html->link(__('Rank user'), array('action' => 'rankUser', $user['User']['id'])); ?>
				</td>
			
			</tr>
			
		<?php endforeach; ?>
		</table>	
	<?php endif; ?>

</div>