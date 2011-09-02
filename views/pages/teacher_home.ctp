<?php $this->Html->addCrumb('Home', $this->Html->url(array('controller' => 'pages', 'action' => 'home', 'admin' => false))); ?>
<div class="nav_blocks">
<?php echo $this->Html->link('Absences', array('controller' => 'absences', 'action' => 'index')); ?>
<?php echo $this->Html->link('Users', array('controller' => 'users', 'action' => 'index')); ?>
<?php echo $this->Html->link('Schools', array('controller' => 'schools', 'action' => 'index')); ?>
</div>
