<?php
session_start();
require_once("../db_connect.php");

$conn = openConnection();
if ($_SERVER["REQUEST_METHOD"] != "POST") {

    exit;
}

if (!isset($_GET['bookID'])) {
    header("Location:../bookdetails.php"); // Redirect if bookID parameter is missing
    exit;
}

$bookID = $_GET['bookID'];
$sql = "SELECT * FROM books WHERE BookID = $bookID";
$result = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($result);
$bookID = $row['BookID'];

$commentReview = mysqli_real_escape_string($conn, $_POST["commentReview"]);


$userid = $_SESSION["userid"];
if (empty($userid)) {
    header("Location: ../login.php?message=notloggedin");
    exit;
}

$query =
    "INSERT INTO review
 (ReviewID, StudentID, BookID, CommentReview, ReviewDate)
  VALUES 
  ('$reviewID', '$userid', '$bookID', '$commentReview', '$reviewDate')"
  ;
$insert = mysqli_query($conn, $query);

?>
