<?php $this->Html->addCrumb('Home', $this->viewVars['home_link_target']); ?>
<?php if ($show_linked_crumb) $this->Html->addCrumb('Schools', $this->Html->url(array('controller' => 'schools', 'action' => 'index'))); ?>
<?php if (!$show_linked_crumb) $this->Html->addCrumb('Schools'); ?>
<?php $this->Html->addCrumb('View'); ?>
<div class="schools view">
	<div class="buttons">
		<?php if ($show_edit) echo $this->Html->link('Edit', array('action' => 'edit', $school['School']['id']), array('id' => 'edit')); ?>
		<?php if ($show_delete) echo $this->Html->link('Delete', array('action' => 'delete', $school['School']['id']), array('id' => 'delete'), 'Are you sure you want to delete this school?'); ?>
	</div>
<h2><?php  __('School');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
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
		<?php if ($show_id): ?>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('ID'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $school['School']['id']; ?>
				&nbsp;
			</dd>
		<?php endif; ?>
	</dl>
</div>
