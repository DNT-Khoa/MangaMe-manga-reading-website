<?php require_once('db.php') ?>
<?php

  if (isset($_POST['username'], $_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
  }


  $sql = "SELECT * FROM users WHERE user_username=?";
  $stmt = $con->prepare($sql);
  $stmt->execute([$username]);

  if ($stmt->rowCount() == 0) {
    echo "username";
    exit();
  }

  $sql = "SELECT user_username, user_password FROM users WHERE user_username=?";
  $stmt = $con->prepare($sql);
  $stmt->execute([$username]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  if (!password_verify($password, $user['user_password'])) {
    echo "password";
    exit();
  }
 ?>
