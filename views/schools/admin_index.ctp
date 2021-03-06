<script>
jQuery( function($) {
	$('table tr[data-href]').addClass('clickable').click( function() {
		window.location = $(this).attr('data-href');
	});
});
</script>
<?php $this->Html->addCrumb('Home', '/admin/'); ?>
<?php $this->Html->addCrumb('Schools', $this->Html->url(array('controller' => 'schools', 'action' => 'index'))); ?>
<div class="schools index">
	<h2><?php __('Schools');?></h2>
	<div class="buttons">
		<?php echo $this->Html->link('+ New', array('action' => 'add'), array('id' => 'add')); ?>
	</div>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('street_address');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($schools as $school):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr data-href=<?php echo $this->Html->url(array('action' => 'view', $school['School']['id'])); ?> <?php echo $class;?>>
		<td><?php echo $school['School']['name']; ?>&nbsp;</td>
		<td><?php echo $school['School']['street_address']; ?>&nbsp;</td>
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
