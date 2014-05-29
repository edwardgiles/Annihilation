<?php
include_once("../scripts/connect_to_database.php");
$message = "";
session_start();
if(isset($_SESSION['id'])){
	$code = $_POST['code'];
	$id = $_SESSION['id'];
	$data = mysqli_fetch_array(mysqli_query($conn ,"SELECT vertified,activation_code FROM users WHERE id=\"$id\""), MYSQLI_ASSOC);
	if($data['vertified'] == 1){
		header("Location:../index.php");
	}else if($code == $data['activation_code']){
		mysqli_query($conn,"UPDATE users SET vertified='1' WHERE id=\"$id\"");
		header("Location:../index.php");
	}else{
		$message = "Vertification Code Wrong! Please check that the email you entered is correct.";
	}
}else{
	header("Location:login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Vertifying...</title>
</head>
<body>
<span><?php echo($message); ?></span>
</body>
</html>