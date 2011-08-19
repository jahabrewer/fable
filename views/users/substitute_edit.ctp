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
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('User.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('User.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Users', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Schools', true), array('controller' => 'schools', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New School', true), array('controller' => 'schools', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List User Types', true), array('controller' => 'user_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Type', true), array('controller' => 'user_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Education Levels', true), array('controller' => 'education_levels', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Education Level', true), array('controller' => 'education_levels', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Absences', true), array('controller' => 'absences', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Absence Made', true), array('controller' => 'absences', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Applications', true), array('controller' => 'applications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application', true), array('controller' => 'applications', 'action' => 'add')); ?> </li>
	</ul>
</div>
