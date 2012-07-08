<script type="text/javascript">
$(document).ready(function() {
	$("#employee").change(function() {
		updateList();
	});
	$("#month").change(function(){
		updateList();
	});
	
	//on init:
	updateList();
});
function updateList(){
	var id = $("#employee").val();
	var month = $("#month :selected").val();
	$.ajax({
		type : "POST",
		data : {
			userId : id,
			month: month
		},
		url : "<?php path("reports_employee_list")?>"
	}).done(function(data) {
		$("#schedule-view").html(data);
	});
}
</script>