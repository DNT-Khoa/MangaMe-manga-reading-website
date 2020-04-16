<?php require_once('includes/header.php') ?>
<?php require_once('helpers/db.php') ?>

<section id="banner">
            <div id="banner-box">
                <img class="logo" src="img/MangaMe-logo.png" alt="">
                <h1 id="banner-title">Welcome To MangaMe</h1>
                <div class="banner-underline"></div>
                <h3 class="banner-subtitle">Find you favorite manga below</h3>
            </div>
        </section>
<!-- end of header-->

<!-- latest mangas body -->
<!-- latest mangas-->
<section id="latest-mangas">
    <div class="wrapper">
        <div class="title">
            <h1 class="title-text">Hot Mangas</h1>
            <div class="title-underline"></div>
        </div>

        <div class="main-content">
            <div class="left-div">
                <?php
                    $sql = "SELECT * FROM chapters ORDER BY view DESC";
                    $stmt = $con->query($sql);
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)):
                 ?>
                <div class="item">
                    <a href="chapter.php?chapter_id=<?php echo $row['chapter_id'] ?>"><img src="<?php
                    $m_id = $row['manga_id'];
                    $sql1 = "SELECT * FROM mangas WHERE manga_id = '$m_id'";
                    $stmt1 = $con->query($sql1);
                    $res = $stmt1->fetch(PDO::FETCH_ASSOC);
                    echo $res['manga_image'];
                    ?>" alt=""></a>
                    <h2>
                        <a href="manga.php?manga_id=<?php echo $res['manga_id'] ?>" class="link"><?php echo $res['manga_name'] ?></a>
                    </h2>
                    <a href="chapter.php?chapter_id=<?php echo $row['chapter_id'] ?>" class="link chapter-name"><?php echo $row['chapter_name'] ?></a>
                    <p class="elapsed-time"><?php echo $row['date_release'] ?></p>
                    <p class="elapsed-time">Views: <?php echo $row['view'] ?></p>
                </div>
            <?php endwhile;?>

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
