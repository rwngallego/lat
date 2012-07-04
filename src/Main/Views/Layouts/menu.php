<table class="menu" border="0">
	<?php if ($_SESSION['role'] == "ADMIN"):?>
	<tr>
		<td><a href="<?php echo get_url("users_list")?>">System Users</a></td>
		<td><a href="<?php echo get_url("schedule_home")?>">Schedules</a></td>
		<td><a href="<?php echo get_url("logout")?>">Logout</a></td>
	</tr>
	<?php else:?>
	<tr>
		<td><a href="consultar_horario_semanal.html">Horario semanal</a></td>
		<td><a href="consultar_horario_mensual.html">Horario mensual</a></td>
		<td><a href="reporte_mensual.html">Reporte mensual</a></td>
		<td><a href="reporte_global.html">Reporte global</a></td>
		<td><a href="<?php echo get_url("logout")?>">Logout</a></td>
	</tr>
	<?php endif;?>
</table>