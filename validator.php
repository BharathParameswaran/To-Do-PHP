<?php
session_start();
include 'db_connection.php';
ob_start();
$userName = $_POST['userName'];
$pass = $_POST['password'];
$iserrormessage=false;

$query = "SELECT password FROM \"USER\" where user_name = $1"; 
$result = pg_prepare($con, "user_login_check", $query);
$result = pg_execute($con, "user_login_check", array($userName));
$count  = pg_num_rows($result);

if($result)
{
	while($row = pg_fetch_row($result))
	{
		
		if($row[0] == $pass)
		{
			// echo "Successful Login";
			 //session_regenerate_id();
			 $_SESSION['session_username'] = $userName;
			 session_write_close();
			 //header('Location: taskViewer.php');	
			//exit;
		}
		else
		{
			$iserrormessage=true;
			$errorMessage = "Invalid user name or password";
			//header('Location: login.php');
			//exit;
			//die ("Invalid User Name or password\n"); 	
		}
		
	}
}
if( $count == '0')
{
	//echo " Login";	
	$iserrormessage=true;
	$errorMessage = "Invalid user name or password";
	//header('Location: login.php');
	//exit;
	//die ("Invalid User Name or password\n"); 
}

pg_close($con);
?>
