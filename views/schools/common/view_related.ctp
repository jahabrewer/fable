<div class="related">
	<?php if (!empty($school['Absence'])):?>
	<h3><?php __('Related Absences');?></h3>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Absentee'); ?></th>
		<th><?php __('Fulfiller'); ?></th>
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
		foreach ($school['Absence'] as $absence):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $absence['id'];?></td>
			<td><?php echo $this->Html->link($absence['Absentee']['username'], array('controller' => 'users', 'action' => 'view', $absence['Absentee']['id'])); ?>
			<td><?php
				if (!empty($absence['Fulfiller'])) {
					echo $this->Html->link($absence['Fulfiller']['username'], array('controller' => 'users', 'action' => 'view', $absence['Fulfiller']['id']));
				}
			?></td>
			<td><?php echo $absence['room'];?></td>
			<td><?php echo $absence['start'];?></td>
			<td><?php echo $absence['end'];?></td>
			<td><?php echo $absence['comment'];?></td>
			<td><?php echo $absence['created'];?></td>
			<td><?php echo $absence['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'absences', 'action' => 'view', $absence['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'absences', 'action' => 'edit', $absence['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'absences', 'action' => 'delete', $absence['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $absence['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
</div>
<div class="related">
	<?php if (!empty($school['User'])):?>
	<h3><?php __('Related Users');?></h3>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Username'); ?></th>
		<th><?php __('First Name'); ?></th>
		<th><?php __('Middle Initial'); ?></th>
		<th><?php __('Last Name'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($school['User'] as $user):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $user['id'];?></td>
			<td><?php echo $this->Html->link($user['username'], array('controller' => 'users', 'action' => 'view', $user['id'])); ?>
			<td><?php echo $user['first_name'];?></td>
			<td><?php echo $user['middle_initial'];?></td>
			<td><?php echo $user['last_name'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'users', 'action' => 'view', $user['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'users', 'action' => 'edit', $user['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'users', 'action' => 'delete', $user['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $user['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
</div>
