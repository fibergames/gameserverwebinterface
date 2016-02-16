<!--logout thing-->
<?php
    session_start();
    $_SESSION['loggedIn'] = false;
?>
<html>
<link href="notmain2.css" rel="stylesheet" type="text/css" />
<p2>You have been Logged out!</p>
<a href="index.php">Home</a>
</html>
