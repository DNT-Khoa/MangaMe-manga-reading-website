<?php require_once('helpers/db.php') ?>
<?php require_once('helpers/sessions.php') ?>
<?php require_once('helpers/functions.php') ?>

<?php require_once('includes/header.admin.php') ?>

<?php
if(isset($_GET['id'])) {
  $Id = $_GET['id'];
  $sql = "DELETE FROM chapters WHERE chapter_id='$Id'";
  $res = $con->query($sql);

  if ($res) {
    $_SESSION['SuccessMessage'] = 'Chapter has been successfully deleted';
  } else {
    $_SESSION['SuccessMessage'] = 'Something went wrong';
  }
}

 ?>

<?php
  if(isset($_POST['add-chapter'])) {
    $manga_id = $_POST['manga_title'];
    $chapter_name = $_POST['chapter_name'];

    $sql = "INSERT INTO chapters (manga_id, chapter_name)
            VALUES (?, ?)";
    $stmt = $con->prepare($sql);
    $res = $stmt->execute([$manga_id, $chapter_name]);

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
    <h1>Add Chapter</h1>
    <div class="category-form">
      <form action="chapter.admin.php" method="post">

        <label for="">Select A Manga</label><br>
        <select class="category-option" name="manga_title">
          <?php
            $sql = "SELECT * FROM mangas";
            $stmt = $con->query($sql);
            while($res = $stmt->fetch(PDO::FETCH_ASSOC)):
           ?>
           <option class="manga-option" value="<?php echo $res['manga_id'] ?>"><?php echo $res['manga_name'] ?></option>
         <?php endwhile; ?>
        </select>
        <br>

        <label for="category-title">Chapter Name</label><br>
        <input type="text" name="chapter_name" value="" id="category-title" required><br>

        <button type="submit" name="add-chapter">Add Chapter</button>
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
          <th>Manga</th>
          <th>Chapter Name</th>
          <th>Date Added</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>
        <?php
          $sql = "SELECT * FROM chapters";
          $res = $con->query($sql);

          $counter = 1;
          while ($row = $res->fetch(PDO::FETCH_ASSOC)):
         ?>
        <tr>
          <td><?php echo $counter ?></td>
          <?php
            $m_id = $row['manga_id'];
            $sql1 = "SELECT * FROM mangas WHERE manga_id = '$m_id'";
            $res1 = $con->query($sql1);
            $row1 = $res1->fetch(PDO::FETCH_ASSOC);
           ?>
          <td><?php echo $row1['manga_name'] ?></td>
          <td><?php echo $row['chapter_name'] ?></td>
          <td><?php echo $row['date_release'] ?></td>
          <td>
            <a href="edit-chapter.admin.php?id=<?php echo $row['chapter_id']; ?>" onclick="return confirm('Are you sure you want to update the <?php echo $row['chapter_name']; ?> chapter ?');">
              <i class="fa fa-edit"></i>
            </a>
          </td>
          <td>
            <a href="chapter.admin.php?id=<?php echo $row['chapter_id']; ?>" onclick="return confirm('Are you sure you want to delete the <?php echo $row['chapter_name']; ?> chapter ?');">
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
