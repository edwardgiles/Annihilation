<?php
include_once("../scripts/connect_to_database.php");
$username = $_POST['username'];
$password = $_POST['password_hash'];
$message = "";

$data = mysqli_fetch_array(mysqli_query($conn ,"SELECT password,id,vertified,activation_code FROM users WHERE username=\"$username\""), MYSQLI_ASSOC);
if($data['password'] == hash("sha256", $password)){
	$message = "Your now Logged in";
	session_start();
	$_SESSION['id'] = $data['id'];
	$_SESSION['password'] = $data['password'];
	$_SESSION['username'] = $username;
	if($data['vertified'] == "0"){
		header("Location:email.php");
	}else{
	header("Location:../index.php");
	}
}else{
	$message = "Error Logging in";
}
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Logging in...</title>
</head>
<body>
<p><?php echo($message); ?></p>
</body>
</html>