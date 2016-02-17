<?php
include '../direction.php';
session_start();
if(!isset($_SESSION['userid'])) {
	die('Bitte zuerst <a href="login.php">einloggen</a>');
}

	$out = shell_exec('ls ' .$bugreports);;
	$bugs = explode("\n", $out);
	for ($i=0; $i <count($bugs)-1 ; $i++) {
		echo $bugs[$i];
		echo '<a href="inbug.php?bugid=' .$bugs[$i]. '">view</a>';
		echo "<br>";
	}

if(isset($_POST['knop'])){ //check if form was submitted
#mail('colinbusch98@gmx.de', 'CSWI BUGREPORT ' .$_POST['name'], $_POST['des']);
$namebug = uniqid();
echo 'Send an e-mail to colinbusch98@gmx.de with this subject ' .$namebug. ' if you want a faster bugfix.';
$filename = $bugreports . $namebug .'_'. $_POST['name']. '.txt';
#echo "$filename";
file_put_contents($filename, $_POST['des']);
chmod($filename, 0777);
}
 ?>
 <p>For images use <a href="http://imgur.com/">imgur</a> or <a href="https://app.prntscr.com/en/index.html">Lightshot</a> !<br>
	 ONLY SEND THIS IF IT YOU HAVE A BUG!!! THIS IS NOT FOR FUN!!!
<form action="" method="post" name="bug">
  <input id="input1" type="text" name="name" placeholder="Short name"><br>
  <textarea name="des" placeholder="Description  of the bug" rows="10" cols="60"></textarea><br>
  <input type="submit" name="knop">
</from>
<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<script type="text/javascript">
$(function() {
	$('#input1').on('keypress', function(e) {
			if (e.which == 32)
					return false;
	});
});
</script>
<a href="../dos.php">back</a>
