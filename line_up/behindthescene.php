<?php 
	
	include('conn.php');

	$sql="CREATE EVENT test_event_03
		ON SCHEDULE EVERY 20 SECOND
		STARTS CURRENT_TIMESTAMP
		ENDS CURRENT_TIMESTAMP + INTERVAL 1 HOUR
		DO
    		UPDATE total_line_up SET status='can_go_in', allow_time=current_time()
				WHERE status='not_yet' 
				AND TIME_TO_SEC(reserve_time_tomorrow)>=TIME_TO_SEC(current_time())-TIME_TO_SEC(total_tolerance_time);

			UPDATE total_line_up SET status='late', late_time=current_time() 
				WHERE status='can_go_in' AND TIME_TO_SEC(between_scan_time)+TIME_TO_SEC(total_tolerance_time)<=TIME_TO_SEC(current_time())";

	echo $sql;

	echo "<br>";

	if (mysqli_query($conn, $sql)) {
		echo "Reserve successfully";
	} else {
		echo "Error updating record: " . mysqli_error($conn);
	}	   		

?>