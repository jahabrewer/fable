		<div id="content">

			<?php echo $this->Session->flash(); ?>
			<?php echo $this->Session->flash('email'); ?>

			<?php echo $content_for_layout; ?>

		</div>
		<div id="footer">
		</div>
	</div></center>
	<?php //echo $this->element('sql_dump'); ?>
</body>
</html>
