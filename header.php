<?php

if(!isset($_SESSION['session_username'])|| (trim($_SESSION['session_username']) == ''))
{

	$isLoggedIn = false;
}	
else
{
	$isLoggedIn = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="style.css" type="text/css">
	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
	<script>(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=357701981035869";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>


</head>
<header>
	<div class="logo">
		<a target="_blank" href="about.php"><h2 class="toodledo"> ToodLedo!</h2></a>
	</div>
	
	<nav>
		
		<ul id="menu">
			<li>
				<a <?php if ($current_page == "home") { ?>class="selected"<?php } ?> href="about.php">Home</a>
			</li>
			<li><a <?php if ($current_page == "contact") { ?>class="selected"<?php } ?>  href="contact.php">Contact</a>

				
			</li>
			
			<?php 
			if(!isset($_SESSION['session_username'])|| (trim($_SESSION['session_username']) == ''))
			{
				
				if($current_page == "register")
				{
					echo "<li><a class=\"selected\" href=\"signUp.php\">Register</a></li>";
					echo "<li><a href=\"login.php\"> Login</a></li>";
				}
				else    		
				{
					if($current_page == "login")
					{
						echo "<li><a href=\"signUp.php\">Register</a></li>";
						echo "<li><a class=\"selected\"  href=\"login.php\"> Login</a></li>";
					}	
					else
					{
						echo "<li><a href=\"signUp.php\">Register</a></li>";
						echo "<li><a  href=\"login.php\"> Login</a></li>";
					}
				}
				
				
			}
			else
			{

				
				if($current_page == "viewTask")
				{
					echo "<li>";
					echo "<a class=\"selected\" href=\"viewTask.php\">Your Tasks</a>";
					echo "<ul class=\"sub-menu\">";
					echo "<li><a href=\"viewTask.php\">Tasks</a></li>";
					echo "<li><a href=\"orderTask.php\">Rank Task</a></li>";
					echo "</ul>";
					echo "</li>";
					echo "<li><a href=\"editProfile.php\"> My Account</a>";

					echo "<ul class=\"sub-menu\">"; 
					echo "<li> <a href=\"editProfile.php\">Edit Profile</a></li>";
					echo "<li><a href=\"logout.php\">Logout</a></li>";
					echo "</ul>";
					echo "</li>";
				}
				else
				{
					if($current_page == "MyAccount")
					{

						echo "<li>";
						echo "<a href=\"viewTask.php\">Your Tasks</a>";
						echo "<ul class=\"sub-menu\">";
						echo "<li><a href=\"viewTask.php\">Tasks</a></li>";
						echo "<li><a href=\"orderTask.php\">Rank Task</a></li>";
						echo "</ul>";
						echo "</li>";
						echo "<li><a class=\"selected\" href=\"#\"> My Account</a>";

						echo "<ul class=\"sub-menu\">"; 
						echo "<li> <a href=\"editProfile.php\">Edit Profile</a></li>";
						echo "<li><a href=\"logout.php\">Logout</a></li>";
						echo "</ul>";
						echo "</li>";

					}else
					{
						echo "<li>";
						echo "<a href=\"viewTask.php\">Your Tasks</a>";
						echo "<ul class=\"sub-menu\">";
						echo "<li><a href=\"viewTask.php\">Tasks</a></li>";
						echo "<li><a href=\"orderTask.php\">Rank Task</a></li>";
						echo "</ul>";
						echo "</li>";
						echo "<li><a href=\"#\"> My Account</a>";

						echo "<ul class=\"sub-menu\">"; 
						echo "<li> <a href=\"editProfile.php\">Edit Profile</a></li>";
						echo "<li><a href=\"logout.php\">Logout</a></li>";
						echo "</ul>";
						echo "</li>";
					}
				}

				echo "<li><a href=\"https://twitter.com/intent/tweet?button_hashtag=toodledo&	text=Check%20out%20this%20awesome%20app!!\" class=\"twitter-hashtag-button\">Tweet #toodledo</a>";
				echo "</li>";
			}
			?>

			<li><div class="fb-like" data-href="http://ToodLedo.com" data-layout="button" data-action="like" data-show-faces="true" data-share="false"></div></li>
			
		</ul>
	</nav>
</header>
</html>