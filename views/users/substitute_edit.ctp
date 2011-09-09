<?php $this->Html->addCrumb('Home', '/substitute/'); ?>
<?php $this->Html->addCrumb('Users'); ?>
<?php $this->Html->addCrumb('Edit'); ?>
<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
		<legend><?php __('Edit User'); ?></legend>
	<?php
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
		echo $this->Form->input('education_level_id', array('empty' => 'Not specified'));
		echo $this->Form->input('certification');
		echo $this->Form->input('PreferredSchool');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
