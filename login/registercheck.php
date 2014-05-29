<?php
include_once("../scripts/connect_to_database.php");
$checked = $_POST['agreed'];
$message = "";
if($checked == true){
$username = $_POST['username'];
$password = hash("sha256", $_POST['password_hash']);
$email = $_POST['email'];
$country = $_POST['country'];
$account_type = "Standard";
$vertification_code = hash('sha256',rand(0,1000000000*10000000000));
$email_message = "
Dear $username,

thank you for signing up for our game. Before you can play, you will need to vertify your email.
When you log in with your new account you will see a link to the vertification site. Just enter your personal vertification code.

Your Personal Vertificaton Code:
$vertification_code

Regards,
The Anhilation Domination Team";
$headers = 'From: support@test.com';

fopen("../users/friends/friends" . $username . ".txt",'x') or header("Location:register.php?p=Utaken");

$realuser = mysqli_query($conn ,"INSERT INTO users (username, password, email, country, account_type, activation_code) 
VALUES (\"$username\", \"$password\", \"$email\", \"$country\", \"$account_type\", \"$vertification_code\")") or die("Error");


mail($email,"Anhilation Domination Account validation", $email_message, $headers);
$message = "Success";

}else{
	header('Location:register.php?p=acceptterms');
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