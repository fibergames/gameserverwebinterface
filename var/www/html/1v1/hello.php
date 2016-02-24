<?php
$pdo1 = new PDO('mysql:host=localhost; dbname= 1v1', 'root', 'bBmSV3Lfc3uK5q');
$statement = $pdo1->prepare("SELECT * FROM multi1v1_stats");
$statement->execute();
$row = $statement->fetchAll();
print_r($row);
 ?>
