<?php $this->Html->addCrumb('Home', '/admin/'); ?>
<?php $this->Html->addCrumb('Schools', $this->Html->url(array('controller' => 'schools', 'action' => 'index'))); ?>
<?php $this->Html->addCrumb('Edit'); ?>
<div class="schools form">
<?php echo $this->Form->create('School');?>
	<fieldset>
		<legend><?php __('Edit School'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('street_address');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<?php require 'views/common/nav.admin.head.ctp'; ?>
		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('School.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('School.id'))); ?></li>
<?php require 'views/common/nav.admin.tail.ctp'; ?>
