<?php
include '../direction.php';
session_start();
if(!isset($_SESSION['userid'])) {
	die('Bitte zuerst <a href="login.php">einloggen</a>');
}
if ($_SESSION['userid'] != 1) {
  echo "You are not allowed to do this!";
  die;
}
switch ($_GET['action']) {
    case 1:
      $newname = str_replace('.txt' , "" , '_viewed_' .$_GET['bugid']) . '.txt';
      echo ('mv ' .$bugreports . $_GET['bugid']. ' ' .$bugreports . $newname);
      shell_exec('mv ' .$bugreports . $_GET['bugid']. ' ' .$bugreports . $newname);
      echo '
       <head>
       <meta http-equiv="refresh" content="0; url=inbug.php?bugid=' .$newname. '" />
       </head>';
        break;
    case 2:
      $newname1 = str_replace('.txt' , "" , '_inprogress_' .$_GET['bugid']) . '.txt';
      $newname = str_replace('_viewed_' , "" , $newname1);
      echo ('mv ' .$bugreports . $_GET['bugid']. ' ' .$bugreports . $newname);
      shell_exec('mv ' .$bugreports . $_GET['bugid']. ' ' .$bugreports . $newname);
      echo '
       <head>
       <meta http-equiv="refresh" content="0; url=inbug.php?bugid=' .$newname. '" />
       </head>';
        break;
    case 3:
      $newname1 = str_replace('.txt' , "" , '_complete_' .$_GET['bugid']) . '.txt';
      $newname = str_replace('_inprogress_' , "" , $newname1);
      echo ('mv ' .$bugreports . $_GET['bugid']. ' ' .$bugreports . $newname);
      shell_exec('mv ' .$bugreports . $_GET['bugid']. ' ' .$bugreports . $newname);
      echo '
       <head>
       <meta http-equiv="refresh" content="0; url=inbug.php?bugid=' .$newname. '" />
       </head>';
        break;
      case 4:
        shell_exec('rm ' .$bugreports . $_GET['bugid']);
        echo '
          <head>
          <meta http-equiv="refresh" content="0; url=bug.php"/>
          </head>';
          break;
    default:
        echo "Error";
      }
 ?>
