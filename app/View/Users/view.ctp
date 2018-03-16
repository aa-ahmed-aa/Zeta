<div class="users view">
<h2><?php echo __('User'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Username'); ?></dt>
		<dd>
			<?php echo h($user['User']['username']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Password'); ?></dt>
		<dd>
			<?php echo h($user['User']['password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Role'); ?></dt>
		<dd>
			<?php echo h($user['User']['role']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User'), array('action' => 'delete', $user['User']['id']), array(), __('Are you sure you want to delete # %s?', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Submittions'), array('controller' => 'submittions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Submittion'), array('controller' => 'submittions', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Submittions'); ?></h3>
	<?php if (!empty($user['Submittion'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Problem'); ?></th>
		<th><?php echo __('Time'); ?></th>
		<th><?php echo __('Response'); ?></th>
		<th><?php echo __('Solution'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['Submittion'] as $submittion): ?>
		<tr>
			<td><?php echo $submittion['id']; ?></td>
			<td><?php echo $submittion['user_id']; ?></td>
			<td><?php echo $submittion['problem']; ?></td>
			<td><?php echo $submittion['time']; ?></td>
			<td><?php echo $submittion['response']; ?></td>
			<td><?php echo $submittion['solution']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'submittions', 'action' => 'view', $submittion['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'submittions', 'action' => 'edit', $submittion['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'submittions', 'action' => 'delete', $submittion['id']), array(), __('Are you sure you want to delete # %s?', $submittion['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Submittion'), array('controller' => 'submittions', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
