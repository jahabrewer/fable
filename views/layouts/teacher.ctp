<?php require('default.head.ctp'); ?>
<div id="header">
	<div id="title">
		<h1><?php echo 'Fable'; ?></h1>
	</div>
	<div id="userbox">
	<?php
		if ($this->Session->check('User')) {
			$user = $this->Session->read('User');
			echo $this->Html->link(
				$user['User']['first_name'] . ' ' . $user['User']['last_name'],
				array(
					'controller' => 'users',
					'action' => 'view',
					$user['User']['id']
				)
			);
			echo ' | Teacher | ';
			echo $this->Html->link(
				'Logout',
				array(
					'controller' => 'users',
					'action' => 'logout',
				)
			);
		}
	?>
	</div>
</div>
<?php require('default.tail.ctp'); ?>
