<script>
jQuery( function($) {
	$('table tr[data-href]').addClass('clickable').click( function() {
		window.location = $(this).attr('data-href');
	});
});
</script>
<div class="absences index">
	<h2><?php __($type . ' Absences');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('absentee_id');?></th>
			<th><?php echo $this->Paginator->sort('fulfiller_id');?></th>
			<th><?php echo $this->Paginator->sort('school_id');?></th>
			<th><?php echo $this->Paginator->sort('room');?></th>
			<th><?php echo $this->Paginator->sort('start');?></th>
			<th><?php echo $this->Paginator->sort('end');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($absences as $absence):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr data-href=<?php echo $this->Html->url(array('action' => 'view', $absence['Absence']['id'])); echo $class; ?>>
		<td><?php echo $absence['Absence']['id']; ?>&nbsp;</td>
		<td><?php echo $absence['Absentee']['username']; ?>&nbsp;</td>
		<td><?php echo $absence['Fulfiller']['username']; ?>&nbsp;</td>
		<td><?php echo $absence['School']['name']; ?>&nbsp;</td>
		<td><?php echo $absence['Absence']['room']; ?>&nbsp;</td>
		<td><?php echo $absence['Absence']['start']; ?>&nbsp;</td>
		<td><?php echo $absence['Absence']['end']; ?>&nbsp;</td>
		<td><?php echo $absence['Absence']['created']; ?>&nbsp;</td>
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
<?php require 'views/common/nav.admin.head.ctp'; ?>
	<li><?php echo $this->Html->link('Show Available', array('filter' => 'available')); ?></li>
	<li><?php echo $this->Html->link('Show Expired', array('filter' => 'expired')); ?></li>
	<li><?php echo $this->Html->link('Show Fulfilled', array('filter' => 'fulfilled')); ?></li>
	<li><?php echo $this->Html->link('Show All', array('filter' => 'all')); ?></li>
<?php require 'views/common/nav.admin.tail.ctp'; ?>
