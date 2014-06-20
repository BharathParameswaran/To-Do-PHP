<?php
include 'db_connection.php';

$userName = $_POST['username'];
$firstName = $_POST['firstName'];
$lastName = $_POST['secondname'];
$password = md5($_POST['password']);
$confirmPassword = md5($_POST['confirmpassword']);
$phoneNumber = $_POST['phone'];
$emailAddress = $_POST['email'];
$iserrormessage = false;

if($password != $confirmPassword)
{
	$iserrormessage = true;
	echo "The passwords must match";
	//echo $errormessage;
}
else 
{
	if (!filter_var($emailAddress, FILTER_VALIDATE_EMAIL))
		{
			$iserrormessage = true;
			echo "E-Mail is not valid";
			//echo $errormessage;
		}

	else	
	{	$query = "SELECT * from \"USERS\" where user_name = $1";
		$result = pg_prepare($con, "user_data_retrive", $query);
		$result = pg_execute($con, "user_data_retrive", array($userName));
		$count = pg_num_rows($result);	
		
		if( $count== '0')
		{
			$query = "INSERT INTO \"USERS\" (first_name,last_name,user_name,password,phone_number,email_address) VALUES($1,$2,$3,$4,$5,$6)";
			$result = pg_prepare($con, "user_signup", $query); 
			$result = pg_execute($con, "user_signup", array($firstName,$lastName,$userName,$password,$phoneNumber,$emailAddress));
			if($result)
			{
				echo "true";
			}
			else
			{
				$iserrormessage = true;
				echo "Account creation unsuccessful";
				//die("Error in creating account");
			}
		}
		if($count == 1)
		{				
				$iserrormessage = true;
				echo "User Name already in use";
				//header('Location:signUp.php');
		}
	}
}
pg_close($con);
?>




