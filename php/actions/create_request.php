<?php
require_once "../db_connect.php";
$conn = openConnection();
// Made by JYCKO
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    exit;    
}
// Check title, book author and if they uploaded anbook cover image
$title = mysqli_real_escape_string($conn, $_POST["title"]);
$author = mysqli_real_escape_string($conn, $_POST["author"]);

$cover_picture = "";
if (isset($_POST["cover_picture"]) && $_FILES["cover_picture"]["error"] <= 0) {
    
}
// Now check for the image if its a valid image
?>