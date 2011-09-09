<?php $this->Html->addCrumb('Home', '/teacher/'); ?>
<div class="nav_blocks">
<?php echo $this->Html->link('Absences', array('controller' => 'absences', 'action' => 'index', 'teacher' => true)); ?>
<?php echo $this->Html->link('Dashboard', array('controller' => 'absences', 'action' => 'dashboard', 'teacher' => true)); ?>
</div>
