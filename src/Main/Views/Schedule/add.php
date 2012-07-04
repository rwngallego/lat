<?php render_view("Main:Layouts:header.php"); ?>
<?php render_view("Main:Layouts:menu.php"); ?>
<h3>Add a new Schedule?</h3>

Do you want to add a new schedule to <span class="bold-text"><?php echo $user->getName()?> in <?php echo $date ?></span>?
<div>
	<form method="post" action="">
		<input type="submit" value="yes" name="answer" />
		<input type="submit" value="no" name="answer" />
	</form>
</div>
<?php render_view("Main:Layouts:footer.php")?>