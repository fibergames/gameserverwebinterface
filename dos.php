<?php
session_start();
if(!isset($_SESSION['userid'])) {
	die('Bitte zuerst <a href="login.php">einloggen</a>');
}
//Abfrage der Nutzer ID vom Login
$userid = $_SESSION['userid'];
?>
<html>
<head>
<link rel="icon" type="image/png" href="pics/servers" />
</head>
<body>
  <title>CS Server Interface</title>
	<link href="notmain.css" rel="stylesheet" type="text/css" />
    <h1>CS Server Interface</h1>
		<a class="a2"href="logout.php">logout</a>
		<?php
		//Greets The User
			echo "<p>Hello User: ".$userid."</p>";
		  $useruid =  $_SESSION['userid'];
		//Sets some Var
			$run ="steam://rungame/730/76561202255233023/+connect ";

			$pdo = new PDO('mysql:host=localhost;dbname=cswebin', 'root', 'password');
		//Catching number of owned Servers
			$statement = $pdo->prepare("SELECT count(serverid) as num FROM servers WHERE owner_id = :useruid");
			$statement->bindParam(':useruid', $useruid);
			$statement->execute();
			$row = $statement->fetch(PDO::FETCH_ASSOC);
		//Catching number of administrated servers
			$userstm = '%#' . $userid . '#%';
			$statement0 = $pdo->prepare("SELECT count(serverid) as num from servers where admin_id like :user");
			$statement0->bindParam(':user', $userstm);
			$statement0->execute();
			$row1 = $statement0->fetch(PDO::FETCH_ASSOC);
		//user can be admin not owner
			$numown = $row['num'];
			$numadm = $row1['num'];
		//IP,Type,ID catching of owned
		echo '<div class="container">';
		if ( $numown >= 1 ) {
			$statement1 = $pdo->prepare("SELECT serverid,ip,type FROM servers WHERE owner_id = :useruid");
			$statement1->bindParam(':useruid', $useruid);
			$statement1->execute();
		  $own = $statement1->fetchAll();
			$outputls = shell_exec('screen -ls');
			//NEED CHANGE IN SQL
			$typus = "csgo";

		for ($i=0; $i < $numown; $i++) {

		//online status
		if (strpos($outputls,$typus .$own[$i]["serverid"]) !== false) {
					$status = "online";
				} else {
					$status = "offline";
			}
			if ($i == 6) {
			echo '<br>';
			}
			echo '<div class="item" id="' . $i . '">';
			echo '<img src="pics/server" height="20" width="100">';
			echo '<img src="pics/' . $own[$i]["type"] . '.png" height="16" width="16">';
			echo '<img src="pics/own.png" height="16" width="16">';
			echo '<p2> ID:' . $own[$i]["serverid"] . '</p2><br>';
			echo '<p2>' .  $own[$i]["ip"] . '</p2>';
			echo '<span class="' .$status. '">' . $status . '</span>';
			echo '<a class="normala" href="' . $run . $own[$i]["ip"]  .  '">Connect</a>';
			echo '
		 <br>
			<a class="disabled" href="start.php?serverid=' . $own[$i]["serverid"] . '"><img src="pics/play" width="30" height="30"></a>
			<a class="disabled" href="stop.php?serverid=' . $own[$i]["serverid"] . '"><img src="pics/stop" width="30" height="30"></a>
			<a class="disabled" href="update.php"><img src="pics/update" width="30" height="30"></a>
			<a class="disabled" href="options.php?serverid=' . $own[$i]["serverid"] . '&type=' . $own[$i]["type"] . '"><img src="pics/more" width="30" height="30"></a>
			<form action="action.php?serverid=' .$own[$i]["serverid"] . '&type=' . $own[$i]["type"] . '" method="post">
				<input type="text" name="cmd" placeholder="command" size="13"/>
				<input class="disableditem" type="submit" value="send" id="submitter"/>
				<label for="submitter" class="la"><img class="otherimg" src="pics/arrow" width="30" height="30"></label><br>
			</form>
	</div>';
		}
	}
		//IP, Type, ID catching of admin
	if ($numadm >= 1) {
			$statement2 = $pdo->prepare("SELECT serverid,ip,type FROM servers WHERE admin_id like :user");
			$statement2->bindParam(':user', $userstm);
			$statement2->execute();
			$adm = $statement2->fetchAll();
			$outputls = shell_exec('screen -ls');
			//NEED CHANGE IN SQL
			$typus = "csgo";

		for ($o=0; $o < $numadm; $o++) {
			//online status
			if (strpos($outputls,$typus .$adm[$o]["serverid"]) !== false) {
						$status = "online";
					} else {
						$status = "offline";
				}
			if ($o == 6) {
			echo '<br>';
			}
			echo '<div class="item" id="' . $o . '">';
			echo '<img src="pics/server" height="20" width="100">';
			echo '<img src="pics/' . $adm[$o]["type"] . '.png" height="16" width="16">';
			echo '<img src="pics/adm.png" height="16" width="16">';
			echo '<p2> ID:' . $adm[$o]["serverid"] . '</p2><br>';
			echo "<p2>" . $adm[$o]["ip"] . "</p2>";
			echo '<span class="' .$status. '">' . $status . '</span>';
			echo '<a class="normala" href="' . $run . $adm[$o]["ip"]  .  '">Connect</a>';
			echo '
		 <br>
			<a class="disabled" href="start.php?serverid=' . $adm[$o]["serverid"] . '"><img src="pics/play" width="30" height="30"></a>
			<a class="disabled" href="stop.php?serverid=' . $adm[$o]["serverid"] . '"><img src="pics/stop" width="30" height="30"></a>
			<a class="disabled" href="update.php"><img src="pics/update" width="30" height="30"></a>
			<a class="disabled" href="options.php?serverid=' . $adm[$o]["serverid"] . '&type=' . $adm[$o]["type"] . '"><img src="pics/more" width="30" height="30"></a>
			<form action="action.php?serverid=' .$adm[$o]["serverid"] . '&type=' . $adm[$o]["type"] . '" method="post">
				<input type="text" name="cmd" placeholder="command" size="13"/>
				<input class="disableditem" type="submit" value="send" id="submitter"/>
				<label for="submitter" class="la"><img class="otherimg" src="pics/arrow" width="30" height="30"></label><br>
			</form>
	</div>';
		}
	}
