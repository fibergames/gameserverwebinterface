<?php
$password = $_POST['password'];
$pw = sha1($password);
echo "$pw";
 ?>
