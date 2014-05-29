<?php
include_once("../scripts/connect_to_database.php");
session_start();
if(isset($_SESSION['id'])){
$username = $_SESSION['username'];
$password = $_SESSION['password'];
$owner = $_GET['id'];
$id = $_SESSION['id'];
$owner_name = "";


$data = mysqli_fetch_array(mysqli_query($conn ,"SELECT password,country,bio,username FROM users WHERE id=\"$owner\""), MYSQLI_ASSOC);

$bio = $data['bio'];
$nationality = $data['country'];
$owner_name = $data['username'];
	if($data['password'] == $password && $data['username'] == $username){
	$links = '
		<a href="privat_profile.php?id=' . $owner . '">Privat Profile</a>
		<br>
		<a href="change_settings.php">Change Settings</a>';
	}else{
	$links = '
		<a href="public_profile.php?id=' . $id . '">My Profile</a>';	
	}
}else{
	header("Location:../index.php");
}

?>



<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo($owner_name); ?>'s Public Profile | Anhilation - Domination</title>
</head>
<body>
<h1><?php echo($owner_name); ?></h1>
<br>
<h3><?php echo($nationality); ?></h3>
<br>
<p><?php echo($bio); ?></p>
<br>
<span><?php echo($links); ?></span>
</body>
</html>