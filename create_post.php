<?php
// Initialize the session
session_start();
?>
<html>
    <head>
    <head>
        <title>My Post</title>
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
        <div class='container'>
            <?php if (isset($_SESSION["error"]) && $_SESSION["error"] != '') { ?>
                <div class='row mt-4 justify-content-center'>
                    <div class='col col-8'>
                        <div class="alert alert-danger">
                            <ul>
                                <li><?php echo $_SESSION["error"] ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php
                unset($_SESSION['error']);
            }
            ?>
            <div class='row mt-5 justify-content-center'>
                <div class='col col-8'>
                    <div class="card">
                        <div class="card-body">
                            <?php if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'new') { ?>
                                <h5 class="card-title mb-5">Create Post Here</h5>
                                <form method="post" action="save_post.php" class="create-post-form">
                                    <div class="mb-3">
                                        <label class="form-label">Title</label>
                                        <input type="text" class="form-control" name="title" required="">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Content</label>
                                        <textarea type="text" class="form-control" name="content" required=""></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary create-button">Create</button>
                                    </div>
                                </form>
                                <?php
                            } else {
                                $dsn = "mysql:host=localhost;dbname=core_php_workshop";
                                $dbUserName = "efantom";
                                $dbPassword = "test@123";

                                $pdoConnection = new PDO($dsn, $dbUserName, $dbPassword);

                                $postId = $_REQUEST['id'];
                                $postQuery = "SELECT * FROM posts WHERE id=$postId";
                                $postQueryResult = $pdoConnection->query($postQuery);
                                $post = $postQueryResult->fetch();
                                ?>
                                <h5 class="card-title mb-5">Edit Post Here</h5>
                                <form method="post" action="save_post.php" class="create-post-form">
                                    <div class="mb-3">
                                        <label class="form-label">Title</label>
                                        <input type="text" class="form-control" name="title" value="<?php echo $post['title'] ?>"required="">
                                        <input type="hidden" name="id" value="<?php echo $post['id'] ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Content</label>
                                        <textarea class="form-control" name="content" required=""><?php echo $post['content'] ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary create-button">Update</button>
                                    </div>
                                </form>
                            <?php }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- bootstrap5 js -->
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>