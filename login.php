<?php
session_start();
ob_start();
include 'validator.php';
?>

<!DOCTYPE HTML>
<html>
<head>
	<style>
	
	input {
		border:2.5px solid #e8e9e8;
		
		background:##CC0;
		width:125px;
		/*border-radius:25px; */
		font: 1em comic sans ms;
		color: black;

	}
	
	a{
		padding-left:20px; 
	}
	p.details
	{
		font: 20px cursive;
		color: black;
	}
	</style>
	<title>ToodLedo|Login</title>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="description" content="" />
	<meta name="keywords" content="" />		
</head>
<body>
	<div class="header-wrap">
		<?php $current_page = "login"; include 'header.php';?>
	</div>
	<section>
		<div class="content">
			<p class="content_header"> LOGIN </p>

			<form name='input' action = 'login.php' method = 'post'>
				<p class = "details">Username:</p><input class="textbox" type='text' name='userName' autofocus= "autofocus" value="<?php echo $userName;?>"/> 
				<p class = "details">Password:</p><input class="textbox" type='password' name ='password'  /></br></br>
				<input class="button_submit" type = 'submit' value = "Sign In"/>
				<a href="#" > Forgot Password </a><br><br>
				<?php
				if($_SERVER['REQUEST_METHOD']=='POST')
				{	

					if($iserrormessage)
					{
						echo "<p>".$errorMessage."</p>";
					}	
					else
					{
						header('Location:viewTask.php');
					}
				}
				else
				{
					$userName="";
				}
				?>
			</p>
		</form>	
		<div>
		</section>
	</body>
<?php include 'footer.php';?>
	</html>