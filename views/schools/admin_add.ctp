<div class="schools form">
<?php echo $this->Form->create('School');?>
	<fieldset>
		<legend><?php __('Admin Add School'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('street_address');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Schools', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Absences', true), array('controller' => 'absences', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Absence', true), array('controller' => 'absences', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>