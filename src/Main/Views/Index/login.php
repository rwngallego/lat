<?php render_view("Main:Layouts:header.php")?>

<h2>Login</h2>
<form id="form-login" method="post" action="<?php echo get_url("login")?>">
	<table width="400" border="1" class="centered without-borders">
		<tr>
			<td colspan="2"><span class="orange-text">Please provide your email
					and password</span></td>
		</tr>
		<tr>
			<td colspan="2"><span class="bold-text"><?php if (isset($msg)) echo $msg;?></span></td>
		</tr>
		<tr>
			<td><label for="email">Email</label></td>
			<td><input type="text" name="email" id="email" /></td>
		</tr>
		<tr>
			<td><label for="password">Password</label></td>
			<td><input type="password" name="password" id="password" /></td>
		</tr>
		<tr>
			<td colspan="2"><input type="submit" name="login" id="login"
				value="Login" /></td>
		</tr>
	</table>
</form>
<?php render_view("Main:Layouts:footer.php")?>