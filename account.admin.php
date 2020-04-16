<?php require_once('includes/header.admin.php') ?>
<?php require_once('helpers/db.php') ?>
<?php
  session_start();
  if (isset($_SESSION)) {
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM users WHERE user_id = '$user_id'";
    $stmt = $con->query($sql);
    $res = $stmt->fetch(PDO::FETCH_ASSOC);
    $username = $res['user_username'];
    $email = $res['user_email'];
    $image = $res['user_image'];
  }

  if (isset($_POST['update-info-btn'])) {
    $new_username = $_POST['username'];
    $new_email = $_POST['email'];
    $sql = "UPDATE users SET user_username=?, user_email=? WHERE user_id='$user_id'";
    $stmt = $con->prepare($sql);
    $res = $stmt->execute([$new_username, $new_email]);
  }

  if (isset($_POST['upload-img-btn'])) {
    $image = $_FILES['image']['name'];
    $target    = "img/".basename($_FILES['image']['name']);
    $sql = "UPDATE users SET user_image=? WHERE user_id = '$user_id'";
    $stmt = $con->prepare($sql);
    $res = $stmt->execute([$image]);

    if ($res) {
      move_uploaded_file($_FILES['image']['tmp_name'], $target);
    }
  }

 ?>

<section id="personal-info">
  <div class="wrapper">
    <div class="avatar-image">
      <img src="<?php if ($image != ""){echo "img/".$image;} else {echo "img/default-avatar.png";} ?>" alt="">
    </div>
    <form class="" action="account.admin.php" method="post" enctype="multipart/form-data">
      <input type="File" name="image" value="" class="upload-btn">
      <input type="submit" name="upload-img-btn" value="Upload Image" class="upload-img-btn">
    </form>
    <div class="account-info">
      <h2>Account Details</h2>
      <form class="" action="account.admin.php" method="post">
        <div class="info-details">
          <div class="info-group">
            <div class="label">
              Username:
            </div>
            <div class="detail">
              <input type="text" name="username" value="<?php echo $username ?>">
            </div>
          </div>
          <div class="info-group">
            <div class="label">
              Email:
            </div>
            <div class="detail">
              <input type="text" name="email" value="<?php echo $email ?>">
            </div>
          </div>
        </div>
        <input type="submit" name="update-info-btn" value="Update Information" class="update-info-btn">
      </form>
    </div>

  </div>
</section>

<?php require_once('includes/footer.php') ?>
