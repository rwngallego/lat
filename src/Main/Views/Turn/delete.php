<?php render_view("Main:Layouts:header.php"); ?>
<?php render_view("Main:Layouts:menu.php"); ?>
<h3>Delete the turn?</h3>

Do you want to delete the turn from <span class="bold-text"><?php echo $turn->getStartTime() . ' to ' . $turn->getEndTime()?></span>?
<div>
	<form method="post" action="">
		<input type="submit" value="yes" name="answer" />
		<input type="submit" value="no" name="answer" />
	</form>
</div>
<?php render_view("Main:Layouts:footer.php")?>