<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once("../db_connect.php");

$conn = openConnection();
// Made by JYCKO
if ($_SERVER["REQUEST_METHOD"] != "POST") {

    exit;
}

$statusMsg = "";
// Check title, book author and if they uploaded anbook cover image
$title = mysqli_real_escape_string($conn, $_POST["title"]);
$author = mysqli_real_escape_string($conn, $_POST["author"]);
$userid = $_SESSION["userid"];
if (empty($userid)) {
    header("Location: ../login.php?message=notloggedin");
    exit;
}
$query =
    "INSERT INTO forum_request
 (StudentID, Title, Author, Status)
  VALUES 
  ('$userid', '$title', '$author', 'OPEN')";


if (!empty($_FILES['image']['name'])) {
    // if (empty($_FILES['image']['name'])) {
    //     $statusMsg = "invalidname";
    //     header("Location: ../forum_create.php?message=$statusMsg");
    //     exit;
    // } 

    $fileName = basename($_FILES['image']['name']);
    $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
    $fileType = strtolower($fileExt);

    $allowTypes = array('jpg', 'jpeg', 'png', 'gif');
    if (!in_array($fileType, $allowTypes)) {
        $statusMsg = "invalidext";
        header("Location: ../forum_create.php?message=$statusMsg");
        exit;
    }
    // Image is good to go
    $image = $_FILES['image']['tmp_name'];
    $imgContent = base64_encode(file_get_contents($image));
    $query =
        "INSERT INTO forum_request
     (StudentID, Title, Author, Status, image_base64)
      VALUES 
      ('$userid', '$title', '$author', 'OPEN', '$imgContent')";
}
$insert = mysqli_query($conn, $query);

if ($insert) {
    $statusMsg = "createsuccess";
} else {
    $statusMsg = "sqlfail";
}
// exit;
header("Location:../forum_list.php?message=$statusMsg");
// Now check for the image if its a valid image
