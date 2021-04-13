<?php

$parentDir = "asset/";
$uploadedFile = $parentDir . basename($_FILES["uploaded_file"]["name"]);
$fileChecked = true;

// Check if image file is a actual image or fake image
$check = getimagesize($_FILES["uploaded_file"]["tmp_name"]);
if ($check !== false) {
    echo "File is an image - " . $check["mime"] . ".<br>";
    $fileChecked = true;
} else {
    echo "File is not an image." . "<br>";
    $fileChecked = false;
}

if (file_exists($uploadedFile)) {
    echo "Sorry, file already exists." . "<br>";
    $fileChecked = false;
}
// upload limit 500kb
if ($_FILES["uploaded_file"]["size"] > 500000) {
    echo "Sorry, your file is too large." . "<br>";
    $fileChecked = false;
}

$imageFileType = strtolower(pathinfo($uploadedFile, PATHINFO_EXTENSION));
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed." . "<br>";
    $fileChecked = false;
}

exit();
if ($fileChecked) {
    if (move_uploaded_file($_FILES["uploaded_file"]["tmp_name"], $uploadedFile)) {
        echo "The file " . htmlspecialchars(basename($_FILES["uploaded_file"]["name"])) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
} else {
    echo "Sorry, your file was not uploaded.";
}