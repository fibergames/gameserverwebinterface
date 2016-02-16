<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=cswebin', 'root', 'password');
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="icon" type="image/png"
       href="pics/servers" />
  <title>Registrierung</title>
</head>
<body>

<?php
$showFormular = true; //Variable ob das Registrierungsformular anezeigt werden soll

if(isset($_GET['register'])) {
	$error = false;
	$email = $_POST['email'];
	$password = $_POST['password'];
	$password2 = $_POST['password2'];

	if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		echo 'Bitte eine gültige E-Mail-Adresse eingeben<br>';
		$error = true;
	}
	if(strlen($password) == 0) {
		echo 'Bitte ein password angeben<br>';
		$error = true;
	}
	if($password != $password2) {
		echo 'Die Passwörter müssen übereinstimmen<br>';
		$error = true;
	}

	//Überprüfe, dass die E-Mail-Adresse noch nicht registriert wurde
	if(!$error) {
		$statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
		$result = $statement->execute(array('email' => $email));
		$user = $statement->fetch();

		if($user !== false) {
			echo 'Diese E-Mail-Adresse ist bereits vergeben<br>';
			$error = true;
		}
	}

	//Keine Fehler, wir können den Nutzer registrieren
	if(!$error) {
		$password_hash = password_hash($password, PASSWORD_DEFAULT);

		$statement = $pdo->prepare("INSERT INTO users (email, password) VALUES (:email, :password)");
		$result = $statement->execute(array('email' => $email, 'password' => $password_hash));

		if($result) {
			echo 'Du wurdest erfolgreich registriert. <a href="login.php">Zum Login</a>';
			$showFormular = false;
		} else {
			echo 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
		}
	}
}

if($showFormular) {
?>
  <link href="main.css" rel="stylesheet" type="text/css" />
  <div class="container">
  <div class="item">
  <form action="?register=1" method="post">
    <input type="email" size="28" maxlength="250" name="email" placeholder="e-mail"><br>
    <input type="password" size="28"  maxlength="250" name="password" placeholder="password"><br>
    <input type="password" size="28" maxlength="250" name="password2" placeholder="retype password"><br>
    <label class="la" for="submitter" class="conf">Register</label>
      <a class="home" href="index.php">Home</a>
      <input id="submitter" class="disabled" type="submit" value="Confirm">
    </label>
  </form>
</div>
</div>
<?php
} //Ende von if($showFormular)
?>

</body>
</html>
