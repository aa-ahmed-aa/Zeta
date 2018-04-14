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
        <table class="table table-hover">
            <thead>
            <tr>

                <th><?= __('Id'); ?></th>
                <th><?= __('Problem'); ?></th>
                <th><?= __('Compiler'); ?></th>
                <th><?= __('Time'); ?></th>

            </tr>
            </thead>
            <tbody>

            <tr style="font-weight: bold;">

                <td><?= $submittion['Submittion']['id']; ?></td>
                <td><?= $submittion['Problem']['name']; ?></td>
                <td><?= $submittion['Submittion']['compiler']; ?></td>
                <td><?= $submittion['Submittion']['time']; ?></td>

            </tr>


            </tbody>
        </table>
	<dl>

		<h1 style="font-size: 20px;"><dt><?php echo __('Solution'); ?></dt></h1>
		<dd>
			<code><?php echo nl2br(h($submittion['Submittion']['solution'])); ?></code>
			&nbsp;
		</dd>
		
	</dl>
</div>
