<div class="reviews index">
	<h2><?php __('Reviews');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('author_id');?></th>
			<th><?php echo $this->Paginator->sort('subject_id');?></th>
			<th><?php echo $this->Paginator->sort('rating');?></th>
			<th><?php echo $this->Paginator->sort('review');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($reviews as $review):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $review['Review']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($review['Author']['username'], array('controller' => 'users', 'action' => 'view', $review['Author']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($review['Subject']['username'], array('controller' => 'users', 'action' => 'view', $review['Subject']['id'])); ?>
		</td>
		<td><?php echo $review['Review']['rating']; ?>&nbsp;</td>
		<td><?php echo $review['Review']['review']; ?>&nbsp;</td>
		<td><?php echo $review['Review']['created']; ?>&nbsp;</td>
		<td><?php echo $review['Review']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $review['Review']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $review['Review']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $review['Review']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $review['Review']['id'])); ?>
		</td>
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
