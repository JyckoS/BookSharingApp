<?php
// Made by Jycko & Batrisyia
require_once "../db_connect.php";
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: ../loanbooks.php?message=error");
    exit;
}

session_start();
$conn = openConnection();
$title = mysqli_real_escape_string($conn, $_POST['title']);
$author = mysqli_real_escape_string($conn, $_POST['author']);
$genre = mysqli_real_escape_string($conn, $_POST['genre']);
$description = mysqli_real_escape_string($conn, $_POST['description']);
$publisher = mysqli_real_escape_string($conn, $_POST['publisher']);
$yearPublished = mysqli_real_escape_string($conn, $_POST['yearPublished']);
$bookCondition = mysqli_real_escape_string($conn, $_POST['bookCondition']);
$startDate = mysqli_real_escape_string($conn, $_POST['startDate']);
$endDate = mysqli_real_escape_string($conn, $_POST['endDate']);
$userID = $_SESSION["userid"];
if (empty($title) || empty($author) || empty($genre) || empty($description) ||
empty($publisher) || empty($yearPublished) || empty($bookCondition) || empty($startDate
|| empty($endDate))) {
    header("Location: ../loanbooks.php?message=empty");
    exit;
}

$query = "INSERT INTO loan (StudentID, LoanDate, ExpiryDate) 
VALUES
('$userID', '$startDate', '$endDate');";

$insert = mysqli_query($conn, $query);


if (!$insert) {
    header("Location: ../loanbooks.php?message=sqlerror1");
    exit;
}
$loanID = mysqli_insert_id($conn);


$query = "INSERT INTO books 
(LoanID, Title, Author, Genre, Description, Publisher, YearPublished, BookCondition, Status, StudentID) 
VALUES 
('$loanID', '$title', '$author', '$genre', '$description', '$publisher', '$yearPublished', '$bookCondition', 'PENDING', '$userID')";

$insert = mysqli_query($conn, $query);

if (!$insert) {
    header("Location: ../loanbooks.php?message=sqlerror2");
    exit;
}
header("Location: ../loanbooks.php?message=success");
exit;

?>