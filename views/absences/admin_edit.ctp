<?php $this->Html->addCrumb('Absences', $this->Html->url(array('controller' => 'absences', 'action' => 'index'))); ?>
<?php $this->Html->addCrumb('Edit'); ?>
<div class="absences form">
<?php echo $this->Form->create('Absence');?>
	<fieldset>
		<legend><?php __('Edit Absence'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('absentee_id');
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
<?php require 'views/common/nav.admin.head.ctp'; ?>
		<li><?php echo $this->Html->link(__('Delete This Absence', true), array('action' => 'delete', $this->Form->value('Absence.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Absence.id'))); ?></li>
<?php require 'views/common/nav.admin.tail.ctp'; ?>
