<script type="text/javascript">
$(document).ready(function() {
	$("#employee").change(function() {
		updateList();
	});
	$("#date-selector").datepicker({
			showWeek: true,
			firstDay: 1,
			dateFormat: "yy-mm-dd",
			onSelect: function(dateText, inst){updateList();},
		});
	
	//on init:
	updateList();
});
function updateList(){
	var id = $("#employee").val();
	var date = $("#date-selector").val();
	$.ajax({
		type : "POST",
		data : {
			id : id,
			scheduleId: "<?php echo $scheduleId?>",
		},
		url : "<?php path("schedule_list_for_employee")?>"
	}).done(function(data) {
		$("#schedule-view").html(data);
	});
}
</script>