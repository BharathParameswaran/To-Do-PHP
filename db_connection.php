<?php
$host = "localhost"; 
$user = "Bharath"; 
$pass = ""; 
$db = "db1";

$con = pg_connect("host=$host dbname=$db user=$user password=$pass")
    or die ("Invalid User Input\n");

?>