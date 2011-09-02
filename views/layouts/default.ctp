<?php require('default.head.ctp'); ?>
<div id="header">
	<div id="title">
		<h1><?php echo $this->Html->link('Fable', array('controller' => 'absences', 'action' => 'index')); ?></h1>
	</div>
	<div id="userbox">
	<?php
		if ($this->Session->check('User')) {
			$user = $this->Session->read('User');

			// determine user type
			if ($user['User']['user_type_id'] == 1) {
				$user_type = 'Admin';
			} else if ($user['User']['user_type_id'] == 2) {
				$user_type = 'Teacher';
			} else if ($user['User']['user_type_id'] == 3) {
				$user_type = 'Substitute';
			} else {
				$user_type = 'UNKNOWN';
			}

			echo $this->Html->link(
				$user['User']['first_name'] . ' ' . $user['User']['last_name'],
				array(
					'controller' => 'users',
					'action' => 'view',
					$user['User']['id']
				)
			);
			echo " | $user_type | ";
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
	<div id="crumbtrail">
		<?php echo $this->Html->getCrumbs(' > '); ?>
	</div>
</div>
<?php require('default.tail.ctp'); ?>
