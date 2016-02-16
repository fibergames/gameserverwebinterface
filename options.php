<head>
<meta http-equiv="refresh" />
</head>
<?php
session_start();
if(!isset($_SESSION['userid'])) {
	die('Bitte zuerst <a href="login.php">einloggen</a>');
}
//Abfrage der Nutzer ID vom Login
$userid = $_SESSION['userid'];
include 'auth.php';
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
		if ($auth == 1) {
$arradmins = explode('#', $ips['admin_id']);
//$stradmins = implode(', ', $arradmins);
echo '<div class="small">
<form action="allow.php?serverid=' .$serverid. '" method="post">
<input type="number" min="1" default="1" name="newadmin" placeholder=" id">
<input id="submitter" class="disableditem" type="submit" value="Confirm">
<label for="submitter" class="normala">add</label>
</form>';
for ($i=1; $i < count($arradmins)-1; $i++)
{
	echo '<p2>[' .$arradmins[$i].  '</p2>';
	echo '<a href="allow.php?admin_id=' .$arradmins[$i]. '&serverid=' .$serverid. '" class="normala">Kick]</a> ';
}
echo '</div><br>';

		}
		elseif ($auth == 2) {

		}
		else {
		  echo "<p>You are not allowed to do this!</p>";
			die;
		}

    include 'direction.php';
    $info = array();
    $configs = shell_exec('ls ' . $direction1 . $serverid. '/costmstartparam');
//    $info = preg_split('/[\r\n]+/', $output);
    $info  =   explode("\n", $configs);

    for ($i=0; $i < count($info)-1 ; $i++) {

    //  echo '<a href="editor.php?file=' .$info[$i]. '" id=' .$i. '>Edit </a>';
    echo '<div class="item" id="' .$i. '">';
    echo '<p2>' .$info[$i]. '</p2>';
    $hello = file($direction1 . $serverid. '/costmstartparam/' . $info[$i]);
    $wd = substr($hello[0], 10, -1);

    echo '
  <form id="' .$i. '" action="save.php?serverid=' .$serverid. '&filename=' .$info[$i]. '" method="post">
    <textarea name="line">'  .$wd. '</textarea>
    <input class="disableditem" type="submit" value="send" id="submitter' .$i. '"/>
    <label for="submitter' .$i. '" class="la"><img class="otherimg" src="pics/save.png" width="30" height="30"/></label>
		<a class="disabled" id="set" href="save.php?filename=' .$info[$i]. '&serverid=' .$serverid. '"><img class="otherimg" src="pics/set.png" width="30" height="30"/></a><br>
  </form>
  </div><br>';

}

  //  echo $hello[0]; '  .$wd. '
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
