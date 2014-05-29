<?php
$db_host = "localhost";
$db_username = "root";
$db_password = "test";
$db_name = "quest";

$conn = mysqli_connect("$db_host","$db_username","$db_password") or die("Error connecting to database");
mysqli_select_db($conn ,"$db_name") or die("No database by that name");
?>