<div class="schools form">
<?php echo $this->Form->create('School');?>
	<fieldset>
		<legend><?php __('Add School'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('street_address');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<?php require 'views/common/nav.admin.head.ctp'; ?>
<?php require 'views/common/nav.admin.tail.ctp'; ?>
