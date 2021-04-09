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

        $authUserId = NULL;
        if (isset($_SESSION["id"]) && $_SESSION["id"] != '') {
            $authUserId = $_SESSION["id"];
        }
        ?>
        <div class='container'>
            <?php if (isset($_SESSION["success"]) && $_SESSION["success"] != '') { ?>
                <div class='row mt-4 justify-content-center'>
                    <div class='col col-8'>
                        <div class="alert alert-success" role="alert">
                            <div class="success">
                                <?php echo $_SESSION['success'] ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                unset($_SESSION['success']);
            }
            ?>

            <?php
            if (isset($_REQUEST['id']) && $_REQUEST['id'] != '') {
                $postId = $_REQUEST['id'];
                $postQuery = "SELECT * FROM posts WHERE id=$postId";
                $postQueryResult = $pdoConnection->query($postQuery);
                $post = $postQueryResult->fetch();
                ?>
                <div class='row mt-4 justify-content-center'>
                    <div class='col col-8'>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $post['title']; ?></h5>
                                <p class="card-text"><?php echo $post['content']; ?></p>
                                <a href="#" class="card-link">
                                    <?php
                                    $totalLikeQuery = "SELECT COUNT(*) FROM likes WHERE post_id=$postId";
                                    $totalLikeQueryResult = $pdoConnection->query($totalLikeQuery);
                                    $totalLikes = $totalLikeQueryResult->fetchColumn();

                                    if (!is_null($authUserId)) {
                                        $likeQuery = "SELECT COUNT(*) FROM likes WHERE user_id=$authUserId AND post_id=$postId";
                                        $likeQueryResult = $pdoConnection->query($likeQuery);
                                        $liked = $likeQueryResult->fetchColumn();
                                        if ($liked > 0) {
                                            ?>
                                            <a href="newsfeed_like.php?id=<?php echo $post['id'] ?>&action=dislike">Liked(<?php echo $totalLikes; ?>)</a>
                                            <?php
                                        } else {
                                            ?>
                                            <a href="newsfeed_like.php?id=<?php echo $post['id'] ?>&action=like">Like(<?php echo $totalLikes; ?>)</a>
                                            <?php
                                        }
                                    } else {
                                        $_SESSION['error'] = "Please login first to like post";
                                        ?>
                                        <a href="login_view.php?">Like(<?php echo $totalLikes; ?>)</a>       
                                    <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                if ($post['user_id'] == $authUserId) {
                    ?>
                    <div class='row mt-5 justify-content-md-center'>
                        <div class='col col-8'>
                            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                View Likes
                            </button>
                        </div>
                    </div>
                    <div class='row mt-2 justify-content-md-center'>
                        <div class='col col-8'>
                            <div class="collapse" id="collapseExample">
                                <div class="card">
                                    <div class='card-body'>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if ($totalLikes > 0) {
                                                    $likesQuery = "SELECT * FROM likes WHERE post_id=$postId";
                                                    $likesQueryResult = $pdoConnection->query($likesQuery);
                                                    $likes = $likesQueryResult->fetchAll();

                                                    foreach ($likes as $like) {
                                                        $userQuery = "SELECT * FROM users WHERE id=" . $like['user_id'];
                                                        $userQueryResult = $pdoConnection->query($userQuery);
                                                        $user = $userQueryResult->fetch();
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $user['id'] ?></td>
                                                            <td><?php echo $user['name'] ?></td>
                                                            <td><?php echo $user['email'] ?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <tr>
                                                        <td colspan="3">No Likes</td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>            
                    <?php
                }
            }
            ?>
        </div>
        <!-- bootstrap5 js -->
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>