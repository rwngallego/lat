<?php
setlocale(LC_MONETARY, 'en_US');
$turnsTotal = 0;
$hoursTotal = 0;
$paymentTotal = 0;
?>
<div>
	<table border="1">
		<tr>
			<th>Date</th>
			<th>Turns</th>
			<th>Worked Hours</th>
			<th>Payment (US $)</th>
		</tr>
		<?php foreach ($schedules as $schedule):?>
		<?php
		$hoursPerDay = countWorkedHours($schedule['turns']);
		
		$turnsTotal += count($schedule['turns']);
		$hoursTotal += $hoursPerDay;
		$paymentTotal += $hoursPerDay * 10;
		?>
		<tr>
			<td><?php echo $schedule['date']->format('Y-m-d')?></td>
			<td><?php echo count($schedule['turns'])?></td>
			<td><?php echo $hoursPerDay?></td>
			<td><?php echo money_format('%i', $hoursPerDay * 10)?></td>
		</tr>
		<?php endforeach;?>
		<tr>
			<th>Total</th>
			<th><?php echo $turnsTotal?></th>
			<th><?php echo $hoursTotal?></th>
			<th><?php echo $paymentTotal?></th>
		</tr>
	</table>
</div>

<?php 
function countWorkedHours($turns){
 	$total = 0;
	foreach($turns as $turn){
		$diff = intval($turn['endTime']) - intval($turn['startTime']);
		$total += $diff;
	}
	return $total;
}
?>