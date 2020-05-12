<?php

$dsn = 'mysql:host=studmysql01.fhict.local;dbname=dbi411472';
$username = "dbi411472";
$password = "khoa";

// $dsn = 'mysql:host=localhost;dbname=mangame';
// $username = "root";
// $password = "";

try {
  $con = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
  echo $e->getMessage();
}
