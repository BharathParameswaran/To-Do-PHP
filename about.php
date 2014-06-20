<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">

  <title>ToodLedo|Home</title>
  <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body class="homepage">
  <div class="header-wrap">
    <?php $current_page = "home"; include 'header.php';?>
  </div>
  <section>
    <div class="content">
      <p class="content_header"> Welcome to ToodLedo </p>

      <p class="home_content"> If you're a to-do list beginner or just like keeping it simple, 
       Toodledo is a great way to get on the to-do train. </br><br>
       This free web app comes with pre-set lists that are easy to click on and fill out.</br><br>
       Toodledo creates a "workspace" to organize projects and tasks, rather than just a simple list. 
     </p>

   </div>
 </section>
</body>
<?php include 'footer.php';?>
</html>
