<?php require_once('helpers/db.php') ?>
<?php require_once('helpers/sessions.php') ?>
<?php require_once('helpers/functions.php') ?>

<?php require_once('includes/header.admin.php') ?>

<?php
if(isset($_GET['id'])) {
  $Id = $_GET['id'];
  $sql = "DELETE FROM categories WHERE id='$Id'";
  $res = $con->query($sql);

  if ($res) {
    $_SESSION['SuccessMessage'] = 'Category has been successfully deleted';
    Redirect_to("categories.admin.php");
  } else {
    $_SESSION['SuccessMessage'] = 'Something went wrong';
    Redirect_to("categories.admin.php");
  }
}

 ?>
<?php
  if (isset($_POST['add-category'])){
    $categoryTitle = $_POST['category-title'];

    if(empty($categoryTitle)){
      $_SESSION['ErrorMessage'] = 'Please choose a category title';
      Redirect_to("categories.admin.php");
    } else {
      $sql = "INSERT INTO categories (title)
              VALUES (:title)";
      $stmt = $con->prepare($sql);
      $stmt->bindParam(':title', $categoryTitle);

      $chk = $con->prepare("SELECT * FROM categories WHERE title= :title");
      $chk->bindParam(':title', $categoryTitle);
      $chk->execute();

      if($chk->rowCount() > 0) {
        $_SESSION['ErrorMessage'] = "This category title has already existed!";
        Redirect_to("categories.admin.php");
      } else {
        if ($stmt->execute()) {
          $_SESSION['SuccessMessage'] = "Category successfully added";
          Redirect_to("categories.admin.php");
        } else {
          $_SESSION['ErrorMessage'] = "Something is wrong. Please try again!";
          Redirect_to("categories.admin.php");
        }
      }
    }
  }
 ?>
<body>

<main>
  <div class="admin-container">
    <h1>Add Category</h1>
    <div class="category-form">
      <form action="categories.admin.php" method="post">
        <label for="category-title">Choose your category title</label><br>
        <input type="text" name="category-title" value="" id="category-title"><br>
        <button type="submit" name="add-category">Add Category</button>
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
          <th>Title</th>
          <th>Delete</th>
        </tr>
        <?php
          $sql = "SELECT * FROM categories";
          $res = $con->query($sql);
          $counter = 1;
          while ($row = $res->fetch(PDO::FETCH_ASSOC)):
         ?>
        <tr>
          <td><?php echo $counter ?></td>
          <td><?php echo $row['title'] ?></td>
          <td>
            <a href="categories.admin.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete the <?php echo $row['title']; ?> category ?');">
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
