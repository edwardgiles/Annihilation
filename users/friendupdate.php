<?php
session_start();
$username = $_SESSION['username'];
$friends = $_POST['friends'];
$file = fopen("friends/friends" . $username . ".txt","w+");
fwrite($file,$friends) or die("Error saving changes!");
header("Location:privat_profile.php?id=" . $_SESSION['id']);
?>