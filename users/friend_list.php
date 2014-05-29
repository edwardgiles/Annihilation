<?php
include_once("../scripts/connect_to_database.php");
session_start();
if(isset($_SESSION['id'])){
$username = $_SESSION['username'];
$password = $_SESSION['password'];
$owner = $_GET['id'];
$id = $_SESSION['id'];
$owner_name = "";

$data = mysqli_fetch_array(mysqli_query($conn ,"SELECT username FROM users WHERE id=\"$owner\""), MYSQLI_ASSOC);
		$friends = fopen("friends" . $data['username'] . ".txt","w+") or die("Non existant");
		$content = fread($friends,1000);
}else{
	header("Location:../index.php");
}
?>
<doctype html>
<html>
<head>
</head>
<body>
<p><?php echo($content); ?></p>
</body>
</html>