<?php require_once('helpers/db.php') ?>
<?php require_once('helpers/sessions.php') ?>
<?php require_once('helpers/functions.php') ?>

<?php require_once('includes/header.admin.php') ?>

<?php
if(isset($_GET['id'])) {
  $Id = $_GET['id'];
  $sql = "SELECT * FROM chapters WHERE chapter_id = '$Id'";
  $stmt = $con->query($sql);
  $res = $stmt->fetch(PDO::FETCH_ASSOC);
}

 ?>

<?php
  if(isset($_POST['update-chapter'])) {
    $chapter_name = $_POST['chapter_name'];

    $sql = "UPDATE chapters SET chapter_name = ? WHERE chapter_id = '$Id'";
    $stmt = $con->prepare($sql);
    $res = $stmt->execute([$chapter_name]);

    if ($res) {
      $_SESSION['SuccessMessage'] = 'You have successfully updated the chapter';
      Redirect_to('chapter.admin.php');
    } else {
      $_SESSION['ErrorMessage'] = 'Fail to update chapter. Please check it again';
      Redirect_to('chapter.admin.php');
    }
  }
 ?>
<body>

<main>
  <div class="admin-container">
    <h1>Add Chapter</h1>
    <div class="category-form">
      <form action="edit-chapter.admin.php?id=<?php echo $Id ?>" method="post">

        <label for="">Select A Manga</label><br>
        <select class="category-option" name="manga_title">
          <?php
            $sql = "SELECT * FROM mangas";
            $stmt = $con->query($sql);
            while($res1 = $stmt->fetch(PDO::FETCH_ASSOC)):
           ?>
           <option class="manga-option" value="<?php echo $res1['manga_id'] ?>"><?php echo $res1['manga_name'] ?></option>
         <?php endwhile; ?>
        </select>
        <br>

        <label for="category-title">Chapter Name</label><br>
        <input type="text" name="chapter_name" value="<?php echo $res['chapter_name'] ?>" id="category-title" required><br>

        <button type="submit" name="update-chapter">Update Chapter</button>
      </form>
      <?php
        echo ErrorMessage();
        echo SuccessMessage();
      ?>
    </div>

  </div>
</main>


</body>


<?php
require_once('includes/footer.php');
 ?>
