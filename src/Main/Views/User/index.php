<?php render_view("Main:Layouts:header.php"); ?>
<?php render_view("Main:Layouts:menu.php"); ?>
<div class="actions-menu">
	<a title="Add user" href="<?php path("user_add")?>"> <img
		src="<?php asset("img/add")?>" /><span>Add</span>
	</a>
</div>

<?php if (isset($message) && $message != ""):?>
<div class="message-alert"><?php echo $message;?></div>
<?php endif;?>

<table>
	<tr>
		<th>Name</th>
		<th>Email</th>
		<th>Role</th>
		<th>Last access</th>
		<th>Actions</th>
	</tr>
	<?php foreach ($users as $user):?>
	<tr>
		<td><?php echo $user->getName() ?></td>
		<td><?php echo $user->getEmail() ?></td>
		<td><?php echo $user->getRole() ?></td>
		<td><?php echo $user->getLastAccess()->format(lat_parameter("datetime_format"))?></td>
		<td><a href="<?php path("user_edit", array('id' => $user->getId()))?>">Edit</a>
			<a href="<?php path("user_delete", array('id' => $user->getId()))?>">Delete</a>
		</td>
	</tr>
	<?php endforeach;?>
</table>

<?php render_view("Main:Layouts:footer.php")?>