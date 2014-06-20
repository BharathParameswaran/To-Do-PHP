<?php
session_start();
include 'db_connection.php';

if(!isset($_SESSION['session_username'])|| (trim($_SESSION['session_username']) == ''))
{
	header('Location: login.php');	
	exit;
}
$session_username = $_SESSION['session_username'];

if($_SERVER['REQUEST_METHOD']=='POST')
{

	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$password = $_POST['password'];
	$phoneNumber = $_POST['phoneNumber'];
	$emailAddress = $_POST['emailAddress'];
	$gender = $_POST['gender'];

	$query = "UPDATE \"USER\" SET first_name=$1, last_name=$2,password=$3,phone_number=$4,email_address=$5,gender=$6 where user_name=$7";
	$result = pg_prepare($con, "update_user_data", $query);
	$result = pg_execute($con, "update_user_data", array($firstName,$lastName,$password,$phoneNumber,$emailAddress,$gender,$session_username));
	if($result)
	{
		header('Location:editProfile.php');
	}
	else{
		header('Location:login.php');
	}	
}
else
{
	$query = "SELECT * from \"USER\" where user_name = $1";
	$result = pg_prepare($con, "user_data_retrive", $query);;
	$result = pg_execute($con, "user_data_retrive", array($session_username));
	if($result)
	{
		$row = pg_fetch_row($result);
		
		$id = $row[0];
		$firstName = $row[1];
		$lastName = $row[2];
		$userName = $row[3];
		$password = $row[4];
		$phoneNumber = $row[5];
		$emailAddress = $row[6];
		$gender = $row[7];
		if($gender == "Male")
			$isMale  =true;
		else
			$isFemale = true;

	}
	else
	{

	}
}
?>
<html>
<head>
	<title>ToodLedo|Edit Profile</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="description" content="" />
	<meta name="keywords" content="" />		
</head>
<div class="header-wrap">
	<?php $current_page = "MyAccount"; include 'header.php';?>
</div>
<section>
	<div class="content">
		<p class="content_header">Edit Profile</p>
		<form action="editProfile.php" method="POST">
			<br>
			<label class="details">Name</label> </br>
			<input type="text" class="textbox"  name="firstName"  value="<?php echo $firstName; ?>" required="required" autofocus="autofocus" placeholder="First name"/>			
			<input type="text" class="textbox" name="lastName"  value="<?php echo $lastName; ?>" required="required" placeholder="Last name"/> </br>
			<br>
			<label class="details">Choose your User Name</label> </br>
			<input type="text" class="textbox" name="userName"  value="<?php echo $userName; ?>" readonly ="readonly" required="required" /></br>
			<br>
			<label class="details">Create a password</label></br>
			<input type="password" class="textbox" name="password"  value="<?php echo $password; ?>" required="required"  pattern="[a-zA-Z0-9]{6,}" placeholder="Min 6 Characters"/></br>
			<br>
			<label class="details">Confirm your password</label></br>
			<input type="password" class="textbox" name="confirmPassword"  value="<?php echo $password; ?>" required="required" pattern="[a-zA-Z0-9]{6,}" /></br>
			<br>
			<label class="details">Email Address</label></br>
			<input type="text" class="textbox" name="emailAddress"  value="<?php echo $emailAddress; ?>" required="required" /></br>
			<br>
			<label class="details">Mobile</label></br>
			<input type="text" class="textbox" name="phoneNumber" value="<?php echo $phoneNumber; ?>"/></br>
			<br>
			<label class="details">Gender:</label></br>
			<input type="radio" name="gender" value="female" <?php echo($isFemale?'checked="checked"':'');?> > <label class="details">Female</label>
			<input type="radio" name="gender" value="male"  <?php echo($isMale?'checked="checked"':''); ?>> <label class="details"> Male </label> </br>
			<br>
			<input type="submit" class="button_submit" value="Update"/>
		</form>
	</div>
</section>
</body>
<?php include 'footer.php';?>
</html>