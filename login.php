<?php require_once('includes/header.php') ?>
<?php require_once('helpers/functions.php') ?>
<?php require_once('helpers/db.php') ?>

<?php
  if (!isset($_SESSION)) {
    session_start();
  }
?>
<?php
  if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $sql = "SELECT * FROM users WHERE user_username='$username'";
    $stmt = $con->query($sql);
    $res = $stmt->fetch(PDO::FETCH_ASSOC);

    $_SESSION['user_id'] = $res['user_id'];

    if (isset($_POST['cbx-remember-me'])) {
      $hour = time() + 3600 * 24 * 30;
      setcookie('user_id', $res['user_id'], $hour);
    }

    if ($res['user_role'] == 'reader') {
      Redirect_to('index.php');
    } else if ($res['user_role'] = 'admin') {
      Redirect_to('manga.admin.php');
    }


  }

 ?>
<section id="signup">

  <div class="signup-wrapper">
    <img src="img/MangaMe-logo.png" alt="">
    <h2>Login To MangaMe!</h2>
    <form class="" action="login.php" method="post" onsubmit="return checkSignIn()">
      <p>
        <label for="username">Username</label>
        <input type="text" name="username" value="" id="username">
      </p>
      <div id="username-error" class="error"></div>
      <p>
        <label for="password">Password</label>
        <input type="password" name="password" value="" id="password">
      </p>
      <div id="password-error" class="error"></div>
      <p>
        <input type="checkbox" name="cbx-remember-me" value="" id="cbx-remember-me">
        <label for="cbx-remember-me">Remember Me</label>
      </p>
      <p>
        <input type="submit" name="submit" value="Login">
      </p>
    </form>
    <a href="#" class="link">Forgot Your Password ?</a>
  </div>

</section>
<?php include 'includes/footer.php'; ?>
