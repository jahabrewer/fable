<script>
jQuery( function($) {
	$('table tr[data-href]').addClass('clickable').click( function() {
		window.location = $(this).attr('data-href');
	});
});
</script>
<?php $this->Html->addCrumb('Home', $this->viewVars['home_link_target']); ?>
<?php $this->Html->addCrumb('Notifications'); ?>
<div class="notifications index">
	<h2><?php __('Notifications');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr><th></th></tr>
	<?php foreach ($notifications as $notification):?>
		<tr data-href=<?php echo $this->Html->url(array('controller' => 'absences', 'action' => 'view', $notification['Notification']['absence_id'])); ?>><td>
			<?php
			$fstring = $notification['NotificationType']['string'];
			$fstring = str_replace(
				array(
					'%other_firstname%',
					'%other_lastname%',
					'%absence_start%',
				),
				array(
					$notification['Other']['first_name'],
					$notification['Other']['last_name'],
					date('M j', strtotime($notification['Absence']['start'])),
				),
				$fstring
			);
			echo $fstring;
			echo '<br />';
			echo '<p class=timeago>';
			echo $this->Time->relativeTime($notification['Notification']['created']);
			echo '</p>';
			?>
		</td></tr>
	<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
