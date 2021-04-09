<?php

// Here we are creating database

$dsn = "mysql:host=localhost";
$dbUserName = "efantom";
$dbPassword = "test@123";

$pdoConnection = new PDO($dsn, $dbUserName, $dbPassword);

$createDatabase = "CREATE DATABASE `core_php_workshop`";
$pdoConnection->exec($createDatabase);

// Here we are creating tables

$dsn = "mysql:host=localhost;dbname=core_php_workshop";

$pdoConnection = new PDO($dsn, $dbUserName, $dbPassword);

$createUsersTable = "CREATE TABLE `users` (`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,`name` varchar(255) NOT NULL,`email` varchar(255) NOT NULL,`password` varchar(255) NOT NULL,`created_at` timestamp NULL DEFAULT NULL,`updated_at` timestamp NULL DEFAULT NULL,PRIMARY KEY (`id`),UNIQUE KEY `users_email_unique` (`email`));";
$pdoConnection->exec($createUsersTable);

$createPostsTable = "CREATE TABLE `posts` (`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,`user_id` bigint(20) NOT NULL,`title` varchar(200) NOT NULL,`handle` varchar(255) NOT NULL,`content` text NOT NULL,`created_at` timestamp NULL DEFAULT NULL,`updated_at` timestamp NULL DEFAULT NULL,PRIMARY KEY (`id`))";
$pdoConnection->exec($createPostsTable);

$createLikesTable = "CREATE TABLE `likes` (`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,`user_id` bigint(20) NOT NULL,`post_id` bigint(20) NOT NULL,`created_at` timestamp NULL DEFAULT NULL,`updated_at` timestamp NULL DEFAULT NULL,PRIMARY KEY (`id`))";
$pdoConnection->exec($createLikesTable);

session_start();
$_SESSION['dbCreated'] = true;
header("Location: welcome.php");
