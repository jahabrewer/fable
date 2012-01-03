<?php $this->Html->addCrumb('Home', $this->viewVars['home_link_target']); ?>
<?php $this->Html->addCrumb('Change Password'); ?>
<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
		<legend><?php __('Change Password'); ?></legend>
	<?php
		if (!$hide_username_field) echo $this->Form->input('id', array(
			'selected' => $viewer_id,
			'empty' => false, 
			'label' => 'Username',
			'options' => $user_list,
			'type' => 'select',
		));
		if ($hide_username_field) echo $this->Form->input('password', array(
			'label' => 'Old Password',
		));
		echo $this->Form->input('new_password', array(
			'type' => 'password',
			'label' => 'New Password',
		));
		echo $this->Form->input('confirm_password', array(
			'type' => 'password',
			'label' => 'Confirm New Password',
		));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
