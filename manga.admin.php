<?php require_once('helpers/db.php') ?>
<?php require_once('helpers/sessions.php') ?>
<?php require_once('helpers/functions.php') ?>

<?php require_once('includes/header.admin.php') ?>

<?php
if(isset($_GET['id'])) {
  $Id = $_GET['id'];
  $sql = "DELETE FROM mangas WHERE manga_id='$Id'";
  $res = $con->query($sql);

  if ($res) {
    $_SESSION['SuccessMessage'] = 'Category has been successfully deleted';
  } else {
    $_SESSION['ErrorMessage'] = 'Something went wrong';
  }
}

 ?>

<?php
  if(isset($_POST['add-manga'])) {
    $manga_image = $_POST['manga-image'];
    $manga_name = $_POST['manga-name'];
    $manga_author = $_POST['manga-author'];
    $category_title= $_POST['category_title'];
    $manga_status = $_POST['manga-status'];
    $manga_description = $_POST['manga-description'];

    $sql = "INSERT INTO mangas (manga_image, manga_name, author, category_title, status, description)
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($sql);
    $res = $stmt->execute([$manga_image, $manga_name, $manga_author, $category_title, $manga_status, $manga_description]);

    if ($res) {
      $_SESSION['SuccessMessage'] = 'You have successfully added the manga';
    } else {
      $_SESSION['ErrorMessage'] = 'Fail to add manga. Please check it again';
    }
  }
 ?>
<body>

<main>
  <div class="admin-container">
    <h1>Add Manga</h1>
    <div class="category-form">
      <form action="manga.admin.php" method="post">
        <label for="category-title">Manga Image</label><br>
        <input type="text" name="manga-image" value="" id="category-title" class="manga-image" required><br>

        <label for="category-title">Manga Name</label><br>
        <input type="text" name="manga-name" value="" id="category-title" required><br>

        <label for="category-title">Manga Author</label><br>
        <input type="text" name="manga-author" value="" id="category-title" required><br>

        <label for="">Category</label><br>
        <select class="category-option" name="category_title">
          <?php
            $sql = "SELECT * FROM categories";
            $stmt = $con->query($sql);
            while($res = $stmt->fetch(PDO::FETCH_ASSOC)):
           ?>
           <option class="category-option" value="<?php echo $res['title'] ?>"><?php echo $res['title'] ?></option>
         <?php endwhile; ?>
        </select>
        <br>
        <label for="category-title">Status (Finish or Ongoing)</label><br>
        <input type="text" name="manga-status" value="" id="category-title" required><br>

        <label for="manga-description">Description</label><br>
        <textarea name="manga-description" class="manga-description" id="manga-description" required></textarea>
        <br>

        <button type="submit" name="add-manga">Add Manga</button>
      </form>
      <?php
        echo ErrorMessage();
        echo SuccessMessage();
      ?>
    </div>
    <div class="category-table">
      <table>
        <tr>
          <th>ID</th>
          <th>Image</th>
          <th>Manga Name</th>
          <th>Date Added</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>
        <?php
          $sql = "SELECT * FROM mangas";
          $res = $con->query($sql);
          $counter = 1;
          while ($row = $res->fetch(PDO::FETCH_ASSOC)):
         ?>
        <tr>
          <td><?php echo $counter ?></td>
          <td><img src="<?php echo $row['manga_image'] ?>" class="small-image"></td>
          <td><?php echo $row['manga_name'] ?></td>
          <td><?php echo $row['release_date'] ?></td>
          <td>
            <a href="edit-manga.admin.php?id=<?php echo $row['manga_id']; ?>" onclick="return confirm('Are you sure you want to edit the <?php echo $row['manga_name']; ?> manga ?');">
              <i class="fa fa-edit"></i>
            </a>
          </td>
          <td>
            <a href="manga.admin.php?id=<?php echo $row['manga_id']; ?>" onclick="return confirm('Are you sure you want to delete the <?php echo $row['manga_name']; ?> manga ?');">
              <i class="fa fa-trash"></i>
            </a>
          </td>
        </tr>
        <?php $counter++ ?>
      <?php endwhile; ?>
      </table>
    </div>
  </div>
</main>


</body>


<?php
require_once('includes/footer.php');
 ?>
