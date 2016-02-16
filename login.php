<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=cswebin', 'root', 'password');

if(isset($_GET['login'])) {
	$email = $_POST['email'];
	$password = $_POST['password'];

	$statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
	$result = $statement->execute(array('email' => $email));
	$user = $statement->fetch();
	//Überprüfung des passwords
	if ($user !== false && password_verify($password, $user['password'])) {
		$_SESSION['userid'] = $user['id'];
		die('Login erfolgreich. Weiter zu <a href="dos.php">internen Bereich</a>
		<head>
		<meta http-equiv="refresh" content="0; url=dos.php" />
		</head>');
	} else {
		$errorMessage = "<p>Wrong combination</p><br>";
	}

}
?>
<!DOCTYPE html>
<html>
  <link href="main.css" rel="stylesheet" type="text/css" />
<head>
	<link rel="icon" type="image/png"
	     href="pics/servers" />
  <title>Login</title>
</head>
<body>


  <link href="main.css" rel="stylesheet" type="text/css" />
	<div class="container">
  <div class="item">

<form action="?login=1" method="post">

<input type="email" size="22" maxlength="250" name="email" placeholder="e-mail"><br>
<input type="password" size="22"  maxlength="250" name="password" placeholder="password"><br>
<a class="la" id="register "href="register.php">Register</a>
<label for="submitter" class="la">Login</label><br>
<a class="home" href="index.php">Home</a>
<input id="submitter" class="disabled" type="submit" value="Confirm">
<style media="screen">
	label{
		margin-left: 7px;
	}
	a {
		margin-right: 7px;
	}
</style>
</form>
<?php
if(isset($errorMessage)) {
	echo $errorMessage;
}
?>
</div></div>
</body>
</html>
