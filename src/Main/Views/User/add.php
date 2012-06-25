<?php render_view("Main:Layouts:header.php"); ?>
<?php render_view("Main:Layouts:menu.php"); ?>

<?php if ($type == 'add'):?>
<h3>Add a new user</h3>
<?php else:?>
<h3>Edit an existing user</h3>
<?php endif; ?>

<form method="post" action="<?php echo ($type=='add')? "": path("user_editUpdate", array('id' => $userId))?>">
	<table>
		<tr>
			<td>Name:</td>
			<td><input type="text" name="name"
				value="<?php echo @$form_data['name'];?>" /></td>
		</tr>
		<tr>
			<td>Email:</td>
			<td><input type="text" name="email"
				value="<?php echo @$form_data['email'];?>" /></td>
		</tr>
		<tr>
			<td>Role:</td>
			<td><select name="role">
					<option
						<?php echo (@$form_data['role'] == "ADMIN") ? "selected=\"selected\"": "";?>>ADMIN</option>
					<option
						<?php echo (@$form_data['role'] == "EMPLOYEE") ? "selected=\"selected\"": "";?>>EMPLOYEE</option>
			</select></td>
		</tr>
		<tr>
			<td>Password:</td>
			<td><input type="password" name="password"
				value="" /></td>
		</tr>
		<tr>
			<td colspan="2"><input type="submit" name="submit" value="Save" /></td>
		</tr>
	</table>
</form>
<div>
	<a href="<?php path("users_list")?>" title="Go Back">Go back</a>
</div>
<?php render_view("Main:Layouts:footer.php")?>