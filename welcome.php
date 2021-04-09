<?php
// Initialize the session
session_start();
?>
<html>
    <head>
    <head>
        <title>Core PHP</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <!-- Styles -->
        <!-- bootstrap5 css -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <?php
        include 'header.php';
        ?>
        <h3 class='text-center my-5 fw-bold'>Welcome to Social Network</h3>
        <?php
        // Check if the user is logged in
        if (isset($_SESSION["email"]) && isset($_SESSION["id"])) {
            ?>
            <div class='row mt-5 justify-content-center'>
                <div class='col col-3'>
                    <div class="card">
                        <?php
                        $authUserId = $_SESSION["id"];

                        $dsn = "mysql:host=localhost;dbname=core_php_workshop";
                        $dbUserName = "efantom";
                        $dbPassword = "test@123";

                        $pdoConnection = new PDO($dsn, $dbUserName, $dbPassword);

                        $postQuery = "SELECT COUNT(*) FROM posts WHERE user_id = $authUserId";
                        $postQueryResult = $pdoConnection->query($postQuery);
                        $postCount = $postQueryResult->fetchColumn();

                        $likeQuery = "SELECT COUNT(*) FROM likes WHERE user_id = $authUserId";
                        $likeQueryResult = $pdoConnection->query($likeQuery);
                        $likeCount = $likeQueryResult->fetchColumn();

                        $totalLikesOnPosts = 0;
                        $allPostQuery = "SELECT * FROM posts WHERE user_id = $authUserId";
                        $allPostQueryResult = $pdoConnection->query($allPostQuery);
                        $allPost = $allPostQueryResult->fetchAll();
                        foreach ($allPost as $post) {
                            $myPostLikeQuery = "SELECT COUNT(*) FROM likes WHERE post_id = " . $post['id'];
                            $myPostLikeQueryResult = $pdoConnection->query($myPostLikeQuery);
                            $myPostLikeCount = $myPostLikeQueryResult->fetchColumn();
                            $totalLikesOnPosts += $myPostLikeCount;
                        }
                        ?>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-start">Total My Publish Posts <span class='badge bg-primary'><?php echo $postCount ?></span></li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">Total My Likes <span class='badge bg-primary'><?php echo $likeCount ?></span></li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">Total Likes on my posts <span class='badge bg-primary'><?php echo $totalLikesOnPosts; ?></span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <?php
        } else {
            ?>
            <?php
            if (!isset($_SESSION["dbCreated"]) || $_SESSION["dbCreated"] !== true) {
                ?>
                <h5 class='text-center my-5 fw-bold'>Please <a href="create_database_and_tables.php">Click Here</a> to create database and tables.</h5>
                <?php
            } else {
                ?>
                <h5 class='text-center my-5 fw-bold'>Please <a href="login_view.php">login</a> or <a href="register_view.php">register</a> to get started.</h5>
                <?php
            }
            ?>
            <?php
        }
        ?>
        <!-- bootstrap5 js -->
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>