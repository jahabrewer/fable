<div class="reviews form">
<?php echo $this->Form->create('Review');?>
	<fieldset>
		<legend><?php __('Edit Review'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('author_id', array('type' => 'hidden'));
		echo $this->Form->input('subject_id');
		echo $this->Form->input('rating');
		echo $this->Form->input('review');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
		<li><?php echo $this->Html->link(__('Delete This Absence', true), array('action' => 'delete', $this->Form->value('Review.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Review.id'))); ?></li>
