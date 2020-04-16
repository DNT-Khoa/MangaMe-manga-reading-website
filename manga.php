<?php include 'includes/header.php' ?>
<?php require_once('helpers/db.php') ?>
<?php
    $manga_id = $_GET['manga_id'];
    $con->query("UPDATE mangas SET views = views + 1 WHERE manga_id = '$manga_id'"); //This is for counting views everytime users land on this page
    $sql = "SELECT * FROM mangas WHERE manga_id = '$manga_id'";
    $stmt = $con->query($sql);
    $res = $stmt->fetch(PDO::FETCH_ASSOC);
 ?>

<!-- Manga Info -->
<section id="manga-info">
    <div class="wrapper">
        <div class="main-content">
            <div class="left-div">
                <article class="manga-detail">
                    <h1><?php echo $res['manga_name'] ?></h1>
                    <time class="small">[Update at: <?php echo $res['release_date'] ?>]</time>
                    <div class="img-and-info">
                        <div class="img-content">
                            <img src="<?php echo $res['manga_image'] ?>" alt="">
                        </div>
                        <div class="info-content">
                            <ul class="list-info">
                                <li>
                                    <p><i class="fa fa-user"></i>Author</p>
                                    <p class="p-content"><?php echo $res['author'] ?></p>
                                </li>
                                <li>
                                    <p><i class="fa fa-rss"></i>Status</p>
                                    <p class="p-content"><?php echo $res['status'] ?></p>
                                </li>
                                <li>
                                    <p><i class="fa fa-tags"></i>Category</p>
                                    <p class="p-content"><?php echo $res['category_title'] ?></p>
                                </li>
                                <li>
                                    <p><i class="fa fa-eye"></i>Views</p>
                                    <p class="p-content"><?php echo $res['views'] ?></p>
                                </li>
                            </ul>
                            <div id="star-rating">
                                <input type="radio" name="star" id="star5" value="5">
                                <label for="star5"></label>
                                <input type="radio" name="star" id="star4" value="4">
                                <label for="star4"></label>
                                <input type="radio" name="star" id="star3" value="3">
                                <label for="star3"></label>
                                <input type="radio" name="star" id="star2" value="2">
                                <label for="star2"></label>
                                <input type="radio" name="star" id="star1" value="1">
                                <label for="star1"></label>
                            </div>

                            <div class="rating-statistic">
                                Average Ranking: 3.9/5 - 35573 ratings
                            </div>
                            <div class="">
                                <?php if (isset($_SESSION['user_id'])) {
                                    echo '<a href="" class="bookmark link">
                                        <i class="fa fa-heart"></i>
                                        <span>Bookmark</span>
                                    </a>;';
                                } ?>


                            </div>
                        </div>
                    </div>
                    <div class="manga-description1">
                        <h3>
                            <i class="fa fa-file-text-o"></i>
                            Description
                        </h3>
                        <p><?php echo $res['description'] ?></p>
                    </div>
                    <div class="chapter-list">
                        <h3>
                            <i class="fa fa-list"></i>
                            Chapter List
                        </h3>
                        <ul>
                            <li class="heading">
                                <div class="chapter-nameM">
                                    Chapter Name
                                </div>
                                <div class="chapter-upload-dateM">
                                    Date Released
                                </div>
                                <div class="chapter-viewM">
                                    Views
                                </div>
                            </li>
                            <?php
                                $sql = "SELECT * FROM chapters WHERE manga_id = '$manga_id' ORDER BY chapter_id DESC";
                                $stmt = $con->query($sql);
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)):
                             ?>

                            <li>
                                <div class="chapter-nameM">
                                    <a class="link" href="chapter.php?chapter_id=<?php echo $row['chapter_id'] ?>"><?php echo $row['chapter_name'] ?></a>
                                </div>
                                <div class="chapter-upload-dateM small">
                                    <?php echo $row['date_release'] ?>
                                </div>
                                <div class="chapter-viewM small">
                                    <?php echo $row['view'] ?>
                                </div>
                            </li>
                        <?php endwhile; ?>

                        </ul>
                    </div>
                </article>
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
