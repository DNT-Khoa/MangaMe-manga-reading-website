<?php

$dsn = 'mysql:host=studmysql01.fhict.local;dbname=dbi411472';
$username = "dbi411472";
$password = "khoa";

try {
  $con = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
  echo $e->getMessage();
}
