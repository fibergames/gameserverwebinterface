<?php
session_start();
if(!isset($_SESSION['userid'])) {
	die('Bitte zuerst <a href="login.php">einloggen</a>');
}
include 'auth.php';
if ($auth == 1) {
}
else {
  echo "You are not allowed to do this!";
  die;
}
if ($_REQUEST['newadmin'] != NULL){
  $admins = $ips['admin_id'] . $_REQUEST['newadmin']. '#';
  echo $admins;
  $pdo = new PDO('mysql:host=localhost;dbname=cswebin', 'root', 'password');
  $stmee = $pdo->prepare("UPDATE servers SET admin_id = :admins WHERE serverid = :serverid");
  $stmee->bindParam(':admins', $admins, PDO::PARAM_STR);
  $stmee->bindParam(':serverid', $serverid);
  $stmee->execute();
}
elseif ($_GET['admin_id'] != NULL) {
  $admins = str_replace('#' .$_GET['admin_id']. '#', "#", $ips['admin_id']);
  echo "$admins";
  $pdo = new PDO('mysql:host=localhost;dbname=cswebin', 'root', 'password');
  $stmee = $pdo->prepare("UPDATE servers SET admin_id = :admins WHERE serverid = :serverid");
  $stmee->bindParam(':admins', $admins, PDO::PARAM_STR);
  $stmee->bindParam(':serverid', $serverid);
  $stmee->execute();
}
else {
  echo "Error";
}
echo '
 <head>
 <meta http-equiv="refresh" content="0; url=options.php?serverid=' .$serverid. '&type=1" />
 </head>';
 ?>
