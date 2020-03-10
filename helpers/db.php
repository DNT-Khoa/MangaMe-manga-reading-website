<?php

$dsn = 'mysql:host=localhost;dbname=mangame';
$username = "root";
$password = "";

try {
  $con = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
  echo $e->getMessage();
}
