<?php
include 'config.php';
include 'auth.php';
include 'set.php';
if ($auth == 1) {
}
elseif ($auth == 2) {
  }
else {
echo "<p>You are not allowed to do this!</p>";
die;
}
$filename = $direction1 . $_GET['serverid']. '/costmstartparam/' .$_GET['filename'];
$str = 'param="' .$_POST['line']. '"';
if ($_GET['set'] == 0) {
  echo $_GET['set'];
  file_put_contents($filename, $str);
}
elseif ($_GET['set'] == 1) {
  $configs = shell_exec('ls ' . $direction1 . $_GET['serverid']. '/costmstartparam');
  $info  =   explode("\n", $configs);
  $newname = $direction1 . $_GET['serverid']. '/costmstartparam/' . 'default.cfg';
for ($i=0; $i < count($info); $i++) {
  if (strcmp($info[$i],'default.cfg') == 0) {
    shell_exec('mv ' .$direction1 . $_GET['serverid']. '/costmstartparam/' .$info[$i]. ' ' .$direction1 . $_GET['serverid']. '/costmstartparam/' . uniqid(). '.cfg');
    $error = false;
    }
  }
  shell_exec('mv ' .$filename. ' ' .$newname);
}
echo '
 <head>
 <meta http-equiv="refresh" content="0; url=options.php?serverid=' .$serverid. '&type=1" />
 </head>';
?>
