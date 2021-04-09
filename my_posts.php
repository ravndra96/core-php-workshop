<?php
// Initialize the session
session_start();
?>
<html>
    <head>
    <head>
        <title>My Posts</title>
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

        $authUserId = $_SESSION["id"];
        $allPostQuery = "SELECT * FROM posts WHERE user_id=$authUserId";
        $allPostQueryResult = $pdoConnection->query($allPostQuery);
        $posts = $allPostQueryResult->fetchAll();
        ?>
        <div class='container'>
            <?php if (isset($_SESSION["success"]) && $_SESSION["success"] != '') { ?>
                <div class='row mt-4 justify-content-center'>
                    <div class='col col-8'>
                        <div class="alert alert-success" role="alert">
                            <div class="success">
                                <?php echo $_SESSION['success']?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                unset($_SESSION['success']);
            }
            ?>
            
            <div class='row mt-5 justify-content-center'>
                <div class='col col-3 text-center'>
                    <a class="justify-content-center mb-3 btn btn-sm btn-outline-primary" href='create_post.php?action=new' class="">Create Post</a>
                </div>
            </div>
            <?php if (count($posts) > 0) { ?>
                <div class="row post-div justify-content-center">
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
                                        <?php echo $post['content'] ?>
                                    </h6>
                                    <p class="card-text"><?php echo 'Total likes: ' . $myPostLikeCount ?></p>
                                    <a class="btn btn-sm btn-outline-primary" href="newsfeed_post.php?id=<?php echo $post['id'] ?>">View</a>
                                    <a class="btn btn-sm btn-outline-success" href="create_post.php?id=<?php echo $post['id'] ?>&action=edit">Edit</a>
                                    <a class="btn btn-sm btn-outline-danger" href="delete_post.php?id=<?php echo $post['id'] ?>">Delete</a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            <?php }
            ?>
        </div>
        <!-- bootstrap5 js -->
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>