<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<title>History</title>
<style>
@import "new_menu_test_templ.css";
@import "dropdown.css";
@import "cust_menu.css";
table, th, td {
  border: 1px solid black;
  font-weight: 400;
  border-collapse: collapse;
}
th{
	padding: 2px;
}
body {
  font-family: Arial, Helvetica, sans-serif;
  /*background-color: #333; */
}

.active {
  background-color: #4CAF50;
}

.submit{
	font-family: "Roboto", sans-serif;
	text-transform: uppercase;
	outline: 0;
	background: #4CAF50;
	border: 0;
	color: #FFFFFF;
	font-size: 20px;
	cursor: pointer;
}

</style>
</head>
<body>


<?php session_start();
	include("conn.php");


	#$line_up_id=$_REQUEST['line_up_id'];
	#$total_line_up_id=$_POST['line_up_id'];
	
	
	#store_setting_atl.php
?>




<?php
	$store_total_id=$_SESSION['store_id'];


	
	$sql2 = "SELECT line_up_name,
			line_id 
			FROM stores_accounts 
				WHERE store_total_id='$store_total_id'
					ORDER BY line_id";
	
	//make query & get result
	$line_total_result = mysqli_query($conn, $sql2);

	//fetch resulting rows as an array
	$line_total_array = mysqli_fetch_all($line_total_result, MYSQLI_ASSOC);
	/*
	foreach($line_total_array as $line_total_each){
		$line_id=$line_total_each['line_id'];
		echo " <a class='brand-text' 
		href='store_mon.php?line_id=".$line_id."'>".$line_total_each['line_up_name'].
		" (ID ".$line_total_each['line_id'].")</a>";


	}

	echo "</div></div></div><div class='middle'><br>";*/

	echo "<ul class='topnav' id='topnav'>
	<li><a style='background-color: #4CAF50' href='all_lineup_this_store.php'>Preserve history</a></li>
	<li><a href='add_line_up.php'>Add a line</a></li>
	<li><a href='alter_store_total.php'>Edit store info</a></li>
	
	<div class='dropdown'>
		
	<div class='active'>
	<button style='background-color: #333;' onclick='myFunction()' class='dropbtn'  >Lines <i class='fa fa-caret-down'></i></button> 
	</div>
	
		
		<div id='myDropdown' class='dropdown-content'>";

		foreach($line_total_array as $line_total_each){
			$line_id=$line_total_each['line_id'];
			echo " <a class='brand-text' 
			 href='store_mon.php?line_id=".$line_id."'>".$line_total_each['line_up_name'].
			" (ID ".$line_total_each['line_id'].")</a>";
			

		}

	echo "</div>
	</div>
	<li class='icon'>
		<a href='javascript:void(0);' style='font-size:15px;' onclick='wholemanu()'>☰</a>
	</li>

	</ul><div style='padding-left: 10px;'>";

	date_default_timezone_set("America/New_York");

    $date_ava_pick_num=strtotime("today");

	$date_past_3_num=$date_ava_pick_num-86400*3;


	$sql="SELECT * FROM total_line_up_tomorrow 
		WHERE store_total_id='$store_total_id'
		AND UNIX_TIMESTAMP(reserve_date)>=$date_past_3_num
        ORDER BY UNIX_TIMESTAMP(reserve_date) DESC, TIME_TO_SEC(allow_time) DESC, total_line_up_id DESC";
	$all_line_info_result = mysqli_query($conn, $sql);
	$all_line_info_array = mysqli_fetch_all($all_line_info_result, MYSQLI_ASSOC);

    //print_r($all_line_info_array);
	$total_num_today = count($all_line_info_array);

	echo "<br><table>";
	echo "<tr><th>total prserve history</th></tr>";
	echo "<tr><th>".$total_num_today."</th></tr>";
	echo "</table>";





		


		date_default_timezone_set("America/New_York");
		//echo "open_time".strtotime($this_line_info_array[0]['open_time'])."<br>";
		//echo "senior_time_after_open".strtotime($this_line_info_array[0]['senior_time_after_open'])."<br>";

		//$open_time=AddPlayTime($open_time_plus_senior_time);

		//echo "open_time".$open_time."<br>";

		
		echo "<h3>History</h3>";
		echo "<table>";
        echo "<tr><th>ID</th><th>line name</th><th>user name</th><th>phone number</th><th>E-mail</th><th>preserve type</th><th>preserve time</th>
        <th>preserve date</th><th>allow time</th><th>latest status</th>
        <th>cancel date and time</th><th>scan time</th><th>preserve upload time</th></tr>";

		$after_num=0;

		foreach($all_line_info_array as $all_line_info_each){

			
			
				$list_time[]=$all_line_info_each['reserve_time_tomorrow'];
				$reserver_id=$all_line_info_each['reserver_id'];
				$sql="SELECT user_name,
						customer_id,
						phone_number,
						email
						FROM customer_accounts 
							WHERE customer_id='$reserver_id' 
							LIMIT 1";
				$cust_info_result_discreet = mysqli_query($conn, $sql);
				$cust_info_array_discreet = mysqli_fetch_all($cust_info_result_discreet, MYSQLI_ASSOC);
				
                echo "<tr>";
                
                $line_id=$all_line_info_each['line_id'];
                $sql="SELECT line_up_name FROM stores_accounts 
					WHERE line_id='$line_id' 
					LIMIT 1";
				$this_line_info_result = mysqli_query($conn, $sql);
                $this_line_info_array = mysqli_fetch_all($this_line_info_result, MYSQLI_ASSOC);
                
                
                echo "<th>".$all_line_info_each['total_line_up_id']."</th>";
                echo "<th>".$this_line_info_array[0]['line_up_name']."</th>";
				echo "<th><div style='max-width: 100px; word-break: break-all'>".$cust_info_array_discreet[0]['user_name']."<br>"
					."[ID ".$cust_info_array_discreet[0]['customer_id']."]</div></th>";

				echo "<th>".$cust_info_array_discreet[0]['phone_number']."</th>";
				echo "<th><div style='max-width: 100px; word-break: break-all'>".$cust_info_array_discreet[0]['email']."</div></th>";


				if($all_line_info_each['reserve_type']=="not_discreet"){
					echo "<th>stand by</th>";
				}
                else{
					echo "<th>specific</th>";
				}


				if($all_line_info_each['reserve_time_tomorrow']=="800:59:00"){
					echo "<th>-</th>";
				}
                else{
					echo "<th>".$all_line_info_each['reserve_time_tomorrow']."</th>";
				}

				

                echo "<th>".$all_line_info_each['reserve_date']."</th>";
				if($all_line_info_each['allow_time'] == "00:00:00"){
					echo "<th>-</th>";
				}
				else{
					echo "<th>".$all_line_info_each['allow_time']."</th>";
				}

				if($all_line_info_each['status']=="not_yet"){
					echo  "<th>waiting</th>";
					
				}
				elseif($all_line_info_each['status']=="cancel_by_cl"){
					echo  "<th>cancel after close</th>";
				}
				elseif($all_line_info_each['status']=="cancel_by_re"){
					echo  "<th>cancel by user</th>";
				}
				elseif($all_line_info_each['status']=="cancel_by_st"){
					echo  "<th>cancel by store</th>";
				}
				elseif($all_line_info_each['status']=="can_go_in"){
					echo  "<th>can check in</th>";
					
				}
				elseif($all_line_info_each['status']=="late"){
					echo  "<th>".$all_line_info_each['status']."</th>";
					
				}
				else{
					echo  "<th>".$all_line_info_each['status']."</th>";
				}


				
				if($all_line_info_each['cancel_time']=="1980-01-01 00:00:00"){
					echo "<th>-</th>";
				}
				else{
					echo "<th>".$all_line_info_each['cancel_time']."</th>";
				}
				if($all_line_info_each['previous_scanned_time']=="00:00:00"){
					echo "<th>-</th>";
				}
				else{
					echo "<th>".$all_line_info_each['previous_scanned_time']."</th>";
				}
                echo "<th>".$all_line_info_each['reserve_upload_time']."</th>";

                echo "</tr>";
				$after_num++;
			

		}
		echo "</table><br></div>";

		
	


?>


</div>
<script>
function wholemanu() {
    document.getElementsByClassName("topnav")[0].classList.toggle("responsive");
}
</script>
	
<script src="dropdown.js"></script>

</body>
</html>