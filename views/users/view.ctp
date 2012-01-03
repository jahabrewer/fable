<script>
jQuery( function($) {
	$('table tr[data-href]').addClass('clickable').click( function() {
		window.location = $(this).attr('data-href');
	});
});
</script>
<?php $this->Html->addCrumb('Home', $this->viewVars['home_link_target']); ?>
<?php if ($show_linked_breadcrumb) $this->Html->addCrumb('Users', $this->Html->url(array('controller' => 'users', 'action' => 'index'))); ?>
<?php if (!$show_linked_breadcrumb) $this->Html->addCrumb('Users'); ?>
<?php $this->Html->addCrumb('View'); ?>
<div class="users view">
	<div class="buttons">
		<?php if ($show_edit) echo $this->Html->link('Edit', array('action' => 'edit', $user['User']['id']), array('id' => 'edit')); ?>
		<?php if ($show_pw_change) echo $this->Html->link('Change Password', array('action' => 'change_password'), array('id' => 'change-password')); ?>
		<?php if ($show_delete) echo $this->Html->link('Delete', array('action' => 'delete', $user['User']['id']), array('id' => 'delete'), 'Are you sure you want to delete this user?'); ?>
	</div>
<h2><?php echo $user['User']['first_name'] . ' ' . $user['User']['last_name'] ?></h2>
<h3>Basics</h3>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Username'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['username']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['UserType']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('First Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['first_name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Middle Initial'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['middle_initial']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Last Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['last_name']; ?>
			&nbsp;
		</dd>
		<?php if ($show_preferred_schools): ?>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Preferred Schools'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php $j = 1;
				// only echo newline if appropriate
				foreach ($user['PreferredSchool'] as $school):
					echo $school['name']; 
					if ($j++ < sizeof($user['PreferredSchool'])) echo '<br />';
				endforeach; ?>
				&nbsp;
			</dd>
		<?php endif; ?>
		<?php if ($show_school): ?>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('School'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $this->Html->link($user['School']['name'], array('controller' => 'schools', 'action' => 'view', $user['School']['id'])); ?>
				&nbsp;
			</dd>
		<?php endif; ?>
		<?php if ($show_education_level): ?>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Education Level'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $user['EducationLevel']['name']; ?>
				&nbsp;
			</dd>
		<?php endif; ?>
		<?php if($show_certification): ?>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Certification'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $user['User']['certification']; ?>
				&nbsp;
			</dd>
		<?php endif; ?>
	</dl>
<h3>Contact</h3>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Primary Phone'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['primary_phone']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Secondary Phone'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['secondary_phone']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Email Address'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($user['User']['email_address'], 'mailto:' . $user['User']['email_address']); ?>
			&nbsp;
		</dd>
	</dl>
<?php if ($show_account_details): ?>
<h3>Account</h3>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('ID'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Last Login'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['last_login']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
<?php endif; ?>
</div>
<?php if ($show_absences_made):?>
	<div class="right-sidebar">
		<h3><?php __($user['User']['first_name'] . '\'s Absences');?></h3>
		<?php if (!empty($user['AbsenceMade'])):?>
		<table cellpadding = "0" cellspacing = "0">
		<tr>
			<th><?php __('Fulfiller'); ?></th>
			<th><?php __('Start'); ?></th>
		</tr>
		<?php
			$i = 0;
			foreach ($user['AbsenceMade'] as $absenceMade):
				$class = null;
				if ($i++ % 2 == 0) {
					$class = ' class="altrow"';
				}
			?>
			<tr data-href=<?php echo $this->Html->url(array('controller' => 'absences', 'action' => 'view', $absenceMade['id'])); ?> <?php echo $class;?>>
				<td><?php if (isset($absenceMade['Fulfiller']['username'])) echo $absenceMade['Fulfiller']['username']; else echo '<i>None</i>';?>&nbsp;</td>
				<td><?php echo $this->Time->niceShort($absenceMade['start']);?>&nbsp;</td>
			</tr>
		<?php endforeach; ?>
		</table>
	<?php endif; ?>
	</div>
<?php endif; ?>
<?php if ($show_absences_filled):?>
	<div class="right-sidebar">
		<h3><?php __($user['User']['first_name'] . '\'s Absences');?></h3>
		<?php if (!empty($user['AbsenceFilled'])):?>
		<table cellpadding = "0" cellspacing = "0">
		<tr>
			<th><?php __('Absentee'); ?></th>
			<th><?php __('Start'); ?></th>
		</tr>
		<?php
			$i = 0;
			foreach ($user['AbsenceFilled'] as $absenceMade):
				$class = null;
				if ($i++ % 2 == 0) {
					$class = ' class="altrow"';
				}
			?>
			<tr data-href=<?php echo $this->Html->url(array('controller' => 'absences', 'action' => 'view', $absenceMade['id'])); ?> <?php echo $class;?>>
				<td><?php if (isset($absenceMade['Absentee']['username'])) echo $absenceMade['Absentee']['username']; else echo '<i>None</i>';?>&nbsp;</td>
				<td><?php echo $this->Time->niceShort($absenceMade['start']);?>&nbsp;</td>
			</tr>
		<?php endforeach; ?>
		</table>
	<?php endif; ?>
	</div>
<?php endif; ?>
