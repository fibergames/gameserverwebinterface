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
if ($auth == 1) {
  echo "Server is going down...";
  $out = shell_exec('screen -S ' . $ctype . $serverid . ' -X kill');
}
elseif ($auth == 2) {
	echo "Server is going down...";
	$out = shell_exec('screen -S ' . $ctype . $serverid . ' -X kill');
}
else {
  echo "You are not allowed to do this!";
}
?>
<head>
<meta http-equiv="refresh" content="0; url=dos.php" />
</head>
