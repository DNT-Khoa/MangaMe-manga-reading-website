<?php include 'includes/header.php' ?>

<section id="signup">

  <div class="login-system-wrapper">
    <div class="header">
      <h2>Sign Up Here!</h2>
    </div>
    <form class="form" name="form" action="index.php" onsubmit="return validateSignUp();">
      <div id = "usernameForm" class="form-control">
        <label for="username">Username</label>
        <input id="username" type="text" name="username" placeholder="marine22">
        <i class="fa fa-check-circle"></i>
        <i class="fa fa-exclamation-circle"></i>
        <small id="username_error">Error Message</small>
      </div>

      <div class="form-control">
        <label for="email">Email</label>
        <input id="email" type="email" name="email" placeholder="marine22@gmail.com">
        <i class="fa fa-check-circle"></i>
        <i class="fa fa-exclamation-circle"></i>
        <small id="email_error">Error Message</small>
      </div>

      <div class="form-control">
        <label for="password">Password</label>
        <input id="password" type="password" name="password" placeholder="Password">
        <i class="fa fa-check-circle"></i>
        <i class="fa fa-exclamation-circle"></i>
        <small id="password_error">Error message</small>
      </div>

      <div class="form-control">
        <label for="password2">Password Confirm</label>
        <input id="password2" type="password" name="password2" placeholder="Password">
        <i class="fa fa-check-circle"></i>
        <i class="fa fa-exclamation-circle"></i>
        <small id="password2_error">Error message</small>
      </div>

      <input type="submit" name="signup-btn" value="Sign Up">
    </form>
  </div>

</section>
<?php include 'includes/footer.php'; ?>
