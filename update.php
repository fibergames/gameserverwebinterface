<?php
session_start();
if(!isset($_SESSION['userid'])) {
	die('Bitte zuerst <a href="login.php">einloggen</a>');
}
include 'direction.php';
//Abfrage der Nutzer ID vom Login
$userid = $_SESSION['userid'];
//runs the start.sh with some parameters
$serverid = $_GET['serverid'];
$userstm = '#' . $userid . '#';
$pdo = new PDO('mysql:host=localhost;dbname=cswebin', 'root', 'password');
$statement = $pdo->prepare("SELECT * FROM servers WHERE serverid = :serverid");
$statement->bindParam(':serverid', $serverid);
if($statement->execute()){
    $ips = $statement->fetch(PDO::FETCH_ASSOC);
}
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
if ($ips['owner_id'] == $userid) {
		if ($status == 0)
		{
  echo "Server is going down...";
  $out = shell_exec('screen -S ' . $ctype . $serverid . ' -X kill');
	$out1 = shell_exec('screen -d -m -S ' .$ctype. 'update' .$serverid. ' ' .$direction1. '/' .$serverid. '/steamcmd.sh +runscript csgous.txt');
	}
	else {
		echo "The server is already updating";
				}
			}
elseif (preg_match($userstm, $ips['admin_id'])) {
	echo "Server is going down...";
#	$out = shell_exec('screen -S ' . $ctype . $serverid . ' -X kill');
#  $out1 = shell_exec('screen -d -m -S csupdate' . $serverid . ' bash trade.sh' .$serverid. );
#see dos very down to see why here is commented...
}
else {
  echo "You are not allowed to do this!";
}
?>
<head>
<meta http-equiv="refresh" content="0; url=dos.php" />
</head>
