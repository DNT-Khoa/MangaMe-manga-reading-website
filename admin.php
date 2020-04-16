<?php require_once('helpers/db.php') ?>
<?php require_once('helpers/sessions.php') ?>
<?php require_once('helpers/functions.php') ?>

<?php require_once('includes/header.admin.php') ?>
<?php
  if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hash = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users SET user_username=:username, user_email=:email, user_password=:password, user_role='admin'";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $hash);
    $res = $stmt->execute();
  }
 ?>

<section id="signup">

  <div class="signup-wrapper">
    <img src="img/MangaMe-logo.png" alt="">
    <h2>Add A New Admin!</h2>
    <div id="ajax-message">

    </div>
    <form class="" action="admin.php" method="post" onsubmit="return checkRegister()">
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
        <input type="submit" name="submit" value="Add Admin">
      </p>
    </form>
  </div>

</section>
<?php include 'includes/footer.php'; ?>
