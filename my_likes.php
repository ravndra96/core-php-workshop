<?php
// Initialize the session
session_start();
?>
<html>
    <head>
    <head>
        <title>My Likes</title>
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
        $allLikeQuery = "SELECT * FROM likes WHERE user_id=$authUserId";
        $allLikeQueryResult = $pdoConnection->query($allLikeQuery);
        $likes = $allLikeQueryResult->fetchAll();
        ?>
        <div class='container'>
            <?php if (isset($_SESSION["success"]) && $_SESSION["success"] != '') { ?>
                <div class='row mt-4 justify-content-center'>
                    <div class='col col-8'>
                        <div class="alert alert-success" role="alert">
                            <div class="success">
                                <?php echo $_SESSION['success']; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                unset($_SESSION['success']);
            }
            ?>
            <div class='row justify-content-center mt-5'>
                <div class='col col-5'>
                    <div class='card'>
                        <div class="card-body">
                            <h5 class="card-title my-2">My Likes</h5>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (count($likes) <= 0) {
                                        ?>
                                        <tr><td colspan="2">No Liked Posts</td></tr>
                                        <?php
                                    } else {
                                        foreach ($likes as $like) {
                                            $postQuery = "SELECT * FROM posts WHERE id=" . $like['post_id'];
                                            $postQueryResult = $pdoConnection->query($postQuery);
                                            $post = $postQueryResult->fetch();
                                            ?>
                                            <tr>
                                                <td><a href='newsfeed_post.php?id=<?php echo $post['id'] ?>'><?php echo $post['title'] ?></a></td>
                                                <td><a href="newsfeed_like.php?id=<?php echo $post['id'] ?>&action=dislike">Dislike</a></td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- bootstrap5 js -->
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>