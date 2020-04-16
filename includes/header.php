<?php require_once('helpers/db.php') ?>

<?php
    session_start();
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>MangaMe</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/navBarToggle.js" type="text/javascript"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="js/scripts.js"></script>
</head>

<body>

<header class="main-header" id="header">

    <div class="nav-container">

        <div class="nav-left">
            <a href="index.php" class="logo link">MangaMe</a>
            <nav class="main-nav">
                <ul class="nav-list">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link link">Latest</a>
                    </li>
                    <li class="nav-item">
                        <a href="hot.php" class="nav-link link">Hot</a>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="nav-right">
            <form class="search-form" action="manga-by-search.php" method="post">
                <input type="text" id="search-input" placeholder="Search here..." name="search-input">
                <button type="submit" name="search-btn"><i class="fa fa-search"></i></button>
            </form>

            <div class="user-nav">
                <?php
                    if (isset($_SESSION['user_id'])) {
                        echo '<a href="account.php" class="link" id="account-link">My Account</a>
                        <a href="signout.php" class="link" id="signout-link">Sign Out</a>';
                    } else {
                        echo '<a href="login.php" class="link" id="login-link">Login</a>
                        <a href="signup.php" class="link" id="signup-link">Register</a>';
                    }
                 ?>
            </div>
        </div>

        <div class="nav-toggle-btn" onclick="openNav()">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="nav-toggle-icon"><polyline points="7 13 12 18 17 13"></polyline><polyline points="7 6 12 11 17 6"></polyline></svg>
        </div>
    </div>
</header>
