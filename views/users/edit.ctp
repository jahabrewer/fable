<?php $this->Html->addCrumb('Home', $this->viewVars['home_link_target']); ?>
<?php $this->Html->addCrumb('Users', $this->Html->url(array('controller' => 'users', 'action' => 'index'))); ?>
<?php $this->Html->addCrumb('Edit'); ?>
<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
		<legend><?php __('Edit User'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('username', array('disabled' => true));
		echo $this->Form->input('password');
		echo $this->Form->input('user_type_id', array('disabled' => !$allow_edit_user_type));
		echo $this->Form->input('first_name');
		echo $this->Form->input('middle_initial');
		echo $this->Form->input('last_name');
		echo $this->Form->input('primary_phone');
		echo $this->Form->input('secondary_phone');
		echo $this->Form->input('email_address');
		if ($show_education_level) echo $this->Form->input('education_level_id', array('empty' => 'Not specified'));
		if ($show_certification) echo $this->Form->input('certification');
		if ($show_school) echo $this->Form->input('school_id', array('empty' => 'None'));
		if ($show_preferred_schools) echo $this->Form->input('PreferredSchool');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
