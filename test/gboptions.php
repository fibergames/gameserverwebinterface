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
	<link href="options.css" rel="stylesheet" type="text/css" />
    <h1>CS Server Interface</h1>
		<a class="a2"href="logout.php">logout</a>
    <a class="a2"href="dos.php">back</a>
		<?php
		//Greets The User
			echo "<p>Hello User: ".$userid."</p>";
		  $useruid =  $_SESSION['userid'];
    //Catch passed values
    $serverid = $_GET['serverid'];
    $type = $_GET['type'];
		$userstm = '#' . $userid . '#';
		//Security
		$pdo = new PDO('mysql:host=localhost;dbname=cswebin', 'root', 'password');
		$statement = $pdo->prepare("SELECT * FROM servers WHERE serverid = :serverid");
		$statement->bindParam(':serverid', $serverid);
		if($statement->execute()){
		    $ips = $statement->fetch(PDO::FETCH_ASSOC);
		}
		if ($ips['owner_id'] == $userid) {

		}
		elseif (preg_match($userstm, $ips['admin_id'])) {

		}
		else {
		  echo "<p>You are not allowed to do this!</p>";
			die;
		}

    include 'direction.php';
    $info = array();
    $configs = shell_exec('ls ' . $direction1 . $serverid. '/costmstartparam');
    $info = preg_split('/[\r\n]+/', $output);
    $info  =   explode("\n", $configs);

    for ($i=0; $i < count($info)-1 ; $i++) {

    //  echo '<a href="editor.php?file=' .$info[$i]. '" id=' .$i. '>Edit </a>';
    echo '<div class="item" id="' .$i. '">';
    echo '<p2>' .$info[$i]. '</p2>';
    $hello = file($direction1 . $serverid. '/costmstartparam/' . $info[$i]);
    $wd = substr($hello[0] , 10);
    echo '
  <form action=save.php?filename=' .$info[$i]. '" method="post">
    <input type="text" size="130" maxlength="250"  name="line" value="'  .$wd. '"/>
    <input class="disableditem" type="submit" value="send" id="submitter"/>
    <label for="submitter" class="la"><img class="otherimg" src="pics/save.png" width="30" height="30"/></label>
		<a class="disabled" id="set" href="save.php?filename=' .$info[$i]. '"><img class="otherimg" src="pics/set.png" width="30" height="30"/></a><br>
  </form>
  </div><br>';
    }

  /*echo'  <form action=".php?serverid=' .$own[$i]["serverid"] . '&type=' . $own[$i]["type"] . '" method="post">
          <input type="text" name="cmd" placeholder="command" size="13"/>
          <input class="disableditem" type="submit" value="send" id="submitter"/>
          <label for="submitter" class="la"><img class="otherimg" src="pics/arrow" width="30" height="30"></label><br>
        </form>';

        <form action="set.php?filename=' .$info[$i]. '" method="post">
            <input class="disableditem" type="submit" value="send" id="setter"/>
            <label for="setter" class="la"><img class="otherimg" src="pics/arrow" width="30" height="30"></label>
            </form>

              <a href="save.php?filename=' .$info[$i]. '">set active</a>
*/
?>
