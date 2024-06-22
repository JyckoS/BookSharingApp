<?php
// Made by JYCKO

require_once "../db_connect.php";
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: ../view_book.php?message=error");
    exit;
}

session_start();
$conn = openConnection();
$loanID = $_POST["LoanID"];
$status = mysqli_real_escape_string($conn, $_POST['ChangeStat']);
$bookid = mysqli_real_escape_string($conn, $_POST['BookID']);
$query = "UPDATE books SET Status='$status' WHERE BookID='$bookid'";
$result = mysqli_query($conn, $query);
echo "Success";
echo "Debug: '$loanID'";
header("Location: ../view_book.php?loan_id=$loanID");



?>