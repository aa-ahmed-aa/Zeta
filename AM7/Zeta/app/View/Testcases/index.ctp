<div class="Testcases index">
	<h2 style="font-size:30px;"><?php echo __('Testcases'); ?></h2><br>
	<table class="table table-hover">
	  <thead>
		<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('ProblemID'); ?></th>
			<th><?php echo $this->Paginator->sort('ProblemInput'); ?></th>
			<th><?php echo $this->Paginator->sort('ProblemOutput'); ?></th>
		</tr>
	  </thead>
	  <tbody>
		<?php foreach ($Testcases as $Testcase): ?>
			<tr>
				<td><?php echo h($Testcase['Testcases']['id']); ?>&nbsp;</td>
				<td><?php echo h($Testcase['Testcases']['problem_id']); ?>&nbsp;</td>
				<td><?php echo h($Testcase['Testcases']['input']); ?>&nbsp;</td>
				<td><?php echo h($Testcase['Testcases']['output']); ?>&nbsp;</td>
				
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $Testcase['Testcase']['id'])); ?>
					<?php if(AuthComponent::user('role') == 1 ) 
					{
						echo $this->Html->link(__('Edit'), array('action' => 'edit', $Testcase['Testcase']['id'])); 
						echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $Testcase['Testcase']['id']), array(), __('Are you sure you want to delete # %s?', $Testcase['Testcase']['id'])); 
					}
					?>
				</td>
			</tr>
		<?php endforeach; ?>
	  </tbody>
	</table>
</div>
