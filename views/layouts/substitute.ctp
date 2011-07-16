<?php require('default.head.ctp'); ?>
<div id="header">
	<script>
		$(function() {
			$(".nav-button").button();
		});
	</script>
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
			echo ' | Substitute | ';
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
	<div id="navigation">
	<?php
		echo $this->Html->link(
			'My Absences',
			array(
				'controller' => 'absences',
				'action' => 'dashboard',
			),
			array('class' => 'nav-button')
		);
		echo $this->Html->link(
			'Find Absences',
			array(
				'controller' => 'absences',
				'action' => 'index',
			),
			array('class' => 'nav-button')
		);
		echo $this->Html->link(
			'My Profile',
			array(
				'controller' => 'users',
				'action' => 'view',
				$user['User']['id']
			),
			array('class' => 'nav-button')
		);
	?>
	</div>
</div>
<?php require('default.tail.ctp'); ?>
