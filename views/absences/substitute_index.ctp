<?php 
$this->Paginator->options(array(
	'update' => '#container',
	'evalScripts' => true,
));
?>
<script>
	$(function() {
		$(".button").button();
		$("#filter-buttons").buttonset();
		$(".disabled-button").button().button("disable");
		$("#button-<?php echo $filter; ?>").addClass("ui-priority-primary");
	});
</script>

<div id="filter-buttons">
<?php
echo $this->Html->link(
	'Available',
	array(
		'action' => 'index',
		'available'
	),
	array(
		'class' => 'button',
		'id' => 'button-available'
	)
);
echo $this->Html->link(
	'Fulfilled',
	array(
		'action' => 'index',
		'fulfilled'
	),
	array(
		'class' => 'button',
		'id' => 'button-fulfilled'
	)
);
echo $this->Html->link(
	'Expired',
	array(
		'action' => 'index',
		'expired'
	),
	array(
		'class' => 'button',
		'id' => 'button-expired'
	)
);
echo $this->Html->link(
	'All',
	array(
		'action' => 'index',
		'all'
	),
	array(
		'class' => 'button',
		'id' => 'button-all'
	)
);
?>
</div>
<table cellpadding="0" cellspacing="0">
<tr>
		<th><?php echo $this->Paginator->sort('id');?></th>
		<th><?php echo $this->Paginator->sort('absentee_id');?></th>
		<th><?php echo $this->Paginator->sort('fulfiller_id');?></th>
		<th><?php echo $this->Paginator->sort('school_id');?></th>
		<th><?php echo $this->Paginator->sort('room');?></th>
		<th><?php echo $this->Paginator->sort('start');?></th>
		<th><?php echo $this->Paginator->sort('end');?></th>
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
		<?php echo $this->Html->link(
			$absence['Absentee']['username'],
			array(
				'controller' => 'users',
				'action' => 'view',
				$absence['Absentee']['id']
			)
		); ?>
	</td>
	<td>
		<?php echo $this->Html->link(
			$absence['Fulfiller']['username'],
			array(
				'controller' => 'users',
				'action' => 'view',
				$absence['Fulfiller']['id']
			)
		); ?>
	</td>
	<td>
		<?php echo $this->Html->link(
			$absence['School']['name'],
			array(
				'controller' => 'schools',
				'action' => 'view',
				$absence['School']['id']
			)
		); ?>
	</td>
	<td><?php echo $absence['Absence']['room']; ?>&nbsp;</td>
	<td><?php echo $this->Time->niceShort($absence['Absence']['start']); ?>&nbsp;</td>
	<td><?php echo $this->Time->niceShort($absence['Absence']['end']); ?>&nbsp;</td>
	<td><!-- class="actions">-->
		<?php
		$user = $this->Session->read('User');
		echo $this->Html->link(
			'Apply',
			array(
				'action' => 'apply',
				$absence['Absence']['id']
			),
			array(
				'class' => 'button',
			)
		); 
		echo $this->Html->link(
			'Unapply',
			array(
				'action' => 'unapply',
				$absence['Absence']['id']
			),
			array(
				'class' => 'button',
			)
		); 
		if ($absence['Fulfiller']['id'] == $user['User']['id']) {
			$button_class = array('class' => 'button');
		} else {
			$button_class = array('class' => 'disabled-button');
		}
		echo $this->Html->link(
			'Release',
			array(
				'action' => 'release',
				$absence['Absence']['id']
			),
			$button_class
		); 
		echo $this->Html->link(
			'View',
			array(
				'action' => 'view',
				$absence['Absence']['id']
			),
			array(
				'class' => 'button',
			)
		); 
		if ($absence['Absentee']['id'] == $user['User']['id']) {
			echo $this->Html->link(
				'Edit',
				array(
					'action' => 'edit',
					$absence['Absence']['id']
				),
				array(
					'class' => 'button',
				)
			); 
			echo $this->Html->link(
				'Delete',
				array(
					'action' => 'delete',
					$absence['Absence']['id']
				),
				array(
					'class' => 'button',
				),
				sprintf('Are you sure you want to delete # %s?', $absence['Absence']['id'])
			); 
		}
		?>
	</td>
</tr>
<?php endforeach; ?>
</table>
<p>
<?php echo $this->Paginator->counter(array(
	'format' => 'Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%'
));
?>
</p>

<div class="paging">
	<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $this->Paginator->numbers();?>
|
	<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
</div>
<?php echo $this->Js->writeBuffer(); ?>
