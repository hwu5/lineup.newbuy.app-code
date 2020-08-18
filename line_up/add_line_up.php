<?php 

	include('conn.php');
	
	session_start();
	$site_key="6LdpqvwUAAAAAK1embthzab6LeZSBAkRcNAiDxV0";
	#6LdccPsUAAAAANmLvBK_ttvY0La6A3QHcFyUGK1x
	$sercet_key="6LdpqvwUAAAAAHMfQSkALlY5M-Cq4x9BC-Jx3cjM";
	#6LdccPsUAAAAAMG30_ROFaggmw3eaXEntDRMc4CQ

	$store_total_id=$_SESSION['store_id'];
	$sql2 = "SELECT line_up_name,
	line_id FROM stores_accounts WHERE store_total_id='$store_total_id' ORDER BY line_id";
	
	//make query & get result
	$line_total_result = mysqli_query($conn, $sql2);

	//fetch resulting rows as an array
	$line_total_array = mysqli_fetch_all($line_total_result, MYSQLI_ASSOC);




	if (isset($_POST["add_line_up"])) {


			$line_up_name=mysqli_real_escape_string($conn, $_POST['line_up_name']);
			$manual_shift=mysqli_real_escape_string($conn, $_POST['manual_shift']);
			$active_not_discreet=mysqli_real_escape_string($conn, $_POST['active_not_discreet']);
			$extra_info_line_up=mysqli_real_escape_string($_POST['extra_info_line_up']);

			#Monday
			$Monday_se_hour=$_POST["Monday_se_hour"];
			$Monday_se_minute=$_POST["Monday_se_minute"];
			$Monday_se_second=$_POST["Monday_se_second"];

			$Monday_open_hour=$_POST["Monday_open_hour"];
			$Monday_open_minute=$_POST["Monday_open_minute"];
			$Monday_open_second=$_POST["Monday_open_second"];

			$Monday_close_hour=$_POST["Monday_close_hour"];
			$Monday_close_minute=$_POST["Monday_close_minute"];
			$Monday_close_second=$_POST["Monday_close_second"];

			#Tuesday
			$Tuesday_se_hour=$_POST["Tuesday_se_hour"];
			$Tuesday_se_minute=$_POST["Tuesday_se_minute"];
			$Tuesday_se_second=$_POST["Tuesday_se_second"];

			$Tuesday_open_hour=$_POST["Tuesday_open_hour"];
			$Tuesday_open_minute=$_POST["Tuesday_open_minute"];
			$Tuesday_open_second=$_POST["Tuesday_open_second"];

			$Tuesday_close_hour=$_POST["Tuesday_close_hour"];
			$Tuesday_close_minute=$_POST["Tuesday_close_minute"];
			$Tuesday_close_second=$_POST["Tuesday_close_second"];

			#Wednesday
			$Tuesday_se_hour=$_POST["Tuesday_se_hour"];
			$Tuesday_se_minute=$_POST["Tuesday_se_minute"];
			$Tuesday_se_second=$_POST["Tuesday_se_second"];

			$Tuesday_open_hour=$_POST["Tuesday_open_hour"];
			$Tuesday_open_minute=$_POST["Tuesday_open_minute"];
			$Tuesday_open_second=$_POST["Tuesday_open_second"];

			$Tuesday_close_hour=$_POST["Tuesday_close_hour"];
			$Tuesday_close_minute=$_POST["Tuesday_close_minute"];
			$Tuesday_close_second=$_POST["Tuesday_close_second"];

			#Wednesday
			$Wednesday_se_hour=$_POST["Wednesday_se_hour"];
			$Wednesday_se_minute=$_POST["Wednesday_se_minute"];
			$Wednesday_se_second=$_POST["Wednesday_se_second"];

			$Wednesday_open_hour=$_POST["Wednesday_open_hour"];
			$Wednesday_open_minute=$_POST["Wednesday_open_minute"];
			$Wednesday_open_second=$_POST["Wednesday_open_second"];

			$Wednesday_close_hour=$_POST["Wednesday_close_hour"];
			$Wednesday_close_minute=$_POST["Wednesday_close_minute"];
			$Wednesday_close_second=$_POST["Wednesday_close_second"];

			#Thursday
			$Thursday_se_hour=$_POST["Thursday_se_hour"];
			$Thursday_se_minute=$_POST["Thursday_se_minute"];
			$Thursday_se_second=$_POST["Thursday_se_second"];

			$Thursday_open_hour=$_POST["Thursday_open_hour"];
			$Thursday_open_minute=$_POST["Thursday_open_minute"];
			$Thursday_open_second=$_POST["Thursday_open_second"];

			$Thursday_close_hour=$_POST["Thursday_close_hour"];
			$Thursday_close_minute=$_POST["Thursday_close_minute"];
			$Thursday_close_second=$_POST["Thursday_close_second"];

			#Friday
			$Friday_se_hour=$_POST["Friday_se_hour"];
			$Friday_se_minute=$_POST["Friday_se_minute"];
			$Friday_se_second=$_POST["Friday_se_second"];

			$Friday_open_hour=$_POST["Friday_open_hour"];
			$Friday_open_minute=$_POST["Friday_open_minute"];
			$Friday_open_second=$_POST["Friday_open_second"];

			$Friday_close_hour=$_POST["Friday_close_hour"];
			$Friday_close_minute=$_POST["Friday_close_minute"];
			$Friday_close_second=$_POST["Friday_close_second"];

			#Saturday
			$Saturday_se_hour=$_POST["Saturday_se_hour"];
			$Saturday_se_minute=$_POST["Saturday_se_minute"];
			$Saturday_se_second=$_POST["Saturday_se_second"];

			$Saturday_open_hour=$_POST["Saturday_open_hour"];
			$Saturday_open_minute=$_POST["Saturday_open_minute"];
			$Saturday_open_second=$_POST["Saturday_open_second"];

			$Saturday_close_hour=$_POST["Saturday_close_hour"];
			$Saturday_close_minute=$_POST["Saturday_close_minute"];
			$Saturday_close_second=$_POST["Saturday_close_second"];

			#Sunday
			$Sunday_se_hour=$_POST["Sunday_se_hour"];
			$Sunday_se_minute=$_POST["Sunday_se_minute"];
			$Sunday_se_second=$_POST["Sunday_se_second"];

			$Sunday_open_hour=$_POST["Sunday_open_hour"];
			$Sunday_open_minute=$_POST["Sunday_open_minute"];
			$Sunday_open_second=$_POST["Sunday_open_second"];

			$Sunday_close_hour=$_POST["Sunday_close_hour"];
			$Sunday_close_minute=$_POST["Sunday_close_minute"];
			$Sunday_close_second=$_POST["Sunday_close_second"];

			$be_hour=$_POST["between_scan_hour"];
			$be_minute=$_POST["between_scan_minute"];
			$be_second=$_POST["between_scan_second"];

			$to_hour=$_POST["total_tolerance_hour"];
			$to_minute=$_POST["total_tolerance_minute"];
			$to_second=$_POST["total_tolerance_second"];

			

			$update_between_scan_time=$be_hour.":".$be_minute.":".$be_second;
			$update_total_tolerance_time=$to_hour.":".$to_minute.":".$to_second;
			

			$Monday_se_time=$Monday_se_hour.":".$Monday_se_minute.":".$Monday_se_second;
			$Monday_open_time=$Monday_open_hour.":".$Monday_open_minute.":".$Monday_open_second;
			$Monday_close_time=$Monday_close_hour.":".$Monday_close_minute.":".$Monday_close_second;

			$Tuesday_se_time=$Tuesday_se_hour.":".$Tuesday_se_minute.":".$Tuesday_se_second;
			$Tuesday_open_time=$Tuesday_open_hour.":".$Tuesday_open_minute.":".$Tuesday_open_second;
			$Tuesday_close_time=$Tuesday_close_hour.":".$Tuesday_close_minute.":".$Tuesday_close_second;

			$Wednesday_se_time=$Wednesday_se_hour.":".$Wednesday_se_minute.":".$Wednesday_se_second;
			$Wednesday_open_time=$Wednesday_open_hour.":".$Wednesday_open_minute.":".$Wednesday_open_second;
			$Wednesday_close_time=$Wednesday_close_hour.":".$Wednesday_close_minute.":".$Wednesday_close_second;

			$Thursday_se_time=$Thursday_se_hour.":".$Thursday_se_minute.":".$Thursday_se_second;
			$Thursday_open_time=$Thursday_open_hour.":".$Thursday_open_minute.":".$Thursday_open_second;
			$Thursday_close_time=$Thursday_close_hour.":".$Thursday_close_minute.":".$Thursday_close_second;

			$Friday_se_time=$Friday_se_hour.":".$Friday_se_minute.":".$Friday_se_second;
			$Friday_open_time=$Friday_open_hour.":".$Friday_open_minute.":".$Friday_open_second;
			$Friday_close_time=$Friday_close_hour.":".$Friday_close_minute.":".$Friday_close_second;

			$Saturday_se_time=$Saturday_se_hour.":".$Saturday_se_minute.":".$Saturday_se_second;
			$Saturday_open_time=$Saturday_open_hour.":".$Saturday_open_minute.":".$Saturday_open_second;
			$Saturday_close_time=$Saturday_close_hour.":".$Saturday_close_minute.":".$Saturday_close_second;

			$Sunday_se_time=$Sunday_se_hour.":".$Sunday_se_minute.":".$Sunday_se_second;
			$Sunday_open_time=$Sunday_open_hour.":".$Sunday_open_minute.":".$Sunday_open_second;
			$Sunday_close_time=$Sunday_close_hour.":".$Sunday_close_minute.":".$Sunday_close_second;

			if(isset($_POST["Monday_if_open"])){
				$Monday_if_open="Y";
			}
			else{
				$Monday_if_open="N";
			}

			if(isset($_POST["Tuesday_if_open"])){
				$Tuesday_if_open="Y";
			}
			else{
				$Tuesday_if_open="N";
			}

			if(isset($_POST["Wednesday_if_open"])){
				$Wednesday_if_open="Y";
			}
			else{
				$Wednesday_if_open="N";
			}

			if(isset($_POST["Thursday_if_open"])){
				$Thursday_if_open="Y";
			}
			else{
				$Thursday_if_open="N";
			}

			if(isset($_POST["Friday_if_open"])){
				$Friday_if_open="Y";
			}
			else{
				$Friday_if_open="N";
			}

			if(isset($_POST["Saturday_if_open"])){
				$Saturday_if_open="Y";
			}
			else{
				$Saturday_if_open="N";
			}

			if(isset($_POST["Sunday_if_open"])){
				$Sunday_if_open="Y";
			}
			else{
				$Sunday_if_open="N";
			}

			if($manual_shift=="Y"){
				$between_scan_time=date("H:i:s",mktime($_POST["between_scan_hour"],$_POST["between_scan_minute"],$_POST["between_scan_second"]));
			}
			else{
				$between_scan_time=date("H:i:s",mktime($_POST["between_scan_hour"],$_POST["between_scan_minute"],$_POST["between_scan_second"]));
			}

			$max_reserve=$_POST["max_reserve_num"];

			$top_not_discreet=$_POST["top_not_discreet_input"];
			
			$active_or_not=$_POST["active_status"];

			$store_id=$_SESSION["store_id"];
			$store_name=$_SESSION["store_name"];
			
			$total_tolerance_time=date("H:i:s",mktime($_POST["total_tolerance_hour"],$_POST["total_tolerance_minute"],$_POST["total_tolerance_second"]));
			
			$clear_preserve=$_POST["clear_preserve"];

			$sql = "INSERT INTO stores_accounts(store_total_id, 
				store_name, line_up_name,
				active_or_not,
				top_not_discreet,
				max_reserve,
				total_tolerance_time, 
				between_scan_time, clear_preserve, manual_shift, active_not_discreet, extra_info, 
				open_time_Monday,
				open_time_Tuesday,
				open_time_Wednesday,
				open_time_Thursday,
				open_time_Friday,
				open_time_Saturday,
				open_time_Sunday,
				close_time_Monday,
				close_time_Tuesday,
				close_time_Wednesday,
				close_time_Thursday,
				close_time_Friday,
				close_time_Saturday,
				close_time_Sunday,
				senior_time_after_open_Monday,
				senior_time_after_open_Tuesday,
				senior_time_after_open_Wednesday,
				senior_time_after_open_Thursday,
				senior_time_after_open_Friday,
				senior_time_after_open_Saturday,
				senior_time_after_open_Sunday,
				open_Monday,
				open_Tuesday,
				open_Wednesday,
				open_Thursday,
				open_Friday,
				open_Saturday,
				open_Sunday
				) 
					VALUES($store_id, '$store_name', '$line_up_name','$active_or_not', '$top_not_discreet','$max_reserve','$total_tolerance_time', 
					'$between_scan_time', '$clear_preserve', '$manual_shift', '$active_not_discreet', '$extra_info_line_up',
					'$Monday_open_time',
					'$Tuesday_open_time',
					'$Wednesday_open_time',
					'$Thursday_open_time',
					'$Friday_open_time',
					'$Saturday_open_time',
					'$Sunday_open_time',
					'$Monday_close_time',
					'$Tuesday_close_time',
					'$Wednesday_close_time',
					'$Thursday_close_time',
					'$Friday_close_time',
					'$Saturday_close_time',
					'$Sunday_close_time',
					'$Monday_se_time',
					'$Tuesday_se_time',
					'$Wednesday_se_time',
					'$Thursday_se_time',
					'$Friday_se_time',
					'$Saturday_se_time',
					'$Sunday_se_time',
					'$Monday_if_open',
					'$Tuesday_if_open',
					'$Wednesday_if_open',
					'$Thursday_if_open',
					'$Friday_if_open',
					'$Saturday_if_open',
					'$Sunday_if_open') ";

			if (mysqli_query($conn, $sql)){
				echo "<script>alert('Good')</script>";
				#header("location: mon_pick_line.php");
			}
			else{
				#echo 'query error:' . mysqli_error($conn);
				echo "<script>alert('query error:'". mysqli_error($conn).")</script>";
			}


			



	}
	
