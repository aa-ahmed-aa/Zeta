<?php

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');
		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('simple-sidebar');
		echo $this->Html->css('style');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');

	?>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
</head>
<body>
		<div>
			<?php if(AuthComponent::user()) :?>
				 <!-- Sidebar -->
				<div id="sidebar-wrapper">
					<ul class="sidebar-nav">
						<li class="sidebar-brand">
								Zeta Project
						</li>
						<li>
							<?php echo $this->Html->link("Problems", array('controller' => 'problems', 'action' => 'index')); ?>
						</li>
						<li>
							<?php echo $this->Html->link("ScoreBoard", array('controller' => 'submittions', 'action' => 'index')); ?>
						</li>
						<li>
							<?php 
									if(AuthComponent::user('role') == 0){
										echo $this->HTML->link('My Submitions',array('controller' => 'submittions', 'action' => 'account', AuthComponent::user('id')));
									}
							?>
						</li>
						<li>
							<?php 
								if(AuthComponent::user('role') == 0){
										echo $this->Html->link("New Submittion", array('controller' => 'submittions', 'action' => 'add'));
									}
							 ?>
						</li>
						
						<li>
							<?php 
								if(AuthComponent::user('role') == 1){
										echo $this->Html->link("Teams Submittions", array('controller' => 'submittions', 'action' => 'judge'));
									}
							 ?>
						</li>
						
						<li>
							<?php 
									if(AuthComponent::user()){
										echo $this->HTML->link('Logout',array('controller' => 'users', 'action' => 'logout'));
									}else{
										echo $this->HTML->link('Login',array('controller' => 'users' , 'action' => 'login')
										) ;
									}
							?>
						</li>
						<li>
							<?php 
									if(AuthComponent::user('role') == 1){
										echo $this->HTML->link('Add Problem',array('controller' => 'Problems', 'action' => 'add'));
									}
							?>
						</li>	
						<li>
							<?php 
									if(AuthComponent::user('role') == 1){
										echo $this->HTML->link('Show Users',array('controller' => 'Users', 'action' => 'index'));
									}
							?>
						</li>

                        <li>
                            <?php
                            if(AuthComponent::user('role') == 1){
                                echo $this->HTML->link('Settings',array('controller' => 'Settings', 'action' => 'edit'));
                            }
                            ?>
                        </li>

                    </ul>
				</div>
				<!-- /#sidebar-wrapper -->
			<?php endif; ?>
		</div>
		
		<div id="page-content-wrapper">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		
</body>
</html>
