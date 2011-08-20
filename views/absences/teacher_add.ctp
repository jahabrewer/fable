<div class="absences form">
<?php echo $this->Form->create('Absence');?>
	<fieldset>
		<legend><?php __('Add Absence'); ?></legend>
	<?php
		echo $this->Form->input('absentee_id', array('type' => 'hidden'));
		echo $this->Form->input('fulfiller_id', array('empty' => 'Not specified'));
		echo $this->Form->input('school_id');
		echo $this->Form->input('room');
		echo $this->Form->input('start', array('interval' => 15));
		echo $this->Form->input('end', array('interval' => 15));
		echo $this->Form->input('comment');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<?php require 'views/common/nav.teacher.head.ctp'; ?>
<?php require 'views/common/nav.teacher.tail.ctp'; ?>
