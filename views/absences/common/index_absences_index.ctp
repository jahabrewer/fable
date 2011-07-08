<div class="absences index">
	<h2><?php __('Absences');?></h2>
	<?php echo $this->Html->link('Available', array('action' => 'index')); ?>
	<?php echo $this->Html->link('Fulfilled', array('filter' => 'fulfilled')); ?>
	<?php echo $this->Html->link('Expired', array('filter' => 'expired')); ?>
	<?php echo $this->Html->link('All', array('filter' => 'all')); ?>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('absentee_id');?></th>
			<th><?php echo $this->Paginator->sort('fulfiller_id');?></th>
			<th><?php echo $this->Paginator->sort('school_id');?></th>
			<th><?php echo $this->Paginator->sort('room');?></th>
			<th><?php echo $this->Paginator->sort('start');?></th>
			<th><?php echo $this->Paginator->sort('end');?></th>
			<th><?php echo $this->Paginator->sort('comment');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($absences as $absence):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $absence['Absence']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($absence['Absentee']['username'], array('controller' => 'users', 'action' => 'view', $absence['Absentee']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($absence['Fulfiller']['username'], array('controller' => 'users', 'action' => 'view', $absence['Fulfiller']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($absence['School']['name'], array('controller' => 'schools', 'action' => 'view', $absence['School']['id'])); ?>
		</td>
		<td><?php echo $absence['Absence']['room']; ?>&nbsp;</td>
		<td><?php echo $this->Time->niceShort($absence['Absence']['start']); ?>&nbsp;</td>
		<td><?php echo $this->Time->niceShort($absence['Absence']['end']); ?>&nbsp;</td>
		<td><?php echo $absence['Absence']['comment']; ?>&nbsp;</td>
		<td><?php echo $this->Time->niceShort($absence['Absence']['created']); ?>&nbsp;</td>
		<td><?php echo $this->Time->niceShort($absence['Absence']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php
			$user = $this->Session->read('User');
			echo $this->Html->link(__('Apply', true), array('controller' => 'absences', 'action' => 'apply', $absence['Absence']['id'])); 
			echo $this->Html->link(__('Unapply', true), array('action' => 'unapply', $absence['Absence']['id'])); 
			echo $this->Html->link(__('Release', true), array('action' => 'release', $absence['Absence']['id'])); 
			echo $this->Html->link(__('View', true), array('action' => 'view', $absence['Absence']['id'])); 
			if ($absence['Absentee']['id'] == $user['User']['id']) {
				echo $this->Html->link(__('Edit', true), array('action' => 'edit', $absence['Absence']['id'])); 
				echo $this->Html->link(__('Delete', true), array('action' => 'delete', $absence['Absence']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $absence['Absence']['id'])); 
			}
			?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
