<?php include 'includes/header.php' ?>

<section id="signup">

  <div class="login-system-wrapper">
    <div class="header">
      <h2>Sign Up Here!</h2>
    </div>
    <form id="form" class="form" name="form" action="index.php" onsubmit="return validateLogin()">

      <div class="form-control">
        <label for="username">Username</label>
        <input id="username" type="text" name="username" placeholder="marine22">
        <i class="fa fa-check-circle"></i>
        <i class="fa fa-exclamation-circle"></i>
        <small id="username_error">Error Message</small>
      </div>

      <div class="form-control">
        <label for="password">Password</label>
        <input id="password" type="password" name="password" placeholder="Password">
        <i class="fa fa-check-circle"></i>
        <i class="fa fa-exclamation-circle"></i>
        <small id="password_error">Error message</small>
      </div>


      <input type="submit" name="signup-btn" value="Sign Up">
    </form>
  </div>

</section>
<?php include 'includes/footer.php'; ?>
