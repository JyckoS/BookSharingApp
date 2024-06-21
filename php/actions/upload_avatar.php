<?php
// MADE BY JYCKO

require_once("../db_connect.php");
session_start();
$conn = openConnection();
// Made by JYCKO
if ($_SERVER["REQUEST_METHOD"] != "POST") {

    exit;
}
$userid = $_POST["userID"];

if (empty($_FILES['image']['name'])) {
    header("Location: ../account_profile.php");
    exit;
}
$fileName = basename($_FILES['image']['name']);
$fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
$fileType = strtolower($fileExt);

$allowTypes = array('jpg', 'jpeg', 'png', 'gif');
if (!in_array($fileType, $allowTypes)) {
    header("Location: ../account_profile.php?message=wrongfile");
    exit;
}
$usertype = $_SESSION["usertype"];
// Image is good to go
$image = $_FILES['image']['tmp_name'];
$imgContent = base64_encode(file_get_contents($image));
$query =
    "UPDATE students SET image_base64='$imgContent' WHERE StudentID='$userid'";
if ($usertype == "MANAGER") {
    $query =
    "UPDATE manager SET image_base64='$imgContent' WHERE ManagerID='$userid'";
}

$update = mysqli_query($conn, $query);
if (!$update) {
    header("Location: ../account_profile.php?message=errorupload");
    exit;
}
header("Location: ../account_profile.php?message=success");

?>