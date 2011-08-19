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
<?php require 'views/common/nav.admin.head.ctp'; ?>
<?php require 'views/common/nav.admin.tail.ctp'; ?>
