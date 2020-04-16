<?php require_once('db.php') ?>
<?php

  $username = isset($_POST['username'])?$_POST['username']:false;
  $email = isset($_POST['email'])?$_POST['email']:false;

  if ($username) {
    $sql = "SELECT * FROM users WHERE user_username=?";
    $stmt = $con->prepare($sql);
    $stmt->execute([$username]);

    if ($stmt->rowCount() > 0) {
      echo true;
      exit();
    }
  }

  if ($email) {
    $sql = "SELECT * FROM users WHERE user_email=?";
    $stmt = $con->prepare($sql);
    $stmt->execute([$email]);

    if ($stmt->rowCount() > 0) {
      echo true;
      exit();
    }
  }
 ?>
