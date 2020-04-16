<?php require_once('helpers/db.php') ?>
<?php require_once('helpers/sessions.php') ?>
<?php require_once('helpers/functions.php') ?>

<?php require_once('includes/header.admin.php') ?>

<?php
if(isset($_GET['id'])) {
  $Id = $_GET['id'];
  $sql = "SELECT * FROM mangas WHERE manga_id='$Id'";
  $stmt = $con->query($sql);
  $res = $stmt->fetch(PDO::FETCH_ASSOC);
}

 ?>

<?php
  if(isset($_POST['update-manga'])) {
    $manga_image = $_POST['manga-image'];
    $manga_name = $_POST['manga-name'];
    $manga_author = $_POST['manga-author'];
    $category_title= $_POST['category_title'];
    $manga_status = $_POST['manga-status'];
    $manga_description = $_POST['manga-description'];

    $sql = "UPDATE mangas SET manga_image = ?, manga_name = ?, author = ?, category_title = ?, status = ?, description = ? WHERE manga_id = '$Id'";
    $stmt = $con->prepare($sql);
    $res = $stmt->execute([$manga_image, $manga_name, $manga_author, $category_title, $manga_status, $manga_description]);

    if ($res) {
      $_SESSION['SuccessMessage'] = 'You have successfully updated the manga';
      Redirect_to('manga.admin.php');
    } else {
      $_SESSION['ErrorMessage'] = 'Fail to update manga. Please check it again';
      Redirect_to('manga.admin.php');
    }
  }
 ?>
<body>

<main>
  <div class="admin-container">
    <h1>Add Manga</h1>
    <div class="category-form">
      <form action="edit-manga.admin.php?id=<?php echo $Id ?>"method="post">
        <label for="category-title">Manga Image</label><br>
        <input type="text" name="manga-image" value="<?php echo $res['manga_image'] ?>" id="category-title" class="manga-image" required><br>

        <label for="category-title">Manga Name</label><br>
        <input type="text" name="manga-name" value="<?php echo $res['manga_name'] ?>" id="category-title" required><br>

        <label for="category-title">Manga Author</label><br>
        <input type="text" name="manga-author" value="<?php echo $res['author'] ?>" id="category-title" required><br>

        <label for="">Category</label><br>
        <select class="category-option" name="category_title">
          <?php
            $sql = "SELECT * FROM categories";
            $stmt = $con->query($sql);
            while($res1 = $stmt->fetch(PDO::FETCH_ASSOC)):
           ?>
           <option class="category-option" value="<?php echo $res1['title'] ?>"><?php echo $res1['title'] ?></option>
         <?php endwhile; ?>
        </select>
        <br>
        <label for="category-title">Status (Finish or Ongoing)</label><br>
        <input type="text" name="manga-status" value="<?php echo $res['status'] ?>" id="category-title" required><br>

        <label for="manga-description">Description</label><br>
        <textarea name="manga-description" class="manga-description" id="manga-description" required value="<?php echo $res['manga_description'] ?>"></textarea>
        <br>

        <button type="submit" name="update-manga">Update Manga</button>
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
