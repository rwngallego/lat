<?php $dayOfWeek = date("w", strtotime($date));?>
<div class="actions-menu" style="margin-top: 10px;">
	<a title="Add schedule"
		href="<?php path("schedule_add", array('date' => $date, 'id' => $id))?>">
		<img src="<?php asset("img/add")?>" /><span>Add schedule</span>
	</a>
</div>
<div>
	<table border="1">
		<tr>
			<th rowspan="2">Hour</th>
			<th>Monday</th>
			<th>Tuesday</th>
			<th>Wednesday</th>
			<th>Thursday</th>
			<th>Friday</th>
			<th>Saturday</th>
		    <th>Sunday</th>
		</tr>
		<tr>
		<?php for($i=1; $i<=7; $i++):?>
				<?php if (in_array($i, $daysList) == true || ($i == 7 && in_array(0, $daysList))):?>
					<td style="font-size: 12px;"><a href="<?php ?>">Delete schedule</a>
					<a href="<?php ?>">+Add turn</a></td>
				<?php else:?>
					<td>&nbsp;</td>
				<?php endif;?>
		<?php endfor;?>
		</tr>
		<?php for($i=8; $i<18; $i++):?>
		<tr>
			<td><?php echo $i . ' - ' . ($i+1);?></td>
			<?php for($j=1; $j<=7; $j++):?>
				<?php if ($j == $dayOfWeek || ($j == 7) && $dayOfWeek == 0):?>
				<td style="border: red dashed 1px;">&nbsp;</td>
				<?php else:?>
				<td>&nbsp;</td>
				<?php endif;?>
			<?php endfor; ?>
		</tr>
		<?php endfor;?>
	</table>

</div>