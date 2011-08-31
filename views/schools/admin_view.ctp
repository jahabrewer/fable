<?php $this->Html->addCrumb('Schools', $this->Html->url(array('controller' => 'schools', 'action' => 'index'))); ?>
<?php $this->Html->addCrumb('View'); ?>
<div class="schools view">
<h2><?php  __('School');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $school['School']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $school['School']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Street Address'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $school['School']['street_address']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<?php require 'views/common/nav.admin.head.ctp'; ?>
		<li><?php echo $this->Html->link(__('Edit This School', true), array('action' => 'edit', $school['School']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete This School', true), array('action' => 'delete', $school['School']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $school['School']['id'])); ?> </li>
<?php require 'views/common/nav.admin.tail.ctp'; ?>
<div class="related">
	<h3><?php __('Related Absences');?></h3>
	<?php if (!empty($school['Absence'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Absentee Id'); ?></th>
		<th><?php __('Fulfiller Id'); ?></th>
		<th><?php __('School Id'); ?></th>
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
			<td><?php echo $absence['absentee_id'];?></td>
			<td><?php echo $absence['fulfiller_id'];?></td>
			<td><?php echo $absence['school_id'];?></td>
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

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Absence', true), array('controller' => 'absences', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Users');?></h3>
	<?php if (!empty($school['User'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Username'); ?></th>
		<th><?php __('Password'); ?></th>
		<th><?php __('User Type Id'); ?></th>
		<th><?php __('First Name'); ?></th>
		<th><?php __('Middle Initial'); ?></th>
		<th><?php __('Last Name'); ?></th>
		<th><?php __('Primary Phone'); ?></th>
		<th><?php __('Secondary Phone'); ?></th>
		<th><?php __('Email Address'); ?></th>
		<th><?php __('Education Level Id'); ?></th>
		<th><?php __('Certification'); ?></th>
		<th><?php __('Absence Change Notify'); ?></th>
		<th><?php __('Last Login'); ?></th>
		<th><?php __('School Id'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
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
			<td><?php echo $user['username'];?></td>
			<td><?php echo $user['password'];?></td>
			<td><?php echo $user['user_type_id'];?></td>
			<td><?php echo $user['first_name'];?></td>
			<td><?php echo $user['middle_initial'];?></td>
			<td><?php echo $user['last_name'];?></td>
			<td><?php echo $user['primary_phone'];?></td>
			<td><?php echo $user['secondary_phone'];?></td>
			<td><?php echo $user['email_address'];?></td>
			<td><?php echo $user['education_level_id'];?></td>
			<td><?php echo $user['certification'];?></td>
			<td><?php echo $user['absence_change_notify'];?></td>
			<td><?php echo $user['last_login'];?></td>
			<td><?php echo $user['school_id'];?></td>
			<td><?php echo $user['created'];?></td>
			<td><?php echo $user['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'users', 'action' => 'view', $user['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'users', 'action' => 'edit', $user['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'users', 'action' => 'delete', $user['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $user['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Users');?></h3>
	<?php if (!empty($school['Substitute'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Username'); ?></th>
		<th><?php __('Password'); ?></th>
		<th><?php __('User Type Id'); ?></th>
		<th><?php __('First Name'); ?></th>
		<th><?php __('Middle Initial'); ?></th>
		<th><?php __('Last Name'); ?></th>
		<th><?php __('Primary Phone'); ?></th>
		<th><?php __('Secondary Phone'); ?></th>
		<th><?php __('Email Address'); ?></th>
		<th><?php __('Education Level Id'); ?></th>
		<th><?php __('Certification'); ?></th>
		<th><?php __('Absence Change Notify'); ?></th>
		<th><?php __('Last Login'); ?></th>
		<th><?php __('School Id'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($school['Substitute'] as $substitute):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $substitute['id'];?></td>
			<td><?php echo $substitute['username'];?></td>
			<td><?php echo $substitute['password'];?></td>
			<td><?php echo $substitute['user_type_id'];?></td>
			<td><?php echo $substitute['first_name'];?></td>
			<td><?php echo $substitute['middle_initial'];?></td>
			<td><?php echo $substitute['last_name'];?></td>
			<td><?php echo $substitute['primary_phone'];?></td>
			<td><?php echo $substitute['secondary_phone'];?></td>
			<td><?php echo $substitute['email_address'];?></td>
			<td><?php echo $substitute['education_level_id'];?></td>
			<td><?php echo $substitute['certification'];?></td>
			<td><?php echo $substitute['absence_change_notify'];?></td>
			<td><?php echo $substitute['last_login'];?></td>
			<td><?php echo $substitute['school_id'];?></td>
			<td><?php echo $substitute['created'];?></td>
			<td><?php echo $substitute['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'users', 'action' => 'view', $substitute['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'users', 'action' => 'edit', $substitute['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'users', 'action' => 'delete', $substitute['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $substitute['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Substitute', true), array('controller' => 'users', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
