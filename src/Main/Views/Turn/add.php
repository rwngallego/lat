<?php render_view("Main:Layouts:header.php"); ?>
<?php render_view("Main:Layouts:menu.php"); ?>

<h3>Add a new turn</h3>
Add a new turn in <span class="bold-text"><?php echo $schedule->getDate()->format('Y-m-d') ?></span>?

<script type="text/javascript">
	$(document).ready(function(){
		$("#save").click(function(){
			var start = parseInt($('#startTime :selected').val());
			var end = parseInt($('#endTime :selected').val());
			if (start >= end){
				alert("End time must be greater than start time");
				return false;
			}
		});
	});
</script>
<form method="post" action="">
	<table>
		<tr>
			<td>Start time:</td>
			<td><select id="startTime" name="startTime"><?php print_turns_time_select($avaibleTurns);?></select></td>
		</tr>
		<tr>
			<td>End time:</td>
			<td>
				<select id="endTime" name="endTime"><?php print_turns_time_select($avaibleTurns);?></select>
			</td>
		</tr>
		<tr>
			<td colspan="2"><button id="save">Save</button></td>
		</tr>
	</table>
</form>
<div>
	<a href="<?php path("schedule_home")?>" title="Go Back">Go back</a>
</div>

<?php 

function print_turns_time_select($avaibleTurns){
	foreach($avaibleTurns as $turn){
		echo "<option value=\"$turn\">$turn:00</option>";
	}
}
?>
<?php render_view("Main:Layouts:footer.php")?>