?>





<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<title></title>
<style>
@import "new_menu_test_templ.css";
@import "dropdown.css";
@import "cust_menu.css";
table, th, td {
  border: 1px solid black;
}
body {
  font-family: Arial, Helvetica, sans-serif;
  background-color: #333;
}
.middle{
	
	padding-left: 10px;
	padding-right: 10px;

	
	background-color: White;

	/*border-color: #333;
	border-top-style: none;
	border-right-style: solid;
	border-bottom-style: none;
	border-left-style: solid;
	border-width: 80px;*/

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
<script src="https://www.google.com/recaptcha/api.js?render=<?php echo $site_key; ?>"></script>
</head>
<body>

<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>


<?php
	echo "<ul class='topnav' id='topnav'>
	<li><a href='all_lineup_this_store.php'>Preserve history</a></li>
	<li><a style='background-color: #4CAF50' href='add_line_up.php'>Add a line</a></li>
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

	</ul>";

	echo "<div class='middle'><br>";

						
	#echo $_SESSION["store_in"];
	

	
	
	if (isset($_POST["finish"])) {
		$header_location="Location: mon_pick_line.php";
		header($header_location);
	}

	if(isset($_SESSION["store_in"])){
		if($_SESSION["store_in"]=="YES"){
			$weeks=["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];

			echo "<form class='white' action='add_line_up.php' method='POST'>
					<label>line name:</label>
					<input type='text' name='line_up_name'><br><br>
					<label>active status</label>
					<select name='active_status'>
						<option value='active'>active</option>
						<option value='not_active'>not active</option>
					</select><br><br>
					<label>max preserve per day per person</label>
					<input type='text' name='max_reserve_num'><br><br>
					<label>active stand by</label>
					<select id='active_not_discreet' name='active_not_discreet'>
						<option value='Y'>Yes</option>
						<option value='N'>No</option>
					</select><br><br>
					<label>max stand by</label>
					<input type='text' name='top_not_discreet_input'><br><br>
					<label>clear preserve</label>
					<select id='clear_preserve' name='clear_preserve'>
					<option value='Y'>Yes</option>
					<option value='N'>No</option>
					</select><br><br>
					<label>manual shift</label>
					<select id='manual_shift' name='manual_shift'>
						<option value='N'>NO</option>
						<option value='Y'>YES</option>
					</select><br><br>";
			

					
			
			
			echo "<label>between scan time</label>
			<select id='between_scan_hour' name='between_scan_hour'>";
								
			for($j=0; $j<=23; $j++){
				echo "<option value='".$j."'>".$j."</option>";
			}
			echo "</select>:

					<select id='between_scan_minute' name='between_scan_minute'>";
							
			for($j=0; $j<=59; $j++){
				echo "<option value='".$j."'>".$j."</option>";
			}
			echo "</select>:

					<select id='between_scan_second' name='between_scan_second'>";
							
			for($j=0; $j<=59; $j++){
				echo "<option value='".$j."'>".$j."</option>";
			}
			echo "</select>
					<br>";


			echo "<br>
			<label>total tolerance time</label>
			<select id='total_tolerance_hour' name='total_tolerance_hour'>";
										
			for($j=0; $j<=23; $j++){
				echo "<option value='".$j."'>".$j."</option>";
			}
			echo "</select>:

					<select id='total_tolerance_minute' name='total_tolerance_minute'>";
							
			for($j=0; $j<=59; $j++){
				echo "<option value='".$j."'>".$j."</option>";
			}
			echo "</select>:

					<select id='total_tolerance_second' name='total_tolerance_second'>";
							
			for($j=0; $j<=59; $j++){
				echo "<option value='".$j."'>".$j."</option>";
			}
			echo "</select><br><br>";

			
			echo "<table>";

			echo "<tr><th></th><th>senior and disability time</th><th>open time</th><th>close time</th></tr>";

			foreach ($weeks as $week) {
			
			echo "<tr>";
			
			echo "<th><input name='".$week."_if_open' type='checkbox' value='Y' style='float: right;'><b style='float: left;'>".$week.":</b></th>
										
				<th><select id='hour' name='".$week."_se_hour'>";
								
				
				for($j=0; $j<=23; $j++){
					echo "<option value='".$j."'>".$j."</option>";
				
				}
				echo "</select>:
	
				<select id='minute' name='".$week."_se_minute'>";
				
				
				for($j=0; $j<=59; $j++){
					echo "<option value='".$j."'>".$j."</option>";
				}
				echo "</select>:
	
				<select id='second' name='".$week."_se_second'>";
	
				
								
				for($j=0; $j<=59; $j++){
					echo "<option value='".$j."'>".$j."</option>";
				}
				echo "</select></th>";
				
				
				echo "<th>
										
				<select id='hour' name='".$week."_open_hour'>";
							
				
				for($j=0; $j<=23; $j++){
					echo "<option value='".$j."'>".$j."</option>";
				
				}
				echo "</select>:
	
				<select id='minute' name='".$week."_open_minute'>";
				
				
				for($j=0; $j<=59; $j++){
					echo "<option value='".$j."'>".$j."</option>";
				}
				echo "</select>:
	
				<select id='second' name='".$week."_open_second'>";
	
								
				for($j=0; $j<=59; $j++){
					echo "<option value='".$j."'>".$j."</option>";
				}
				echo "</select></th>";

				
				
				echo "<th>
										
				<select id='hour' name='".$week."_close_hour'>";
				
				for($j=0; $j<=23; $j++){
					echo "<option value='".$j."'>".$j."</option>";
				
				}
				echo "</select>:
	
				<select id='minute' name='".$week."_close_minute'>";
				
				
				for($j=0; $j<=59; $j++){
					echo "<option value='".$j."'>".$j."</option>";
				}
				echo "</select>:
	
				<select id='second' name='".$week."_close_second'>";
	
								
				for($j=0; $j<=59; $j++){
					echo "<option value='".$j."'>".$j."</option>";
				}
				echo "</select>";

				echo "</th>";
				
				echo "</tr>";

		}
		echo "</table>";
				echo "
					<br>

					

					

					

					<label>extra info:</label><br>
					<textarea name='extra_info_line_up'  style='font-family: Arial'></textarea><br><br>
					<input type='hidden' id='g-recaptcha-response' name='g-recaptcha-response'>
						<div class='center'>
							<input type='submit' class='submit' name='add_line_up' value='add line'>
							<input type='submit' class='submit' name='finish' value='finish'>
						</div>
					";
		}
	}

		

?>
		

</form>
<script>
    grecaptcha.ready(function(){
        grecaptcha.execute("<?php echo $site_key; ?>", {action: "homepage"})
        .then(function(token){
            //console.log(token);
            document.getElementById("g-recaptcha-response").value=token;
        });
    });
</script>
<script>
function wholemanu() {
    document.getElementsByClassName("topnav")[0].classList.toggle("responsive");
}
</script>
	
<script src="dropdown.js"></script>
<br><br>
</div>
</body>