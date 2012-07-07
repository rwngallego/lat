<?php
$dayOfWeek = $date->format("w");
?>
<div class="actions-menu" style="margin-top: 10px; height: 40px;">
	<a title="Add schedule" id="add-schedule"
		href="<?php path("schedule_add", array('date' => $date->format("Y-m-d"), 'id' => $userId))?>">
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
					<?php if ($i == $dayOfWeek || ($i== 7 && $dayOfWeek== 0 )):?>
						<?php $scheduleId = array_search($i, $daysList);?>
						<td style="font-size: 12px;">
							<a href="<?php path('schedule_delete', array('id' => $scheduleId)); ?>">Delete schedule</a>
							<a href="<?php path('turn_add', array('scheduleId' => $scheduleId, 'userId'=> $userId))?>">+Add turn</a>
						</td>
						<script type="text/javascript">
							//hides the add button
							$("#add-schedule").hide();
						</script>
					<?php else:?>
						<td style="background-color: aqua;"></td>
					<?php endif;?>
					
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
					<td style="border: red dashed 1px;">
					<?php foreach($turns as $turn):?>
						<?php if ($i >= $turn->getStartTime() && $i < $turn->getEndTime()):?>
							Full<?php break;?>
						<?php endif;?>
					<?php endforeach;?>
					</td>
				<?php else:?>
				<td>&nbsp;</td>
				<?php endif;?>
			<?php endfor; ?>
		</tr>
		<?php endfor;?>
	</table>

</div>