<?php

// Initialize the session
session_start();

if (isset($_REQUEST['id']) && $_REQUEST['id'] != '') {
    $postId = $_REQUEST['id'];
    $dsn = "mysql:host=localhost;dbname=core_php_workshop";
    $dbUserName = "efantom";
    $dbPassword = "test@123";
    $pdoConnection = new PDO($dsn, $dbUserName, $dbPassword);

    $deletePostQuery = "DELETE FROM `posts` WHERE id=" . $postId;
    $pdoConnection->exec($deletePostQuery);
    
    $deletePostLikeQuery = "DELETE FROM `likes` WHERE post_id=" . $postId;
    $pdoConnection->exec($deletePostLikeQuery);
    
    $_SESSION['success'] = 'Your post has been deleted successfully';
    header("Location: my_posts.php");
}