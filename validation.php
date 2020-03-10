<?php
include 'helpers/dbh.help.php';
include 'xmlresponse.php'

if(!isset($_POST['method']) || !$method = $_POST['method']) exit;
if(!isset($_POST['value']) || !$value = $_POST['value']) exit;
if(!isset($_POST['target']) || !$target = $_POST['target']) exit;

$passed = false;
$retval = '';

switch($method)
  {
    case 'checkAge':
        if ()
      break;

    case 'checkEmail':

      break;

    default: exit;
  }
 ?>
