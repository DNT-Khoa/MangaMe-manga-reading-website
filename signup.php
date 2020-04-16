<?php require_once('includes/header.php') ?>
<?php require_once('helpers/db.php') ?>
<?php require_once('helpers/functions.php')  ?>
<?php
  if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hash = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users SET user_username=?, user_email=?, user_password=?, user_role='reader', user_image=''";
    $stmt = $con->prepare($sql);

    $res = $stmt->execute([$username, $email, $hash]);

    if ($res) {
      Redirect_to('login.php');
    } else {
      print_r($stmt->errorInfo());

    }
  }
 ?>

<section id="signup">

  <div class="signup-wrapper">
    <img src="img/MangaMe-logo.png" alt="">
    <h2>Sign Up To MangaMe!</h2>
    <div id="ajax-message">

    </div>
    <form class="" action="signup.php" method="post" onsubmit="return checkRegister()">
      <p>
        <label for="username">Username</label>
        <input type="text" name="username" id="username" onkeyup="return checkUsername()">
      </p>
      <div id="username-error" class="error"></div>
      <p>
        <label for="email">Email</label>
        <input type="email" name="email" value="" id="email" onkeyup="return checkEmail()">
      </p>
      <div id="email-error" class="error"></div>
      <p>
        <label for="password">Password</label>
        <input type="password" name="password" value="" id="password">
      </p>
      <div id="password-error" class="error"></div>
      <p>
        <label for="password2">Confirm your password</label>
        <input type="password" name="password2" value="" id="password2">
      </p>
      <div id="password2-error" class="error"></div>
      <p>
        <input type="submit" name="submit" value="Sign Up">
      </p>
    </form>
  </div>

</section>
<?php require_once('includes/footer.php') ?>
