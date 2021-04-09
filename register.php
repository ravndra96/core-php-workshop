<?php

// Initialize the session
session_start();

// When form submitted, insert values into the database.
if (isset($_REQUEST['name']) && isset($_REQUEST['email']) && isset($_REQUEST['password'])) {

    $name = $_REQUEST['name'];
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];

    $dsn = "mysql:host=localhost;dbname=core_php_workshop";
    $dbUserName = "efantom";
    $dbPassword = "test@123";

    $pdoConnection = new PDO($dsn, $dbUserName, $dbPassword);
    $search = $pdoConnection->prepare("SELECT * FROM users WHERE email=?");
    $search->execute([$email]);
    $user = $search->fetch();
    if ($user) {
        $_SESSION['error'] = "The email has already been taken.";
        header("Location: register_view.php");
    } else {
        // set the PDO error mode to exception
        // $pdoConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "INSERT into `users` (name, email, password) VALUES ('$name', '$email', '" . md5($password) . "')";
        $pdoConnection->exec($query);

        $_SESSION['email'] = $email;
        $_SESSION['id'] = $pdoConnection->lastInsertId();
        $_SESSION['name'] = $name;

        header("Location: welcome.php");
    }
}