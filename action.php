<?php
session_start();
if(!isset($_SESSION['userid'])) {
	die('Bitte zuerst <a href="login.php">einloggen</a>');
}
//Abfrage der Nutzer ID vom Login
$userid = $_SESSION['userid'];
$cmd = $_REQUEST['cmd'];
$serverid = $_GET['serverid'];
$type = $_GET['type'];
//type converter
switch ($type) {
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
exec('script /dev/null');
$cmda = 'screen -S ' . $ctype . $serverid . ' -p 0 -X stuff "' . $cmd . '"^M' ;
echo "$cmda";
exec ($cmda);
?>
<head>
<meta http-equiv="refresh" content="0; url=dos.php" />
</head>
