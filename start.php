<?php
session_start();
if(!isset($_SESSION['userid'])) {
	die('Bitte zuerst <a href="login.php">einloggen</a>');
}
include 'auth.php';
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
//Security checks
$outputls = shell_exec('screen -ls');
if (strpos($outputls,$ctype .$serverid) !== false) {
      $status = 1; //online
    } else {
      $status = 0; //offline
  }
	if ($status == 0)
	{
		if ($auth == 1) {
		  echo "Server is turning up...";
		  $out = shell_exec('bash start.sh ' . $serverid . ' ' . $serverid . ' ' . $ips['typ'] . '');
		}
		elseif ($auth == 2) {
			echo "Server is turning up...";
			$out = shell_exec('bash start.sh ' . $serverid . ' ' . $serverid . ' ' .  $ips['typ'] . '');
		}
		else {
		  echo "You are not allowed to do this!";
		}
	}
	else {
		echo "The server is already running";
	}
?>
<head>
<meta http-equiv="refresh" content="0; url=dos.php" />
</head>
