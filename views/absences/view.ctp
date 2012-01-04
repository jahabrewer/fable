<?php if ($show_applications): ?>
	<script>
	jQuery( function($) {
		$('table tr[data-href]').addClass('clickable').click( function() {
			window.location = $(this).attr('data-href');
		});
	});
	</script>
<?php endif; ?>
<?php $this->Html->addCrumb('Home', $this->viewVars['home_link_target']); ?>
<?php $this->Html->addCrumb('Absences', $this->Html->url(array('controller' => 'absences', 'action' => 'index'))); ?>
<?php $this->Html->addCrumb('View'); ?>
<div class="absences view">
		<div class="buttons">
		<?php if ($show_edit) echo $this->Html->link('Edit', array('action' => 'edit', $absence['Absence']['id']), array('id' => 'edit')); ?>
		<?php if ($show_delete) echo $this->Html->link('Delete', array('action' => 'delete', $absence['Absence']['id']), array('id' => 'delete'), 'Are you sure you want to delete this absence?'); ?>
		<?php if ($show_apply) echo $this->Html->link('Apply', array('action' => 'apply', $absence['Absence']['id']), array('id' => 'apply')); ?>
		<?php if ($show_retract) echo $this->Html->link('Retract Application', array('action' => 'retract', $absence['Absence']['id']), array('id' => 'retract')); ?>
		<?php if ($show_release) echo $this->Html->link('Release Absence', array('action' => 'release', $absence['Absence']['id']), array('id' => 'release')); ?>
		</div>
<h2><?php  __('Absence');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Absentee'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($absence['Absentee']['first_name'] . ' ' . $absence['Absentee']['last_name'], array('controller' => 'users', 'action' => 'view', $absence['Absentee']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Fulfiller'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($absence['Fulfiller']['first_name'] . ' ' . $absence['Fulfiller']['last_name'], array('controller' => 'users', 'action' => 'view', $absence['Fulfiller']['id'])); ?>
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
			<?php echo $this->Time->nice($absence['Absence']['start']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('End'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Time->nice($absence['Absence']['end']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Instructions'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $absence['Absence']['comment']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Absence ID'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $absence['Absence']['id']; ?>
			&nbsp;
		</dd>
		<?php if ($show_created): ?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Time->nice($absence['Absence']['created']); ?>
			&nbsp;
		</dd>
		<?php endif; ?>
		<?php if ($show_modified): ?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Time->nice($absence['Absence']['modified']); ?>
			&nbsp;
		</dd>
		<?php endif; ?>
	</dl>
</div>
<?php if ($show_applications): ?>
<div class="right-sidebar">
	<h3><?php __('Applications');?></h3>
	<?php if (!empty($absence['Application'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Substitute'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($absence['Application'] as $application):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<?php
			if ($allow_applicant_selection) echo "<tr data-href=" . $this->Html->url(array('controller' => 'applications', 'action' => 'accept', $application['id'])) . " $class>";
			else echo "<tr$class>";
		?>
			<td><?php echo $application['User']['first_name'] . ' ' . $application['User']['last_name'];?></td>
		</tr>
	<?php endforeach; ?>
	</table>
	<?php endif; ?>
</div>
<?php endif; ?>
<?php if ($show_sub_status): ?>
<div class="right-sidebar sub-status">
	<h3><?php __('Your Status');?></h3>
	<ul>
		<li<?php if ($sub_status_1) echo " id='sub-status-emphasis'"; ?>>You haven't applied</li>
		<li<?php if ($sub_status_2) echo " id='sub-status-emphasis'"; ?>>You've applied, awaiting teacher decision</li>
		<li<?php if ($sub_status_3) echo " id='sub-status-emphasis'"; ?>><?php echo $application_deny_mesg; ?></li>
	</ul>
</div>
<?php endif; ?>
