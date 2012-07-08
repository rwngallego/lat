<?php
$dayOfWeek = $date->format("w");
$color = rand_colorCode();
?>
<div class="actions-menu" style="margin-top: 10px; height: 40px;">
	<a title="Add schedule" id="add-schedule"
		href="<?php path("schedule_add", array('date' => $date->format("Y-m-d"), 'id' => $userId))?>">
		<img src="<?php asset("img/add")?>" alt="Add"/><span>Add schedule</span>
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
					<td style="border: red dashed 1px; font-size: 10px;">
					<?php 
					
					foreach($turns as $turn){
						 if ($i >= $turn->getStartTime() && $i < $turn->getEndTime()){
						 	if ($i == $turn->getStartTime()){
						 		$color = rand_colorCode();
						 		echo "<div style=\"border: black solid 2px; text-align: right; background-color:$color\">";
						 		echo "<a style=\"color: black;\" href=\"";
						 		path("turn_delete", array('turnId'=>$turn->getId()));
						 		echo "\">Delete</a>";
						 		echo "</div>";
						 	}else
								echo "<div style=\"border: black solid 2px; background-color:$color\">&nbsp;</div>";
							break;
						 }
					}?>
					</td>
				<?php else:?>
				<td>&nbsp;</td>
				<?php endif;?>
			<?php endfor; ?>
		</tr>
		<?php endfor;?>
	</table>
</div>
<?php 
function rand_colorCode(){
	$r = dechex(mt_rand(0,255)); // generate the red component
	$g = dechex(mt_rand(0,255)); // generate the green component
	$b = dechex(mt_rand(0,255)); // generate the blue component
	$rgb = $r.$g.$b;
	return '#'.$rgb;
	if($r == $g && $g == $b){
		$rgb = substr($rgb,0,3); // shorter version
	}
	return '#'.$rgb;
}
?>