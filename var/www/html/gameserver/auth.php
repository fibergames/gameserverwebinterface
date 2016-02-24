<?php
$userid =  $_SESSION['userid'];
$serverid = $_GET['serverid'];
$userstm = '#' . $userid . '#';
$pdo = new PDO('mysql:host=localhost;dbname=cswebin', 'root', 'bBmSV3Lfc3uK5q');
$statement = $pdo->prepare("SELECT * FROM servers WHERE serverid = :serverid");
$statement->bindParam(':serverid', $serverid);
if($statement->execute()){
  $ips = $statement->fetch(PDO::FETCH_ASSOC);
}
if ($ips['owner_id'] == $userid) {
    $auth = 1;
}
elseif (preg_match($userstm, $ips['admin_id'])) {
    $auth = 2;
}
else {
  $auth = 0;
echo "<p>You are not allowed to do this!</p>";
die;
}
?>
