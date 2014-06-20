<?php
ob_start();
if($_SERVER['REQUEST_METHOD']=='POST')
{
	include 'signUpValidator.php';
	$ispost = true;
}
else
{
	$ispost = false;
	$firstName="";
	$lastName="";
	$emailAddress="";
	$phoneNumber="";
}
?>
<!DOCTYPE HTML>
<html>
<head>
	<style>
	label.details
	{
		font: 20px cursive;
		color: black;
	}
	</style>
	<title>ToodLedo|Sign Up</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="description" content="" />
	<meta name="keywords" content="" />		
</head>
<div class="header-wrap">
	<?php $current_page = "register"; include 'header.php';?>
</div>
<section>
	<div class="content">
		<p class="content_header">Create your ToodLedo Account!</p>
		<form action="signUp.php" method="post">
			<br>
			<label class="details">Name</label> </br>
			<input type="text" class="textbox" name="firstName" value="<?php echo $firstName;?>" required="required" autofocus="autofocus" placeholder="First name"/>
			<input type="text" class="textbox" name="lastName"  value="<?php echo $lastName;?>" required="required" placeholder="Last name"/> </br>
			<br>
			<label class="details">Choose your User Name</label> </br>
			<input class="textbox" type="text" name="userName"  required="required" /></br>
			<br>
			<label class="details">Create a password</label></br>
			<input type="password" class="textbox" name="password"  required="required"  pattern="[a-zA-Z0-9]{6,}" placeholder="Min 6 Characters"/></br>
			<br>
			<label class="details">Confirm your password</label></br>
			<input type="password" class="textbox" name="confirmPassword"  required="required" pattern="[a-zA-Z0-9]{6,}" /></br>
			<br>
			<label class="details">Email Address</label></br>
			<input type="text" class="textbox" name="emailAddress"  value="<?php echo $emailAddress;?>" required="required" /></br>
			<br>
			<label class="details">Mobile</label></br>
			<input type="text" class="textbox" name="phoneNumber" value="<?php echo $phoneNumber;?>" pattern="[0-9]{8,}"/></br>
			<br>
			<label class="details">Gender:</label></br>
			<input type="radio" name="gender" value="female"><label  class="details">Female</label>
			<input type="radio" name="gender" value="male"><label  class="details">Male</label> </br>
			<br>
			<input type="submit" class="button_submit"  value="Sign Up"/>
			
			<br>
			<?php


			if($ispost)
			{
				
				if($count ==1 )
				{

					echo "<p>"."User name already in use"."</p>";
				}
				if($iserrormessage)
				{
					echo "<p>".$errormessage."</p>";
				}
				else
				{
					header('Location:login.php');
				}
			}
			
			?>
		</form>
		
	</div>
</section>
</body>
<?php include 'footer.php';?>
</html>