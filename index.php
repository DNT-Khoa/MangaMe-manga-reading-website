<?php include 'includes/header.php' ?>
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
            <h1 class="title-text">Latest Mangas</h1>
            <div class="title-underline"></div>
        </div>

        <div class="main-content">
            <div class="left-div">
                <div class="item">
                    <a href="manga.php"><img src="img/one-piece-chap1.jpg" alt=""></a>
                    <h2>
                        <a href="manga.php" class="link">One Piece</a>
                    </h2>
                    <a href="#" class="link chapter-name">Chapter 1</a>
                    <p class="elapsed-time">3 hours ago</p>
                </div>

                <div class="item">
                    <img src="img/attack-on-titan-chap1.jpg" alt="">
                    <h2>
                        <a href="#" class="link">Attack On Titan</a>
                    </h2>
                    <a href="#" class="link chapter-name">Chapter 1</a>
                    <p class="elapsed-time">2 hours ago</p>
                </div>

                <div class="item">
                    <img src="img/fairy-tail-chap1.jpg" alt="">
                    <h2>
                        <a href="#" class="link">Fairy Tale</a>
                    </h2>
                    <a href="#" class="link chapter-name">Chapter 1</a>
                    <p class="elapsed-time">3 hours ago</p>
                </div>

                <div class="item">
                    <img src="img/naruto-chap1.webp" alt="">
                    <h2>
                        <a href="#" class="link">Naruto</a>
                    </h2>
                    <a href="#" class="link chapter-name">Chapter 1</a>
                    <p class="elapsed-time">3 hours ago</p>
                </div>

                <div class="item">
                    <img src="img/death-note-chap1.jpg" alt="">
                    <h2>
                        <a href="#" class="link">Death Note</a>
                    </h2>
                    <a href="#" class="link chapter-name">Chapter 1</a>
                    <p class="elapsed-time">3 hours ago</p>
                </div>

                <div class="item">
                    <img src="img/tokyo-ghoul-chap1.jpg" alt="">
                    <h2>
                        <a href="#" class="link">Tokyo Ghoul</a>
                    </h2>
                    <a href="#" class="link chapter-name">Chapter 1</a>
                    <p class="elapsed-time">3 hours ago</p>
                </div>
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
                        <a href="#"><?php echo $row['title']; ?></a>
                    </li>
                    <?php endwhile; ?>
                </ul>
            </div>
        </div>

    </div>
</section>
<!-- end of latet manga-->

<?php include 'includes/footer.php' ?>
