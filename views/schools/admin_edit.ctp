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
