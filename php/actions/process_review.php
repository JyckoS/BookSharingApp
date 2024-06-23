<?php
// Made by Batrisyai and Jycko
session_start();
require_once("../db_connect.php");

$conn = openConnection();
if ($_SERVER["REQUEST_METHOD"] != "POST") {

    exit;
}

if (!isset($_POST['bookID'])) {
    header("Location:../searchbooks.php"); // Redirect if bookID parameter is missing
    exit;
}
$connection = openConnection();

$bookID = $_POST['bookID'];
$commentReview = mysqli_real_escape_string($conn, $_POST["commentReview"]);


$userid = $_SESSION["userid"];
if (empty($userid)) {
    header("Location: ../login.php?message=notloggedin");
    exit;
}
echo "'$bookID' '$userid' '$commentReview'";

$query =
    "INSERT INTO review
 (StudentID, BookID, CommentReview, ReviewDate)
  VALUES 
  ('$userid', '$bookID', '$commentReview', NOW())"
  ;
$insert = mysqli_query($connection, $query);

if (!$insert) {
    header("Location: ../bookdetails.php?bookID=$bookID&message=errorsql");
    exit;
}
header("Location: ../bookdetails.php?bookID=$bookID&message=success");

?>
