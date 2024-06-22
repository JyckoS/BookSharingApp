<?php
// Made by Jycko

require_once "../db_connect.php";
$conn = openConnection();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $questionid = $_POST["questionid"];
    $message = $_POST["message"];
    $message = mysqli_real_escape_string($conn, $message);
    if (empty($message) || empty($questionid)) {
        echo "Missing fields, exiting";
        exit;
    }
    
    $query = "UPDATE faq SET Answer = '$message' WHERE QuestionID = '$questionid'";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        echo "Error in sending answer.";
        exit;
    }
    echo "Suceeded in sending answer.";
    header("Location: ../manager_faq.php?message=success");
    exit;
}
?>