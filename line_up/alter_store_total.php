<?php session_start();
	include("conn.php");

	if(isset($_SESSION["store_id"])){
		$store_total_id=$_SESSION["store_id"];
		

		$sql2 = "SELECT        
			line_up_name,
			line_id 
			FROM stores_accounts WHERE store_total_id='$store_total_id' ORDER BY line_id";
			
		//make query & get result
		$line_total_result = mysqli_query($conn, $sql2);

		//fetch resulting rows as an array
		$line_total_array = mysqli_fetch_all($line_total_result, MYSQLI_ASSOC);

		


        
        #echo $_SESSION["store_id"];

		//echo "<a href='mon_pick_line.php'>line up over view</a>";
		
		//echo "<h4>line up setting alter</h4>";


		$sql="SELECT * FROM store_total_accounts WHERE store_total_id='$store_total_id'";
		$this_store_info_result = mysqli_query($conn, $sql);
		$this_store_info_array = mysqli_fetch_all($this_store_info_result, MYSQLI_ASSOC);


		$actual_link = "$_SERVER[REQUEST_URI]";
		
		
		
		$store_name=mysqli_real_escape_string($conn, $this_store_info_array[0]['store_name']);
		
        $province=mysqli_real_escape_string($conn, $this_store_info_array[0]['province']);
        
        $city=mysqli_real_escape_string($conn, $this_store_info_array[0]['city']);

        $Email=$this_store_info_array[0]['Email'];

        $postcode=mysqli_real_escape_string($conn, $this_store_info_array[0]['postcode']);

        $address=$this_store_info_array[0]['address'];

        $phone_number=mysqli_real_escape_string($conn, $this_store_info_array[0]['phone_number']);

		$extra_info=$this_store_info_array[0]['extra_info'];
		
	}


	if (isset($_POST["change_total_info"])) {
	
		$store_name=$_POST["store_name"];
		$province=$_POST["province"];
		$city=$_POST["city"];

		$email=$_POST["Email"];
		$postcode=$_POST["postcode"];
		$address=$_POST["address"];

		$phone_number=$_POST["phone_number"];
		$extra_info=$_POST["extra_info"];

		
		

		if($this_store_info_array[0]["store_name"] != $store_name){

			$sql2 = "SELECT COUNT(*) FROM store_total_accounts 
				WHERE store_name='$store_name'
				LIMIT 1";
	
			$same_store_name_num_result = mysqli_query($conn, $sql2);
	
			//fetch resulting rows as an array
			$same_store_name_num_arr = mysqli_fetch_all($same_store_name_num_result, MYSQLI_ASSOC);
	
			$same_store_name_num_number=$same_store_name_num_arr[0]["COUNT(*)"];

			if($same_store_name_num_number==0){

				$sql = "UPDATE stores_accounts SET 
					store_name='$store_name' 
					WHERE store_total_id='$store_total_id'";
							
				if (mysqli_query($conn, $sql)) {
					#echo "change successfully";
					
				} else {
					echo "Error updating record1: " . mysqli_error($conn);
				}

				$sql = "UPDATE store_total_accounts SET 
					store_name='$store_name', 
					province='$province',
					city='$city',
					postcode='$postcode',
					address='$address',
					phone_number='$phone_number',
					extra_info='$extra_info',
					email='$email' 
					WHERE store_total_id='$store_total_id'";
							
				if (mysqli_query($conn, $sql)) {
					#echo "change successfully";
					$_SESSION["store_name"]=$store_name;
					#header("Refresh:0");
				} else {
					echo "Error updating record2: " . mysqli_error($conn);
				}
				
			}
			else{
				echo "<script>alert('this name has been taken')</script>";
			}
			
			
		}
		else{
			$sql = "UPDATE store_total_accounts SET 
					province='$province',
					city='$city',
					postcode='$postcode',
					address='$address',
					phone_number='$phone_number',
					extra_info='$extra_info',
					email='$email' 
					WHERE store_total_id='$store_total_id'";
							
			if (mysqli_query($conn, $sql)) {
				#echo "change successfully";
				
			} else {
				echo "Error updating record3: " . mysqli_error($conn);
			}
		}


		header("Refresh:0");
	
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<title>Change info</title>
<style>
@import "new_menu_test_templ.css";
@import "dropdown.css";
@import "cust_menu.css";
body {
  font-family: Arial, Helvetica, sans-serif;
  
}
.middle{
	
	padding-left: 10px;
	padding-right: 10px;

	
	background-color: White;

	border-color: #333;
	border-top-style: none;
	border-right-style: solid;
	border-bottom-style: none;
	border-left-style: solid;
	border-width: 80px;

}

.active {
  background-color: #4CAF50;
}

.submit{
	font-family: "Roboto", sans-serif;
	text-transform: uppercase;
	outline: 0;
	background: #4CAF50;
	width: 40%;
	border: 0;
	padding: 15px;
	color: #FFFFFF;
	font-size: 14px;
	-webkit-transition: all 0.3 ease;
	transition: all 0.3 ease;
	cursor: pointer;
}

</style>
</head>
<body>
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>




<?php
	
	if(isset($_SESSION["store_id"])){
		$useragent=$_SERVER['HTTP_USER_AGENT'];

		echo "<ul class='topnav' id='topnav'>
		<li><a href='all_lineup_this_store.php'>Preserve history</a></li>
		<li><a href='add_line_up.php'>Add a line</a></li>
		<li><a style='background-color: #4CAF50' href='alter_store_total.php'>Edit store info</a></li>
		
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
		
?>
<div style="padding-left: 10px;">
<?php		

		echo "<div class='container-grey-text'><form class='white' action='".$actual_link."' method='POST'>";
		echo "
			<h4>Change info</h4>
			<label>Store name</label>
            <input name='store_name' type='text' value='".$store_name."'><br><br>
                					
            <label>Province: </label>
            <select id='province' name='province'>";
			echo "<option value='".$province."'>".$province."</option>";
            
            echo "<option value='ON'>ON</option>";
			
            echo "<option value='QC'>QC</option>";
            
            echo "<option value='BC'>BC</option>";
			
			
			echo "</select><br><br>
            <label>city:</label>
			<select id='city' name='city'>";
			
			echo "<option value='".$city."'>".$city."</option>";
			
            echo "<option value='Toronto'>Toronto</option>";
            echo "<option value='Ottawa'>Ottawa</option>";
			
            echo "</select><br><br>
            
            <label>E-mail: </label>
            <input name='Email' type='text' value='".$Email."'><br><br>

            <label>Postcode: </label>
            <input name='postcode' type='text' value='".$postcode."'><br><br>

            <label>address: </label>
            <input name='address' type='text' value='".$address."'><br><br>

            <label>phone number: </label>
            <input name='phone_number' type='text' value='".$phone_number."'><br><br>

			<label>extra information: </label><br>
			
			<textarea name='extra_info'>".$extra_info."</textarea><br><br>
			
			<a href='store_photo_upload.php'>Upload photos</a><br><br>";

				
			echo "<input type='submit' class='submit' name='change_total_info' value='change'>";
		echo "</form><br><br>";

		echo "<img src='https://chart.googleapis.com/chart?cht=qr&chs=300x300&chl=https://lineup.newbuy.app/scan.php?store_total_id=".$store_total_id."'>";
		echo "<br>https://lineup.newbuy.app/scan.php?store_total_id=".$store_total_id."<br><br>";
	}
	
?>

<script>
function wholemanu() {
    document.getElementsByClassName("topnav")[0].classList.toggle("responsive");
}
</script>
	
<script src="dropdown.js"></script>
<br>
</div>
</body>
</html>