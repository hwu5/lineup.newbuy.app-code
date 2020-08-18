<?php session_start();
    include('conn.php');
    if(isset($_POST["submit_of_authorize"])){

        if($_POST["password_of_authorize"]=="our23yrh34uhfbcelucago3i32hrnnwoifefio4"){
            for ($i=0; $i < $_POST["number_of_authorize"]; $i++) { 
                $rand_pass=rand(0,9999999999);
                $sql="INSERT INTO 1_lineup(password)
                    VALUES('$rand_pass') ";
                
                if (mysqli_query($conn, $sql)){
                    echo 'good';
        
                }
                else{
                    //don't work
                    echo 'query error:' . mysqli_error($conn);
                }
            }
        }

    }

    if(isset($_POST["submit_of_pull"])){

        if($_POST["password_of_authorize"]=="328nhfu888lhefdsajuyewfjuf78934qhf783haufewefgwegrjhegoebgf"){
            $number_of_pull=$_POST["number_of_pull"];
            echo $number_of_pull;
            $sql = "SELECT * FROM 1_lineup 
                WHERE taken_or_not='N'
                LIMIT $number_of_pull";
            //make query & get result
            $pull_result = mysqli_query($conn, $sql);
            //fetch resulting rows as an array
            $pull_array = mysqli_fetch_all($pull_result, MYSQLI_ASSOC);
            $pull_id0=$pull_array[0]["author_id"];
            $sql = "UPDATE 1_lineup SET taken_or_not='Y'
                WHERE author_id=$pull_id0";
            
            if(count($pull_array)>1){
                echo "<br>".$pull_array[0]["password"];
                for ($i=1; $i < count($pull_array); $i++) {
                    
                    $sql=$sql." OR author_id=".$pull_array[$i]["author_id"];

                    echo "<br>".$pull_array[$i]["password"];

                }
            }
            else{
                echo $pull_array[0]["password"];
            }
                
            

            
        }
        
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
<form method="POST">
    <input type="password" name="password_of_authorize"><br>
    <input type="text" name="number_of_authorize"><br>
    <input type="submit" name="submit_of_authorize"  value="go"><br>
</form><br><br>
<form method="POST">
    <input type="password" name="password_of_authorize"><br>
    <input type="text" name="number_of_pull"><br>
    <input type="submit" name="submit_of_pull"  value="pull"><br>
</form>
</head>
<body>
