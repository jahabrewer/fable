<div class="absences view">
<h2><?php  __('Absence');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $absence['Absence']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Absentee'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($absence['Absentee']['username'], array('controller' => 'users', 'action' => 'view', $absence['Absentee']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Fulfiller'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($absence['Fulfiller']['username'], array('controller' => 'users', 'action' => 'view', $absence['Fulfiller']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('School'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($absence['School']['name'], array('controller' => 'schools', 'action' => 'view', $absence['School']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Room'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $absence['Absence']['room']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Start'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $absence['Absence']['start']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('End'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $absence['Absence']['end']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Comment'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $absence['Absence']['comment']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $absence['Absence']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $absence['Absence']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<?php require 'views/common/nav.teacher.head.ctp'; ?>
		<li><?php echo $this->Html->link(__('Edit This Absence', true), array('action' => 'edit', $absence['Absence']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete This Absence', true), array('action' => 'delete', $absence['Absence']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $absence['Absence']['id'])); ?> </li>
<?php require 'views/common/nav.teacher.tail.ctp'; ?>
<div class="related">
	<h3><?php __('Related Applications');?></h3>
	<?php if (!empty($absence['Application'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Applicant'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($absence['Application'] as $application):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $this->Html->link($application['User']['username'], array('controller' => 'users', 'action' => 'view', $application['user_id'])); ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('Accept', true), array('controller' => 'applications', 'action' => 'accept', $application['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Application', true), array('controller' => 'applications', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
