<script>
jQuery( function($) {
	$('table tr[data-href]').addClass('clickable').click( function() {
		window.location = $(this).attr('data-href');
	});
	$( '#dialog-adduser' ).dialog({
		autoOpen: false,
		resizable:false,
		width: 400,
		modal: true,
		buttons: {
			"Admin": function() {
				window.location = "/admin/users/add/admin";
			},
			"Teacher": function() {
				window.location = "/admin/users/add/teacher";
			},
			"Substitute": function() {
				window.location = "/admin/users/add/substitute";
			}
		}
	});
	$('#add').click( function() {
		$('#dialog-adduser').dialog('open');
		return false;
	});
});
</script>
<?php $this->Html->addCrumb('Home', '/admin/'); ?>
<?php $this->Html->addCrumb('Users', $this->Html->url(array('controller' => 'users', 'action' => 'index'))); ?>
<div class="users index">
	<h2><?php __('Users');?></h2>
	<div class="buttons">
		<?php echo $this->Html->link('+ New', '#', array('id' => 'add')); ?>
		<!--<button id="add">+ Add</button>-->
	</div>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('username');?></th>
			<th><?php echo $this->Paginator->sort('user_type_id');?></th>
			<th><?php echo $this->Paginator->sort('first_name');?></th>
			<th><?php echo $this->Paginator->sort('middle_initial');?></th>
			<th><?php echo $this->Paginator->sort('last_name');?></th>
			<th><?php echo $this->Paginator->sort('school_id');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($users as $user):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr data-href=<?php echo $this->Html->url(array('action' => 'view', $user['User']['id'])); ?> <?php echo $class;?>>
		<td><?php echo $user['User']['username']; ?>&nbsp;</td>
		<td><?php echo $user['UserType']['name']; ?>&nbsp;</td>
		<td><?php echo $user['User']['first_name']; ?>&nbsp;</td>
		<td><?php echo $user['User']['middle_initial']; ?>&nbsp;</td>
		<td><?php echo $user['User']['last_name']; ?>&nbsp;</td>
		<td><?php echo $user['School']['name']; ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div id="dialog-adduser" title="Add User">
	<p>Select a user type</p>
</div>
