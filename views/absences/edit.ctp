<?php $this->Html->addCrumb('Home', $this->viewVars['home_link_target']); ?>
<?php $this->Html->addCrumb('Absences', $this->Html->url(array('controller' => 'absences', 'action' => 'index'))); ?>
<?php $this->Html->addCrumb('Edit'); ?>
<div class="absences form">
<?php echo $this->Form->create('Absence');?>
	<fieldset>
		<legend><?php __('Edit Absence'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('absentee_id', array('disabled' => !$allow_absentee_change));
		echo $this->Form->input('fulfiller_id', array('empty' => 'Not specified'));
		echo $this->Form->input('school_id');
		echo $this->Form->input('room', array('maxLength' => 5));
		echo $this->Form->input('start');
		echo $this->Form->input('end');
		echo $this->Form->input('comment');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
