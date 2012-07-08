<?php render_view("Main:Layouts:header.php"); ?>
<?php render_view("Main:Layouts:menu.php"); ?>
<?php render_view("Main:Reports:script.js.php")?>

<?php if (isset($message) && $message != ""):?>
<div class="message-alert"><?php echo $message;?></div>
<?php endif;?>

<form style="width: 500px;" action="">
	<table>
		<tr>
			<td>
				<label for="employee">Employee:</label>
				<select id="employee" name="employee">
				<?php foreach($employees as $employee):?>
					<option value="<?php echo $employee["id"]?>" <?php echo $user == $employee['id']? 'selected="selected"': '';?>><?php echo $employee['name']?></option>
				<?php endforeach;?>
				</select>
			</td>
			<td>
				<label for="month">Month</label>
				<select id="month" name="month">
					<option value="-1">All</option>
					<?php for($i=1; $i<=12; $i++):?>
						<option value="<?php echo str_pad($i, 2, "0", STR_PAD_LEFT)?>" <?php echo ($month==$i) ? 'selected="selected"' : "";?>>
							<?php echo str_pad($i, 2, "0", STR_PAD_LEFT)?>
						</option>
					<?php endfor;?>
				</select>
			</td>
		</tr>
	</table>
</form>


<div id="schedule-view"></div>

<?php render_view("Main:Layouts:footer.php")?>