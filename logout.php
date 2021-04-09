<?php

session_start();
if (isset($_SESSION["dbCreated"]) && $_SESSION["dbCreated"] == true) {
    $saveAgain = true;
}

// Destroy session
if (session_destroy()) {
    // Redirecting To login Page
    header("Location: login_view.php");
}

session_start();
if ($saveAgain) {
    $_SESSION['dbCreated'] = true;
}
