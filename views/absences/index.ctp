<script>
jQuery( function($) {
	$('table tr[data-href]').addClass('clickable').click( function() {
		window.location = $(this).attr('data-href');
	});
});
</script>
<?php $this->Html->addCrumb('Home', $this->viewVars['home_link_target']); ?>
<?php $this->Html->addCrumb('Absences', $this->Html->url(array('controller' => 'absences', 'action' => 'index'))); ?>
<div class="absences index">
	<h2><?php __($type . ' Absences');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('absentee_id');?></th>
			<th><?php echo $this->Paginator->sort('fulfiller_id');?></th>
			<th><?php echo $this->Paginator->sort('school_id');?></th>
			<th><?php echo $this->Paginator->sort('start');?></th>
			<th><?php echo $this->Paginator->sort('end');?></th>
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
		<td><?php echo $this->Time->nice($absence['Absence']['start']); ?>&nbsp;</td>
		<td><?php echo $this->Time->nice($absence['Absence']['end']); ?>&nbsp;</td>
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
<div class="actions">
	<ul>
		<li><?php if ($show_my_filter) echo $this->Html->link('Show Mine', array('filter' => 'my'), array ('id' => ($highlight_mine ? 'highlight' : ''))); ?></li>
		<li><?php echo $this->Html->link('Show Available', array('filter' => 'available'), array ('id' => ($highlight_available ? 'highlight' : ''))); ?></li>
		<li><?php echo $this->Html->link('Show Fulfilled', array('filter' => 'fulfilled'), array ('id' => ($highlight_fulfilled ? 'highlight' : ''))); ?></li>
		<li><?php echo $this->Html->link('Show Expired', array('filter' => 'expired'), array ('id' => ($highlight_expired ? 'highlight' : ''))); ?></li>
		<li><?php echo $this->Html->link('Show All', array('filter' => 'all'), array ('id' => ($highlight_all ? 'highlight' : ''))); ?></li>
	</ul>
</div>
