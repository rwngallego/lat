<?php render_view("Main:Layouts:header.php"); ?>
<?php render_view("Main:Layouts:menu.php"); ?>
<h3>Delete the user?</h3>

Do you want to delete the user <span class="bold-text"><?php echo $user->getName() ?></span>?
<div>
	<form method="post" action="">
		<input type="submit" value="yes" name="answer" />
		<input type="submit" value="no" name="answer" />
	</form>
</div>
<?php render_view("Main:Layouts:footer.php")?>