<?php $this->Html->addCrumb('Home', '/admin/'); ?>
<?php $this->Html->addCrumb('Schools', $this->Html->url(array('controller' => 'schools', 'action' => 'index'))); ?>
<?php $this->Html->addCrumb('View'); ?>
<div class="schools view">
	<div class="buttons">
		<?php echo $this->Html->link('Edit', array('action' => 'edit', $school['School']['id']), array('id' => 'edit')); ?>
		<?php echo $this->Html->link('Delete', array('action' => 'delete', $school['School']['id']), array('id' => 'delete'), 'Are you sure you want to delete this school?'); ?>
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
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('ID'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $school['School']['id']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
