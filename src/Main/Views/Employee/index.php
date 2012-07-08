<?php render_view("Main:Layouts:header.php"); ?>
<?php render_view("Main:Layouts:menu.php"); ?>
<?php render_view("Main:Schedule:script.js.php", array('type' => 'view'))?>

<?php if (isset($message) && $message != ""):?>
<div class="message-alert"><?php echo $message;?></div>
<?php endif;?>

<form style="width: 500px;">
	<table>
		<tr>
			<td>
				<label for="employee">Employee:</label>
				<select id="employee" name="employee">
				<?php foreach($employees as $employee):?>
					<option value="<?php echo $employee["id"]?>" <?php echo $user == $employee['id']? 'selected': '';?>><?php echo $employee['name']?></option>
				<?php endforeach;?>
				</select>
			</td>
			<td>
				<label for="date">Date</label>
				<input type="textbox" value="<?php echo $date->format('Y-m-d')?>" name="date" id="date-selector"/>
			</td>
		</tr>
	</table>
</form>


<div id="schedule-view"></div>

<?php render_view("Main:Layouts:footer.php")?>