<?php
session_start();

$toplinks = "";
$music = "";
if(isset($_SESSION['id'])){
	$userid = $_SESSION['id'];
	$username = $_SESSION['username'];
	$toplinks = '<a href="users/public_profile.php?id=' . $userid . '">' . $username . '</a>
	<br>
	<a href="login/logout.php">Log Out</a>
	<br>
	<a href="start_game/Game.php">Launch Game</a>
	';
	$music = '<iframe src="music/player.php" width="300" height="40">';
}else{
	$toplinks = '<a href="login/login.php">Log in</a><br><a href="login/register.php">Register</a>';
}
?>

<DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Annihilation - Domination |  Play online for free</title>
<link type="text/css" rel="stylesheet" href="style_main/style.css">

</head>
<body>
<div class="headContainer"><div class="headWrap">
	<?php echo($toplinks); ?>
</div></div>
<?php echo($music); ?>
</body>
</html>