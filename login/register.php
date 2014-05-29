<?php
$message = "";
if(isset($_GET['p'])){
$error = $_GET['p'];
if($error=="acceptterms"){
	$message = "Please accept the Terms of Use";
}else if($error = "Utaken"){
	$message = "Sorry the username you choose is alredy taken.";
}
}
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Register | Anhilation - Domination</title>
<script src="../scripts/login_hash.js"></script>
<link href="../style_main/style.css" type="text/css" rel="stylesheet" />
</head>
<body>
<input type="text" id="username" placeholder="Username" class="loginPage"/>
<br>
<br>
<input type="password" id="password" placeholder="Password" class="loginPage"/>
<form method="post" action="registercheck.php">

<input type="hidden" name="username" placeholder="Username" class="loginPage" id="user_hidden"/>

<input type="hidden" name="password_hash" placeholder="Password" class="loginPage" id="password_hash"/>
<br>
<input type="text" name="email" placeholder="Email" class="loginPage"/>
<br>
<br>
<input type="text" name="country" placeholder="Country" class="loginPage"/>
<p>I accept the Terms of Use<input type="checkbox" name="agreed" /></p>
<input type="submit" class="loginReal" value="Login" onMouseOver="beforeSubmit()"/>
</form>
<p><?php echo($message); ?></p>
</body>
</html>