/*
	if ($numown = '0') {
		echo "<p>Server hier bestellen</p>";
	}
	if ($numadm = '0') {
		echo "<p>So als admin eintragen lassen</p>";
	}
*/


		?>



	<?php
	/*

	if($number != 0){
		for ($i=0; $i < $number; $i++) {
		if ($i == 6) {
		echo '<br>';
		}
		echo '<div class="item" id="' . $i . '">';
		echo '<img src="pics/server" height="20" width="100">';
		echo '<img src="pics/' . $ips[$i]["type"] . '.png" height="16" width="16"><br>';
		echo "<p2>" . $ips[$i]["ip"] . "</p2>";
		echo '<span id="status">' . $status1 . '</span>';
		echo '<a class="normala" href="' . $run . $ips[$i]["ip"]  .  '">Connect</a>';
		echo '
	 <br>
		<a class="disabled" href="start.php?serverid=' . $ips[$i]["serverid"] . '"><img src="pics/play" width="30" height="30"></a>
		<a class="disabled" href="stop.php"><img src="pics/stop" width="30" height="30"></a>
		<a class="disabled" href="update.php"><img src="pics/update" width="30" height="30"></a>
		<a class="disabled" href="#"><img src="pics/more" width="30" height="30"></a>
		<form action="action.php" method="post">
			<input type="text" name="cmd" placeholder="command" size="13"/>
			<input class="disableditem" type="submit" value="send" id="submitter"/>
			<label for="submitter" class="la"><img class="otherimg" src="pics/arrow" width="30" height="30"></label><br>
		</form>
</div>';
}
	}
else {
	die;
}*/
?>

</div>

<!--<ul>
  <li><a class="disabled" href="start.php">start</a></li>
  <li><a class="disabled" href="startcomp.php">startcomp</a></li>
  <li><a class="disabled" href="stop.php">stop</a></li>
  <li><a class="disabled" href="myprofile.php">My Profile</a></li>
  <li1><a class="disabled" href="lookin.php">status</a></li1>
  <li><a class="disabled" href="svcheats1.php">svcheats_1</a></li>
  <li><a class="disabled" href="svcheats0.php">svcheats_0</a></li>
  <li2><a class="disabled">plugins</a></li2>
  <li><form action="action.php" method="post">
      command:  <input type="text" name="cmd" /><input type="submit" name="submit" value="Submit me!" />
  <li><a class="disabled" href="logout.php">LogOut</a></li>
</li>
</ul>
<ul id="plugins">
  <li><a class="disabled" href="bhopon.php">bHopOn</a></li>
  <li><a class="disabled" href="bhopoff.php">bHopOff</a></li>
  <li><a class="disabled" href="retakeon.php">retakeOn</a></li>
  <li><a class="disabled" href="retakeoff.php">retakeOff</a></li>
  <li><a class="disabled" href="lookinplug.php">lokkIn</a></li>
</ul id="plugins">
<script src="jquery.js"></script>
<script>
$(function(){
$('p6').hide();
$(plugins).hide();
$('li1').on('mouseover', function(){
  $('p6').fadeToggle();
});
$('li2').on('click', function(){
  $(plugins).fadeToggle();
});

});
</script>
-->
<?php /*
	$output = shell_exec('screen -ls');
if (strpos($output,'No Sockets found in /var/run/screen/S-www-data') !== false) {
    print "<p6>Server is offline<br></p6>";
	} else {
		echo "<p6>Server is running<br></p6>";
}*/
?>
<!-- don't think that is important
<form action="start.php">
    <input type="submit" value="Starten">
</form>
<form action="startcomp.php">
    <input type="submit" value="Start Comp Mode">
</form>
<form action="stop.php">
    <input type="submit" value="Stoppen">
</form>
<form action="update.php">
    <input type="submit" value="Updaten">
</form>
<form action="lookin.php">
    <input type="submit" value="LookIn">
</form>

<form action="svcheats1.php">
    <input type="submit" value="sv_cheats1">
</form>
<form action="svcheats0.php">
    <input type="submit" value="sv_cheats 0">
</form>
<form action="dosplug.php">
    <input type="submit" value="PluginWIzzard">
</form>


<form action="action.php" method="post">
    Command:  <input type="text" name="cmd" /><br />
    <input type="submit" name="submit" value="Submit me!" />
</form>


<form action="logout.php">
    <input type="submit" value="Logout">
</form>
</body>
</html>
-->
