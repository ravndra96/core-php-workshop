<?php
// Initialize the session
session_start();
?>
<html>
    <head>
    <head>
        <title>News Feed</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <!-- Styles -->
        <!-- bootstrap5 css -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <?php
        include 'header.php';

        $dsn = "mysql:host=localhost;dbname=core_php_workshop";
        $dbUserName = "efantom";
        $dbPassword = "test@123";

        $pdoConnection = new PDO($dsn, $dbUserName, $dbPassword);

        $allPostQuery = "SELECT * FROM posts";
        $allPostQueryResult = $pdoConnection->query($allPostQuery);
        $posts = $allPostQueryResult->fetchAll();
        
        ?>
        <div class='container'>
            <h3 class="text-center mt-4">New Posts</h3>
            <div class="row mt-4 post-div">
                <?php if (count($posts) > 0) { ?>
                    <?php
                    foreach ($posts as $post) {
                        $myPostLikeQuery = "SELECT COUNT(*) FROM likes WHERE post_id = " . $post['id'];
                        $myPostLikeQueryResult = $pdoConnection->query($myPostLikeQuery);
                        $myPostLikeCount = $myPostLikeQueryResult->fetchColumn();
                        ?>
                        <div class="col-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $post['title'] ?></h5>
                                    <h6 class="card-subtitle mb-2 text-muted">
                                        <?php echo $post['content']; ?>
                                    </h6>
                                    <p class="card-text"><?php echo 'Total likes: ' . $myPostLikeCount ?></p>
                                    <a href="newsfeed_post.php?id=<?php echo $post['id'] ?>">View Full Post</a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            <?php } else {
                ?>
                <h5>No post</h5>
                <?php
            }
            ?>
        </div>
        <!-- bootstrap5 js -->
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>