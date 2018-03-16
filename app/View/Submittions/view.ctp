	<?php 
	function Redirect($url, $permanent = false)
	{
		if (headers_sent() === false)
		{
			header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
		}
		exit();
	}

	if($submittion['Submittion']['user_id'] != AuthComponent::user('id') && AuthComponent::user('role') != 1)
	{
		$this->Session->setFlash(__('access denied'));
		Redirect('http://localhost/Zeta/submittions', false);
	}
?>

<div class="submittions view">
<h1 style="font-size: 30px;"><?php echo __('Submittion'); ?><h1><br><br>
	<dl>
		<h1 style="font-size: 20px;"><dt><?php echo __('Id'); ?></dt></h1>
		<dd>
			<?php echo $submittion['Submittion']['id']; ?>
			&nbsp;
		</dd>
		<br>
		<h1 style="font-size: 20px;"><dt><?php echo __('Problem'); ?></dt></h1>
		<dd>
			<?php echo h($submittion['Submittion']['problem']); ?>
			&nbsp;
		</dd>
		<br>
		<h1 style="font-size: 20px;"><dt><?php echo __('Time'); ?></dt></h1>
		<dd>
			<?php echo h($submittion['Submittion']['time']); ?>
			&nbsp;
		</dd>
		<br>
		<h1 style="font-size: 20px;"><dt><?php echo __('Solution'); ?></dt></h1>
		<dd>
			<code><?php echo nl2br(h($submittion['Submittion']['solution'])); ?></code>
			&nbsp;
		</dd>
		
	</dl>
</div>
