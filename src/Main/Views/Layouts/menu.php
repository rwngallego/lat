<table class="menu" border="0">
	<?php if ($_SESSION['role'] == "ADMIN"):?>
	<tr>
		<td><a href="<?php echo get_url("users_list")?>">System Users</a></td>
		<td><a href="<?php echo get_url("schedule_home")?>">Schedules</a></td>
		<td><a href="<?php echo get_url("reports_employee_all")?>">Payments</a></td>
		<td><a href="<?php echo get_url("logout")?>">Logout</a></td>
	</tr>
	<?php else:?>
	<tr>
		<td><a href="<?php echo get_url("employee_schedule_weekly")?>">Weekly schedule</a></td>
		<td><a href="<?php echo get_url("reports_employee_one")?>">Payment</a></td>
		<td><a href="<?php echo get_url("logout")?>">Logout</a></td>
	</tr>
	<?php endif;?>
</table>