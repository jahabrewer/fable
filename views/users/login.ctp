<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
 		<legend>Login</legend>
		<?php
		echo $this->Form->input('username');
		echo $this->Form->input('password');
		?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
