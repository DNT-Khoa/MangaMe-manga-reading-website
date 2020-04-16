<?php require_once('includes/header.php') ?>
<?php require_once('helpers/db.php') ?>
<?php
  $chapter_id = $_GET['chapter_id'];
  $con->query("UPDATE chapters SET view = view + 1 WHERE chapter_id = '$chapter_id'"); // This is for counting views per chapter
 ?>
<section id="chapter-images">
  <div class="wrapper">
    <h1 class="chapter_title">
      <?php
        $sql = "SELECT * FROM chapters WHERE chapter_id = '$chapter_id'";
        $stmt = $con->query($sql);
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        echo $res['chapter_name'];
       ?>
    </h1>
    <?php
      $sql = "SELECT * FROM image WHERE chapter_id = '$chapter_id'";
      $stmt = $con->query($sql);
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)):
     ?>
    <div class="image-container">
      <img src="<?php echo $row['image_link'] ?>" alt="">
    </div>
  <?php endwhile; ?>
  </div>

</section>


<?php require_once('includes/footer.php') ?>
