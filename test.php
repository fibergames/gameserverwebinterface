<?php
//$out = shell_exec('su - serverrun - c "whoami" -p "123123"');
//echo $out;



//online status

$outputls = shell_exec('screen -ls');
echo $outputls;
for ($i=0; $i < 5; $i++) {
  # code...

if (strpos($outputls,'csgo' .$i) !== false) {
    echo $i;
    print "<p6>Server is onnline<br></p6>";
  } else {
    echo $i;
    echo "<p6>Server is off<br></p6>";
}


 }

echo "<br>";
echo "<br>";

// Das "i" nach der Suchmuster-Begrenzung kennzeichnet eine Suche ohne
// Berücksichtigung von Groß- und Kleinschreibung
if (preg_match("/php/i", "PHP ist die Web-Scripting-Sprache der Wahl.")) {
   echo "Es wurde eine Übereinstimmung gefunden.";
} else {
   echo "Es wurde keine Übereinstimmung gefunden.";
}

echo "<br>";
echo "<br>";

$userid = 2;
$hg['1']= "#2#3#4#5#6#";
$userstm = '#' .$userid. '#';
$in = preg_match( $userstm, $hg['1'] );

if (preg_match($userstm, $hg['1'])) {
   echo "Es wurde eine Übereinstimmung gefunden.";
} else {
   echo "Es wurde keine Übereinstimmung gefunden.";
}

echo $in;






 /*$number = 1;
  $userid = 3;
	$pdo = new PDO('mysql:host=localhost;dbname=cswebin', 'root', 'password');
/**IP Catching
  $statement = $pdo->prepare("SELECT ip,serverid,type FROM servers WHERE owner_id = :userid");
  $statement->bindParam(':userid', $userid);
  $statement->execute();
  $ips = $statement->fetchAll();



//  $userstrid = strval($userid);
  $userstm = '%#' . $userid . '#%';
  echo $userstm;
  echo "<br>";
  //$userstm = '%#3#%';
  echo $userstm;
  $statement0 = $pdo->prepare("SELECT count(serverid) as numba from servers where admin_id like :user");
  $statement0->bindParam(':user', $userstm);
  $statement0->execute();
  //$row1 = $statement0->fetchAll();
	$row1 = $statement0->fetch(PDO::FETCH_ASSOC);
  print_r ($row1);

//  echo $ips[$number]["type"];
**/
 ?>
  <title>CS Server Interface</title>
