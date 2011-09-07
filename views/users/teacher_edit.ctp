<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
		<legend><?php __('Edit User'); ?></legend>
	<?php
		/* should only have fields that teachers have since teachers
		 * may only edit themselves
		 */
		echo $this->Form->input('id');
		echo $this->Form->input('username', array('disabled' => true));
		echo $this->Form->input('password');
		echo $this->Form->input('user_type_id', array('disabled' => true));
		echo $this->Form->input('first_name');
		echo $this->Form->input('middle_initial');
		echo $this->Form->input('last_name');
		echo $this->Form->input('primary_phone');
		echo $this->Form->input('secondary_phone');
		echo $this->Form->input('email_address');
		echo $this->Form->input('education_level_id');
		echo $this->Form->input('absence_change_notify');
		echo $this->Form->input('school_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
