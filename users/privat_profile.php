<?php
include_once("../scripts/connect_to_database.php");
session_start();
if(isset($_SESSION['id'])){
$username = $_SESSION['username'];
$password = $_SESSION['password'];
$owner = $_GET['id'];
$id = $_SESSION['id'];
$owner_name = "";


$data = mysqli_fetch_array(mysqli_query($conn ,"SELECT password,country,bio,username,email FROM users WHERE id=\"$owner\""), MYSQLI_ASSOC);

$bio = $data['bio'];
$nationality = $data['country'];
$owner_name = $data['username'];
	if($data['password'] == $password && $data['username'] == $username){
		$bio = $data['bio'];
		$nationality = $data['country'];
		$email = $data['email'];
		$owner_name = $data['username'];
	}else{
	 header("Location:../index.php");
	}
}else{
	header("Location:../index.php");
}

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo($owner_name); ?>'s Privat profil</title>
</head>
<body>
<p><?php echo($email);?></p>
<iframe src="<?php echo("friends/friends" . $username . ".txt"); ?>" height="500" width="200">
</iframe>

</body>
</html>