<?php
include '../config.php';
session_start();
if(!isset($_SESSION['userid'])) {
	die('Bitte zuerst <a href="login.php">einloggen</a>');
}
echo '<a href="bugfilemanagment.php?bugid=' .$_GET['bugid']. '&action=1">Viewed</a>  __  ';
echo '<a href="bugfilemanagment.php?bugid=' .$_GET['bugid']. '&action=2">In progress</a>  __  ';
echo '<a href="bugfilemanagment.php?bugid=' .$_GET['bugid']. '&action=3">Complete</a>  __  ';
echo '<a href="bugfilemanagment.php?bugid=' .$_GET['bugid']. '&action=4">DELETE</a><br>';
$cont = file($bugreports . $_GET['bugid']);
for ($i=0; $i <count($cont) ; $i++) {
  echo $cont[$i];
  echo "<br>";
}
echo '<a href=bug.php>back</a>';



 ?>
