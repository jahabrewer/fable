<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
 		<legend><?php echo $legend; ?></legend>
		<?php
		if(isset($edit)) {
			echo $this->Form->input('id');
		}
		echo $this->Form->input('username');
		echo $this->Form->input('password');
		echo $this->Form->input('user_type_id');
		echo $this->Form->input('email_address');
		echo $this->Form->input('absence_change_notify', array('label' => 'Email me when my absences\' statuses change'));
		echo $this->Form->input('first_name');
		echo $this->Form->input('middle_initial');
		echo $this->Form->input('last_name');
		echo $this->Form->input('school_id', array('empty' => 'None', 'default' => 'None'));
		if (isset($edit)) {
			echo $this->Form->input('PreferredSchool', array('selected' => $selectedSchools));
		} else {
			echo $this->Form->input('PreferredSchool');
		}
		?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Users', true), array('action' => 'index'));?></li>
	</ul>
</div>
