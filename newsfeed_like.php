<?php

// Initialize the session
session_start();

if (isset($_REQUEST['id']) && $_REQUEST['id'] != '' && isset($_REQUEST['action']) && $_REQUEST['action'] != '') {
    $authUserId = $_SESSION["id"];
    $postId = $_REQUEST['id'];
    $dsn = "mysql:host=localhost;dbname=core_php_workshop";
    $dbUserName = "efantom";
    $dbPassword = "test@123";
    $pdoConnection = new PDO($dsn, $dbUserName, $dbPassword);

    if ($_REQUEST['action'] == 'like') {
        $likeQuery = "SELECT COUNT(*) FROM likes WHERE user_id = $authUserId AND post_id=$postId";
        $likeQueryResult = $pdoConnection->query($likeQuery);
        $liked = $likeQueryResult->fetchColumn();
        if ($liked > 0) {
            $_SESSION['success'] = 'Already liked it';
        } else {
            $likeQuery = "INSERT into `likes` (user_id, post_id) VALUES ('$authUserId', '$postId')";
            $pdoConnection->exec($likeQuery);
            $_SESSION['success'] = 'Liked';
        }
    } else {
        $dislikeQuery = "DELETE FROM `likes` WHERE post_id=$postId AND user_id=$authUserId";
        $pdoConnection->exec($dislikeQuery);
        $_SESSION['success'] = 'Disliked';
    }

    header("Location: newsfeed_post.php?id=$postId");
}