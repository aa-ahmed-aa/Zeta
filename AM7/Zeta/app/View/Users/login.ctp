

	<div class="login-form">
				<?php echo $this->Form->create('User'); ?>
					<div class="head">
						<?php echo $this->Html->image('mem2.jpg');?>
					</div>
				<form>
					<li>
							<?php echo $this->Form->Input('username'); ?>
					</li>
					<li>
						<?php echo $this->Form->Input('password'); ?>
					</li>
					<div class="p-container">
								
								<?php 	echo $this->Form->end('Login');?>
							<div class="clear"> </div>
					</div>
				</form>
	</div>
