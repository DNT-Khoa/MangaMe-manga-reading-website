<?php

require_once('helpers/functions.php');
session_start();
unset($_SESSION['user_id']);

$hour = time() - 3600 * 24 * 30;
setcookie('employee_id', '', $hour);
Redirect_to('index.php');
 ?>
