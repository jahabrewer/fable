<div class="reviews form">
<?php echo $this->Form->create('Review');?>
	<fieldset>
		<legend><?php __('Add Review'); ?></legend>
	<?php
		echo $this->Form->input('author_id', array('type' => 'hidden'));
		echo $this->Form->input('subject_id');
		echo $this->Form->input('rating');
		echo $this->Form->input('review');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Reviews', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Author', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
