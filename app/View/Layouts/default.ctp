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

        echo $this->Html->script('jquery');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');

	?>
    <script>
        $.ajax({
            url: '<?= Router::url( [ 'controller'=>'Notes','action'=>'get_first_active_note'] ); ?>'
        }).done(function(data ) {
                var data = JSON.parse(data);
                var is_judge = <?= AuthComponent::user('role'); ?>

                if(data && is_judge != 1)
                {
                    confirm(data['Note']['question'] + '\n' + data['Note']['answer']);
                }
                else
                    return false;
            });
    </script>
    <style>
        .sys_links{
            background-color: #000000;
            text-decoration: none;
            color:#ffffff;
            padding: 9px;
            border-radius: 10px;
            font-weight: bold;
        }
        .brand_name{
            color: #ffffff;
            font-size: 30px;
            padding: 20px;
            text-shadow: 0 0 100px #ffffff;
            margin-left: 50px;
        }
        .logout{
            position: fixed;
            bottom: 0;
            width: inherit;
        }
    </style>
</head>
<body>
		<div>
			<?php if(AuthComponent::user()) :?>
				 <!-- Sidebar -->
				<div id="sidebar-wrapper">
					<ul class="sidebar-nav">
						<li class="brand_name">
								Zeta
						</li>
						<li class="sys_links">
							<?php echo $this->Html->link("Problems", array('controller' => 'problems', 'action' => 'index')); ?>
						</li>
						<li class="sys_links">
							<?php echo $this->Html->link("ScoreBoard", array('controller' => 'submittions', 'action' => 'index')); ?>
						</li>

                        <?php
                            if(AuthComponent::user('role') == 0){?>
                                <li class="sys_links">
                                    <?php
                                        echo $this->HTML->link('My Submitions',array('controller' => 'submittions', 'action' => 'account', AuthComponent::user('id')));
                            ?>
                                </li>
                            <?php }?>

                        <?php
                            if(AuthComponent::user('role') == 0){?>
                            <li class="sys_links">
                                <?= $this->Html->link("New Submittion", array('controller' => 'submittions', 'action' => 'add'));?>
                            </li>
                        <?php }?>

                        <?php
                            if(AuthComponent::user('role') == 1){?>
                                <li class="sys_links">
                                    <?= $this->Html->link("Teams Submittions", array('controller' => 'submittions', 'action' => 'judge'));?>
                                </li>
                        <?php }?>

                        <?php
                            if(AuthComponent::user('role') == 1){?>
                                <li class="sys_links">
                                    <?= $this->HTML->link('Add Problem',array('controller' => 'Problems', 'action' => 'add'));?>
                                </li>
                        <?php }?>

                        <?php
                            if(AuthComponent::user('role') == 1){?>
                                <li class="sys_links">
                                    <?= $this->HTML->link('Show Users',array('controller' => 'Users', 'action' => 'index'));?>
                                </li>
                        <?php }?>


                        <?php
                            if(AuthComponent::user('role') == 1){?>
                                <li class="sys_links">
                                    <?= $this->HTML->link('Settings',array('controller' => 'Settings', 'action' => 'edit')); ?>
                                </li>
                            <?php }?>

                        <li class="sys_links">
                            <?= $this->HTML->link('Notes',array('controller' => 'Notes', 'action' => 'index')); ?>
                        </li>

<!--                        --><?php // if(AuthComponent::user('role') == 1){ ?>
<!--                            <br/><br/><br/><br/><br/><br/><br/><br/>-->
<!--                            <br/><br/><br/><br/><br/>-->
<!--                        --><?php //} ?>

                        <?php
                        if(AuthComponent::user()){?>
                            <li class="sys_links logout">
                                <?= $this->HTML->link('Logout',array('controller' => 'users', 'action' => 'logout'));?>
                            </li>
                        <?php } else{ ?>
                            <li class="sys_links logout">
                                <?= $this->HTML->link('Login',array('controller' => 'users' , 'action' => 'login')) ; ?>
                            </li>
                        <?php }?>

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
