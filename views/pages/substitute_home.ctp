<?php $this->Html->addCrumb('Home', '/substitute/'); ?>
<div class="nav_blocks">
<?php echo $this->Html->link('Absences', array('controller' => 'absences', 'action' => 'index', 'substitute' => true)); ?>
<?php echo $this->Html->link('Dashboard', array('controller' => 'absences', 'action' => 'dashboard', 'substitute' => true)); ?>
</div>
