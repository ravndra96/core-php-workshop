<?php

// Initialize the session
session_start();

// When form submitted, insert values into the database.
if (isset($_REQUEST['email']) && isset($_REQUEST['password'])) {
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];

    $dsn = "mysql:host=localhost;dbname=core_php_workshop";
    $dbUserName = "efantom";
    $dbPassword = "test@123";

    $pdoConnection = new PDO($dsn, $dbUserName, $dbPassword);
    $search = $pdoConnection->prepare("SELECT * FROM users WHERE email=? AND password=?");
    $search->execute([$email, md5($password)]);
    $user = $search->fetch();
    if ($user) {
        $_SESSION['id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['name'] = $user['name'];

        header("Location: welcome.php");
    } else {
        $_SESSION['error'] = 'Please enter valid email and password';
        header("Location: login_view.php");
    }
}