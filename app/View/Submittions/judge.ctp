<?php if(AuthComponent::user('role') == 1 ): ?>
		<div class="problems index">
			<h2><?php echo __('Problems'); ?></h2>
			<table class="table table-hover">
				  <thead>
					<tr>
						<th>id</th>
						<th>Problem Name</th>
                        <th>User Name</th>
						<th>Time</th>
						<th>Response</th>
						<th>Actoins</th>
					</tr>
				  </thead>
				  <tbody>
					<?php foreach ($submittions as $submittion): ?>
                        <?php
                            $is_automatic = true;
                            $user_solution = $submittion['Submittion']['solution'];
                            if( ( strpos($user_solution, 'cin') !== false  || strpos($user_solution, 'scanf') !== false ) && strpos($user_solution, 'freopen') === false )
                            {
                                $is_automatic = false;
                            }
                        ?>

						<tr style="<?= ( $submittion['Submittion']['response'] != "--" ? "background-color:#007437;" : "" ); ?>">
							<td><?php echo h($submittion['Submittion']['id']); ?>&nbsp;</td>
							<td><?php echo h($submittion['Problem']['name']); ?>&nbsp;</td>
							<td><?php echo h($submittion['User']['username']); ?>&nbsp;</td>
							<td><?php echo h($submittion['Submittion']['time']); ?>&nbsp;</td>
							<td><?php echo h($submittion['Submittion']['response']); ?>&nbsp;</td>
							<td class="actions">
                                <a href="<?= Router::url(array('action' => 'view', $submittion['Submittion']['id'])); ?>"><?= __('View'); ?></a>
                                <a style="<?= ( $is_automatic ? "color: #e60202;" : "color: #066700;" ); ?>" href="<?= Router::url(array('action' => 'edit', $submittion['Submittion']['id'])); ?>"><?= __('Judge Manual'); ?></a>
                                <a style="<?= ( $is_automatic ? "color: #066700;" : "color: #e60202;" ); ?>" href="<?= Router::url(array('action' => 'judgeUserProblem', $submittion['Submittion']['id'])); ?>"><?= __('Judge Auto'); ?></a>
							</td>
						</tr>
						
					<?php endforeach; ?>
				  </tbody>
			</table>
		</div>
<?php endif; ?>
