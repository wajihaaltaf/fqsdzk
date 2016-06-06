<?php
mysql_select_db('pia',mysql_connect('localhost','root',''))or die(mysql_error());
?>

<link href='fullcalendar.css' rel='stylesheet' />
<link href='fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='lib/moment.min.js'></script>
<script src='lib/jquery.min.js'></script>
<script src='fullcalendar.min.js'></script>
<script>

	$(document).ready(function() {

		$('#calendar').fullCalendar({
			defaultDate: '2016-05-12',
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			events: [
			<?php $user_query = mysql_query("SELECT module_name,course_title,exam_date FROM `schedule`,module WHERE module.module_id=schedule.module_id ")or die(mysql_error());
													while($row = mysql_fetch_array($user_query)){
													printf("{title: '%s', start: '%s'},", $row[0]." ".$row[1], $row[2]);
													?>
			
			<?php } ?>
			]
			
		});
		
	});

</script>
<style>

	body {
		margin: 40px 10px;
		padding: 0;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		font-size: 14px;
	}

	#calendar {
		max-width: 900px;
		margin: 0 auto;
	}

</style>


	<div id='calendar'></div>

