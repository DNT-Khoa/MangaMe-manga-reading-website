<?php require_once('helpers/db.php') ?>
<?php require_once('helpers/sessions.php') ?>
<?php require_once('helpers/functions.php') ?>
<?php require_once('simple_html_dom.php') ?>

<?php require_once('includes/header.admin.php') ?>

<?php
if(isset($_GET['id'])) {
  $Id = $_GET['id'];
  $sql = "DELETE FROM image WHERE image_id='$Id'";
  $res = $con->query($sql);

  if ($res) {
    $_SESSION['SuccessMessage'] = 'Image has been successfully deleted';
  } else {
    $_SESSION['ErrorMessage'] = 'Something went wrong';
  }
}

 ?>

<?php
  if(isset($_POST['add-image'])) {
    $image_link = $_POST['image_link'];
    $chapter_id = $_POST['chapter_id'];

    $html = file_get_html($image_link);

    foreach($html->find('img') as $element) {
       $sql = "INSERT INTO image(image_link, chapter_id) VALUES (?, ?)";
       $stmt = $con->prepare($sql);
       $res = $stmt->execute([$element->src, $chapter_id]);
     }

    if ($res) {
      $_SESSION['SuccessMessage'] = 'You have successfully added the image';
    } else {
      $_SESSION['ErrorMessage'] = 'Fail to add image. Please check it again';
    }
  }
 ?>
<body>

<main>
  <div class="admin-container">
    <h1>Add Image</h1>
    <div class="category-form">
      <form action="image.admin.php" method="post">

        <label for="">Select A Chapter</label><br>
        <select class="category-option" name="chapter_id">
          <?php
            $sql = "SELECT * FROM chapters";
            $stmt = $con->query($sql);
            while($res = $stmt->fetch(PDO::FETCH_ASSOC)):
           ?>
           <option class="manga-option" value="<?php echo $res['chapter_id'] ?>"><?php echo $res['chapter_name'] ?></option>
         <?php endwhile; ?>
        </select>
        <br>

        <label for="category-title">Image Link</label><br>
        <input type="text" name="image_link" value="" id="category-title" required><br>

        <button type="submit" name="add-image">Add Image</button>
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
          <th>Chapter ID</th>
          <th>Delete</th>
        </tr>
        <?php
          $sql = "SELECT * FROM image";
          $res = $con->query($sql);

          $counter = 1;
          while ($row = $res->fetch(PDO::FETCH_ASSOC)):
         ?>
        <tr>
          <td><?php echo $counter ?></td>
          <td><img src="<?php echo $row['image_link'] ?>" class="small-image"></td>
          <td><?php echo $row['chapter_id'] ?></td>
          <td>
            <a href="image.admin.php?id=<?php echo $row['image_id']; ?>" onclick="return confirm('Are you sure you want to delete this image ?> chapter ?');">
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
