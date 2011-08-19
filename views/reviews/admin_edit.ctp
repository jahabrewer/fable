<div class="reviews form">
<?php echo $this->Form->create('Review');?>
	<fieldset>
		<legend><?php __('Admin Edit Review'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('author_id', array('disabled' => true));
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

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Review.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Review.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Reviews', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Author', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
