<?php
session_start();
$friends = "friends/friends" . $_SESSION['username'] . ".txt";
$file = fopen($friends ,'r');
$cont = fread($file,filesize($friends));
fclose($file);
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body>
<form method="post" action="friendupdate.php">
<textarea name="friends" rows="20" cols="20"><?php echo("$cont"); ?></textarea>
<input type="submit">
</form>
</body>
</html>