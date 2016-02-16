<?php
include 'direction.php';
include 'auth.php';
$filename = $direction1 . $serverid. '/costmstartparam/' .$_GET['filename'];
$str = 'param="' .$_POST['line']. '"';
if ($auth == 1) {
  file_put_contents($filename, $str);
}
elseif ($auth == 2) {
  file_put_contents($filename, $str);
  }
else {
echo "<p>You are not allowed to do this!</p>";
die;
}
echo '
 <head>
 <meta http-equiv="refresh" content="0; url=options.php?serverid=' .$serverid. '&type=1" />
 </head>';
 ?>
