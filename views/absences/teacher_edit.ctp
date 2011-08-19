<div class="absences form">
<?php echo $this->Form->create('Absence');?>
	<fieldset>
		<legend><?php __('Edit Absence'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('absentee_id', array('type' => 'hidden'));
		echo $this->Form->input('fulfiller_id', array('empty' => 'Not specified'));
		echo $this->Form->input('school_id');
		echo $this->Form->input('room');
		echo $this->Form->input('start');
		echo $this->Form->input('end');
		echo $this->Form->input('comment');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Absence.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Absence.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Absences', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Absentee', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Schools', true), array('controller' => 'schools', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New School', true), array('controller' => 'schools', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Applications', true), array('controller' => 'applications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Application', true), array('controller' => 'applications', 'action' => 'add')); ?> </li>
	</ul>
</div>
