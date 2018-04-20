<?php if(AuthComponent::user('role') == 1 ): ?>
		<div class="problems index">
			<h2><?php echo __('Problems'); ?></h2>
			<table class="table table-hover">
				  <thead>
					<tr>
						<th>id</th>
						<th>Problem Name</th>
                        <th>User Name</th>
                        <th>Language</th>
						<th>Time</th>
						<th>Response</th>
						<th>Actoins</th>
					</tr>
				  </thead>
				  <tbody>
					<?php foreach ($submittions as $submittion): ?>
                        <?php
                            if($submittion['Submittion']['response'] == 'Accepted')
                            {
                                $color = "color:#00ff00;";
                            }else if($submittion['Submittion']['response'] == 'Wrong Answer')
                            {
                                $color = "color:#ff0000;";
                            }else if($submittion['Submittion']['response'] == 'Time Limit Exceed')
                            {
                                $color = "color:#0000ff;";
                            }else
                            {
                                $color = "color:#000000;";
                            }

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
							<td><a style="color:#dfd200;" href="<?= Router::url(['controller'=>'Submittions','action'=>'account',$submittion['User']['id']]); ?>"><?php echo h($submittion['User']['username']); ?>&nbsp;</a></td>
							<td><?php echo h($submittion['Submittion']['compiler']); ?>&nbsp;</td>
							<td><?php echo h($submittion['Submittion']['time']); ?>&nbsp;</td>
							<td style="<?= $color; ?>"><?php echo h($submittion['Submittion']['response']); ?>&nbsp;</td>
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
