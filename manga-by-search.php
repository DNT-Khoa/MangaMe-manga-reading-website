<?php require_once('includes/header.php') ?>
<?php require_once('helpers/db.php') ?>

<section id="latest-mangas">
    <div class="wrapper">
        <div class="title">
            <h1 class="title-text">Search by name</h1>
            <div class="title-underline"></div>
        </div>

        <div class="main-content">
            <div class="left-div">
                <?php
                if (isset($_POST['search-btn'])) :
                    $input = $_POST['search-input'];
                    $sql = "SELECT * FROM mangas WHERE manga_name LIKE '%$input%'";
                    $stmt = $con->query($sql);
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)):
                 ?>
                <div class="item">
                    <a href="manga.php?manga_id=<?php echo $row['manga_id'] ?>"><img src="<?php echo $row['manga_image'] ?>" alt=""></a>
                    <h2>
                        <a href="manga.php?manga_id=<?php echo $row['manga_id'] ?>" class="link"><?php echo $row['manga_name'] ?></a>
                    </h2>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>

            </div>

            <div class="right-div">
                <h3>Categories</h3>
                <br>
                <ul>
                    <?php
                        $sql = "SELECT * FROM categories";
                        $res = $con->query($sql);
                        while ($row = $res->fetch(PDO::FETCH_ASSOC)):
                    ?>
                    <li>
                        <a href="manga-by-category.php?category=<?php echo $row['title'] ?>"><?php echo $row['title']; ?></a>
                    </li>
                    <?php endwhile; ?>
                </ul>
            </div>
        </div>

    </div>
</section>
<!-- end of latet manga-->

<?php include 'includes/footer.php' ?>
