<?php
session_start();
if(!isset($_SESSION['userid'])) {
	die('Bitte zuerst <a href="login.php">einloggen</a>');
}
include 'config.php';
include 'auth.php';
//Abfrage der Nutzer ID vom Login
$userid = $_SESSION['userid'];
//runs the start.sh with some parameters
$serverid = $_GET['serverid'];
//Type Converter
switch ($ips['type']) {
    case 1:
        $ctype = "csgo";
        break;
    case 2:
        $ctype = "minecraft";
        break;
    case 3:
        $ctype = "teamspeak";
        break;
    default:
        echo "Error";
}
$outputls = shell_exec('screen -ls');
if (strpos($outputls,$ctype. 'update' .$serverid) !== false) {
			$status = 1; //online
		} else {
			$status = 0; //offline
	}
//Security checks
if ($auth == 1) {
		if ($status == 0)
		{
  echo "Server is updating...";
  $out = shell_exec('screen -S ' . $ctype . $serverid . ' -X kill');
	$out1 = shell_exec('screen -d -m -S ' .$ctype. 'update' .$serverid. ' ' .$direction1. '/' .$serverid. '/steamcmd.sh +runscript csgous.txt');
	}
	else {
		echo "The server is already updating";
				}
			}
elseif ($auth == 2) {
				if ($status == 0)
				{
	echo "Server is updating...";
	$out = shell_exec('screen -S ' . $ctype . $serverid . ' -X kill');
	$out1 = shell_exec('screen -d -m -S ' .$ctype. 'update' .$serverid. ' ' .$direction1. '/' .$serverid. '/steamcmd.sh +runscript csgous.txt');
}
else {
	echo "The server is already updating";
			}
}
else {
  echo "You are not allowed to do this!";
}
?>
<head>
<meta http-equiv="refresh" content="0; url=dos.php" />
</head>
