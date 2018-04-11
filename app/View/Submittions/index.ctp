<div class="problems index">
	<h1 style="font-size:30px;"><?php echo __('Scoreboard'); ?></h1><br>
	<table class="table table-hover">
	  <thead>
		<tr>
			<th><?php echo '#'; ?></th>
			<th><?php echo '#Team'; ?></th>
				<?php foreach ($problems as $problem): ?>
					<th>
						<?php echo h($problem['Problem']['name']); ?>
					</th>
				<?php endforeach; ?>
			
			<th><?php echo 'Time' ?></th>			
		</tr>
	  </thead>
	  <tbody>
		
			<?php foreach ($users as $user): ?>
				<tr style="<?php 
					if($user['User']['id'] == AuthComponent::user('id') ) 
						echo "background-color: rgb(156, 201, 22);"?>">
					<?php if($user['User']['role'] == 0) : ?>
						<td><?php echo h($user['User']['id']); ?>&nbsp;</td>
						<td><?php echo h($user['User']['username']); ?>&nbsp;</td>
						
						
						<?php
                                $user_Problems = array();
								$user_Submittions = array();
								$Cur = array();
								$time = strtotime($contest_starting_time);
								
								//set default values for the LIST AS EMPTY
								foreach($problems as $problem)
								{
									array_push($user_Problems, $problem['Problem']['name']);
									array_push($user_Submittions, '--');
								}
								
								foreach($submitions as $submition)
								{
									if($submition['Submittion']['user_id'] == $user['User']['id'] && !empty($submition['Submittion']['response']))
									{
										array_push($user_Problems, $submition['Problem']['name']);
										array_push($user_Submittions, $submition['Submittion']['response']);
										array_push($Cur, $submition['Submittion']['time']);	
									}
								}

								$LIST = array_combine($user_Problems,$user_Submittions);
								if(!empty($Cur))
									$time = max($Cur);

//                                dd($user_Problems);
						?> 
							
							
						<?php foreach ($problems as $problem): ?>
								<?php 
																	
									foreach ($LIST as $PROBLEM => $RESPONSE) {
											if($problem['Problem']['name'] == $PROBLEM)
												echo '<td>'. $RESPONSE . '</td>';
										}
								
								?>
						<?php endforeach; ?>
		
							<td><?php echo $this->Time->format(' h:i A' , $time); ?>&nbsp;</td>
							
						
						
					<?php endif; ?>
				</tr>
			<?php endforeach; ?>
	
	  </tbody>
	</table>
</div>

