<?php require('default.head.ctp'); ?>
<div id="header">
	<h1><?php echo 'Fable'; ?></h1>
	<?php
		if ($this->Session->check('User')) {
			$user = $this->Session->read('User');
			echo $user['User']['username'];
			echo $this->Html->link('Logout', array(
				'controller' => 'users',
				'action' => 'logout',
				'substitute' => false,
				'teacher' => false,
				'admin' => false,
			));
		}

	?>
</div>
<?php require('default.tail.ctp'); ?>
