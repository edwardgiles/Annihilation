<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../style_main/style.css" type="text/css" rel="stylesheet" />
<title>Login | Anhilation - Domination</title>
<script src="../scripts/login_hash.js"></script>

</head>
<body>
<div class="headContainer">

</div>
<div class="body">

<h2>Login to Anhilation Domination</h2>

<br>
<br>
<input type="text" id="username" placeholder="Username" class="loginPage"/>
<br>
<br>
<input type="password" id="password" placeholder="Password" class="loginPage"/>
<form method="post" action="logincheck.php">

<input type="hidden" name="username" placeholder="Username" class="loginPage" id="user_hidden"/>

<input type="hidden" name="password_hash" placeholder="Password" class="loginPage" id="password_hash"/>
<br>
<br>
<input type="submit" class="loginReal" value="Login" onMouseOver="beforeSubmit()"/>
</form>
<br>
<br>
<br>
</div>
</body>
</html>