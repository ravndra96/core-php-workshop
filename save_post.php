<?php

// Initialize the session
session_start();

$dsn = "mysql:host=localhost;dbname=core_php_workshop";
$dbUserName = "efantom";
$dbPassword = "test@123";
$pdoConnection = new PDO($dsn, $dbUserName, $dbPassword);

$authUserId = $_SESSION["id"];
$title = $_REQUEST['title'];
$handle = strtolower(str_replace(' ', '-', $title));
$content = $_REQUEST['content'];

if (isset($_REQUEST['id']) && $_REQUEST['id'] != '') {
    $postId = $_REQUEST['id'];

    $updatePostQuery = "UPDATE posts SET title=?, handle=?, content=? WHERE id=?";
    $pdoConnection->prepare($updatePostQuery)->execute([$title, $handle, $content, $postId]);

    $_SESSION['success'] = 'Your post has been updated successfully';
} else {
//    $createPostQuery = "INSERT into `posts` (user_id, title, handle, content) VALUES (?,?,?,?)";
    $createPostQuery = "INSERT into `posts` (user_id, title, handle, content) VALUES ('$authUserId', '$title', '$handle', '$content')";
    $pdoConnection->exec($createPostQuery);
//    $pdoConnection->prepare($createPostQuery)->execute([$authUserId, $title, $handle, $content]);
    $_SESSION['success'] = 'Your post has been published successfully';
}
header("Location: my_posts.php");
