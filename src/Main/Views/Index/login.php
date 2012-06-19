<?php render_view("Main:Layouts:header.php")?>

<h2>Login</h2>
<form id="form-login" method="post" action="<?php get_url("login")?>">
	<table width="400" border="1" class="centered without-borders">
		<tr>
			<td colspan="2"><span class="orange-text">Please provide your username
					and password</span></td>
		</tr>
		<tr>
			<td><label for="username">Username</label></td>
			<td><input type="text" name="username" id="username" /></td>
		</tr>
		<tr>
			<td><label for="password">Password</label></td>
			<td><input type="password" name="password" id="password" /></td>
		</tr>
		<tr>
			<td colspan="2"><input type="submit" name="send" id="send"
				value="login" /></td>
		</tr>
	</table>
</form>
<?php render_view("Main:Layouts:footer.php")?>