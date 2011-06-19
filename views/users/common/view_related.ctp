<div class="related">
	<?php if (!empty($user['AbsenceMade'])):?>
	<h3><?php __('Absences Created');?></h3>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Absentee'); ?></th>
		<th><?php __('Fulfiller'); ?></th>
		<th><?php __('School'); ?></th>
		<th><?php __('Room'); ?></th>
		<th><?php __('Start'); ?></th>
		<th><?php __('End'); ?></th>
		<th><?php __('Comment'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['AbsenceMade'] as $absenceMade):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $absenceMade['id'];?></td>
			<td><?php echo $this->Html->link($absenceMade['Absentee']['username'], array('controller' => 'users', 'action' => 'view', $absenceMade['Absentee']['id'])); ?></td>
			<td><?php echo $this->Html->link($absenceMade['Fulfiller']['username'], array('controller' => 'users', 'action' => 'view', $absenceMade['Fulfiller']['id'])); ?></td>
			<td><?php echo $this->Html->link($absenceMade['School']['name'], array('controller' => 'schools', 'action' => 'view', $absenceMade['School']['id'])); ?></td>
			<td><?php echo $absenceMade['room'];?></td>
			<td><?php echo $absenceMade['start'];?></td>
			<td><?php echo $absenceMade['end'];?></td>
			<td><?php echo $absenceMade['comment'];?></td>
			<td><?php echo $absenceMade['created'];?></td>
			<td><?php echo $absenceMade['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'absences', 'action' => 'view', $absenceMade['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'absences', 'action' => 'edit', $absenceMade['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'absences', 'action' => 'delete', $absenceMade['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $absenceMade['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
</div>
<div class="related">
	<?php if (!empty($user['AbsenceFilled'])):?>
	<h3><?php __('Absences Filled');?></h3>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Absentee'); ?></th>
		<th><?php __('Fulfiller'); ?></th>
		<th><?php __('School'); ?></th>
		<th><?php __('Room'); ?></th>
		<th><?php __('Start'); ?></th>
		<th><?php __('End'); ?></th>
		<th><?php __('Comment'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['AbsenceFilled'] as $absenceFilled):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $absenceFilled['id'];?></td>
			<td><?php echo $this->Html->link($absenceFilled['Absentee']['username'], array('controller' => 'users', 'action' => 'view', $absenceFilled['Absentee']['id'])); ?></td>
			<td><?php echo $this->Html->link($absenceFilled['Fulfiller']['username'], array('controller' => 'users', 'action' => 'view', $absenceFilled['Fulfiller']['id'])); ?></td>
			<td><?php echo $this->Html->link($absenceFilled['School']['name'], array('controller' => 'schools', 'action' => 'view', $absenceFilled['School']['id'])); ?></td>
			<td><?php echo $absenceFilled['room'];?></td>
			<td><?php echo $absenceFilled['start'];?></td>
			<td><?php echo $absenceFilled['end'];?></td>
			<td><?php echo $absenceFilled['comment'];?></td>
			<td><?php echo $absenceFilled['created'];?></td>
			<td><?php echo $absenceFilled['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'absences', 'action' => 'view', $absenceFilled['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'absences', 'action' => 'edit', $absenceFilled['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'absences', 'action' => 'delete', $absenceFilled['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $absenceFilled['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
</div>
