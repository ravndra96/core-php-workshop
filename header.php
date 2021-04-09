<?php
$currentPage = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
?>
<nav class="navbar navbar-expand-lg navbar navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="#">Social Network</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php
                // Check if the user is logged in
                if (isset($_SESSION["email"])) {
                    ?>
                    <li class="nav-item">
                        <a href="welcome.php" class="nav-link <?php echo $currentPage == 'welcome.php' ? 'active' : '' ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="my_posts.php" class="nav-link <?php echo $currentPage == 'my_posts.php' ? 'active' : '' ?>">My Posts</a>
                    </li>
                    <li class="nav-item">
                        <a href="my_likes.php" class="nav-link <?php echo $currentPage == 'my_likes.php' ? 'active' : '' ?>">My likes</a>
                    </li>
                    <li class="nav-item">
                        <a href="newsfeed.php" class="nav-link <?php echo $currentPage == 'newsfeed.php' ? 'active' : '' ?>">News feed</a>
                    </li>
                    <li class="nav-item">
                        <a href="logout.php" class="nav-link">Logout</a>
                    </li>
                <?php } else {
                    ?>
                    <li class="nav-item">
                        <a href="welcome.php" class="nav-link <?php echo $currentPage == 'welcome.php' ? 'active' : '' ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="login_view.php" class="nav-link <?php echo $currentPage == 'login_view.php' ? 'active' : '' ?>">Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="register_view.php" class="nav-link <?php echo $currentPage == 'register_view.php' ? 'active' : '' ?>">Register</a>
                    </li>
                    <li class="nav-item">
                        <a href="newsfeed.php" class="nav-link <?php echo $currentPage == 'newsfeed.php' ? 'active' : '' ?>">News feed</a>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </div>
</nav>