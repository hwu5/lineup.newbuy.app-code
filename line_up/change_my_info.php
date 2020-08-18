<!DOCTYPE html>
<html>
<head>
	<title>Change info</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
@import "new_menu_test_templ.css";
@import "dropdown.css";
@import "cust_menu.css";
@import "login_signup.css";
body {
  font-family: Arial, Helvetica, sans-serif;
}
h1{
	color: #4a4a4a;
}
.list{
	padding-left: 10px;
  padding-right: 10px;
}
.unlognavbar {
  overflow: hidden;
  opacity: 1;
}

.unlognavbar a {
  float: right;
  font-size: 16px;
  color: #314025;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}
.unlognavbar a:hover {
  background-color: #4CAF50;
  color: White;
}


.active {
    color: White;
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
	border-radius: 8px;
}
.container-grey-text{
	margin:auto;
	
	
	margin: auto;
}
@media screen and (max-width:680px) {
	.submit{
		border-radius: 5px;
	}
	
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
    session_start();
	include('conn.php');
		if(isset($_SESSION["customer_id"])){
			$customer_id=$_SESSION["customer_id"];
            /*echo "<div class='navbar'>
			<a href='index.php'>Home</a>
			<a href='profi.php?customer_id=". $customer_id."'>My preserves</a>
			<a href='storelist.php'>Find a store</a>
            <a href='profi_history.php?customer_id=". $customer_id."'>History preserves</a>
			<a href='change_my_info.php?customer_id=". $customer_id."'>Change info</a></div>";*/
			

			echo "<ul class='topnav'>
			
			<li><a href='index.php'>Home</a></li>
			<li><a href='profi.php?customer_id=". $customer_id."'>My preserves</a></li>
			<li><a href='storelist.php'>Find a store</a></li>
			<li><a href='profi_history.php?customer_id=". $customer_id."'>History preserves</a></li>
			<li><a style='background-color: #4CAF50;' href='change_my_info.php?customer_id=". $customer_id."'>Change info</a></li>
			<li><a href='tutorial.php'>Tutorial</a></li>

			<li class='icon'>
				<a href='javascript:void(0);' style='font-size:15px;' onclick='wholemanu()'>☰</a>
			</li>

			</ul>
			
			
			";
		}
		else{
			echo "<div class='unlognavbar'>";
            echo "<a href='sign_up.php'>Sign up</a>";
			echo "<a href='login_customer.php'>Log in</a>
			<a href='tutorial.php'>Tutorial</a>";
			echo "</div>";
		}
			
	?>

<div class='list'>

	<div class="container-grey-text">
		<h1>Change my info</h1>

			<div style="color: red;">

<?php  
    //echo "Hello, boujour";

    if (isset($_SESSION["customer_id"])) {
        $customer_id=$_SESSION["customer_id"];
		$sql = "SELECT * FROM customer_accounts WHERE customer_id='$customer_id'
		LIMIT 1";

        $accinfo_result = mysqli_query($conn, $sql);

        //fetch resulting rows as an array
        $accinfo_array = mysqli_fetch_all($accinfo_result, MYSQLI_ASSOC);

        #echo "get got";
        $actual_link = "$_SERVER[REQUEST_URI]";

    }
    else{
        #echo "get not got";
    }
    
	if (isset($_POST['submit'])) {


			

			$Email=mysqli_real_escape_string($conn, $_POST['Email']);
			$phone_number=mysqli_real_escape_string($conn, $_POST['phone_number']);
			$personal_sit=mysqli_real_escape_string($conn, $_POST['personal_sit']);
			if(isset($_POST['disability'])){
				$disability=mysqli_real_escape_string($conn, $_POST['disability']);
			}
			else{
				$disability="N";
			}
			if(isset($_POST['senior'])){
				$senior=mysqli_real_escape_string($conn, $_POST['senior']);
			}
			else{
				$senior="N";
			}

			$update_info='good';


			if (empty($Email)) {
				$update_info='bad';
				echo "E-mail can not be empty!<br>";
			}
			elseif (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
				$update_info='bad';
				echo "Please type in a valid E-mail address<br>";
			}

			if (empty($postcode)) {
				$postcode="no post code";
				
			}
			elseif (preg_match('/^[a-zA-Z1-9]$/', $postcode) || strlen($postcode)!=6) {

				$update_info='bad';
				echo "Please enter a vaild postcode!<br>";
			}

			if (!empty($phone_number)) {
				if (strlen($phone_number) != 10) {
					$update_info='bad';
					echo "Please enter a vaild phone number!<br>";
				}
				
			}
			else{
				echo "Please enter your phone number so stores can reach you if there is an emergency!<br>";
				$signup_info='bad';
			}
			
			echo $update_info;



			if($update_info=='good'){

				$sql = "UPDATE customer_accounts SET 
                    email='$Email', disability='$disability', senior='$senior', 
                    personal_sit='$personal_sit', phone_number='$phone_number'
                    WHERE customer_id='$customer_id'";

				if (mysqli_query($conn, $sql)){
					#echo 'change successful';
					header("Refresh:0");
				}
				else{
					//don't work
					echo 'query error:' . mysqli_error($conn);
				}
			 }	

    }
    


?>

</div>

<?php 
	if(isset($_SESSION["customer_id"])){
		
		echo "<form class='white' action='".   $actual_link. "' method='POST'>
				<label>".$accinfo_array[0]["user_name"]."<br>ID ".$accinfo_array[0]['customer_id']."</label><br><br>
				<input name='senior' type='checkbox' value='Y' "; 
					if($accinfo_array[0]["senior"]=="Y"){
						echo "checked";
					}
				echo ">I am a senior<br><br>
				<input name='disability' type='checkbox' value='Y'"; 
					if($accinfo_array[0]["disability"]=="Y"){
						echo "checked";
					}
				echo ">I have disabililty(s)<br><br>
				<label>E-mail:</label>
				<input type='E-mail' name='Email' value='" .$accinfo_array[0]["email"]. "'><br><br>
				<label>phone number:</label>
				<input type='text' name='phone_number' value='" .$accinfo_array[0]["phone_number"] ."'><br><br>
				<label>current health:</label>
				<select id='personal_sit' name='personal_sit'>
					<option value='". $accinfo_array[0]["personal_sit"]."'>
						".$accinfo_array[0]["personal_sit"]."
					</option>
					<option value='Do not want to tell'>Do not want to tell</option>
					<option value='Healthy'>Healthy</option>
					<option value='Having cold or flu'>Having cold or flu</option>
				</select><br><br>
				<div class='center'>
					<input type='submit' name='submit' value='Update' class='submit'>
				</div>
			</form>
		</div>
		</div>";
	}
	else{

	}
?>
<script>
function wholemanu() {
    document.getElementsByClassName("topnav")[0].classList.toggle("responsive");
}
</script>
	
<script src="dropdown.js"></script>
		
</body>
</html>