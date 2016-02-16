<?php
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$persid = $_POST['persid'];
$hashpw = sha1($password);

$mysqli = mysqli_connect('localhost', 'root', 'password', 'cswebin');
$query = ("insert into users (name, password, email, persid) values
    ('$name', '$hashpw', '$email', '$persid' )");
$result = mysqli_query($mysqli, $query);



 ?>
<a href="index.php">back</a>
