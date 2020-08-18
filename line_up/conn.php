<?php
	//connect
	$conn = mysqli_connect('beep', 'root', 
		'beep', 'Line_up_database');
	//check conection
	
	if(!$conn){
		echo 'Connection error: ' . mysqli_connect_error();
	}

?>