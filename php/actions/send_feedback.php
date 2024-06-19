<?php
require_once "../db_connect.php";
$conn = openConnection();
// Made by Jycko
// Use student ID from the post["studentid"]
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentid = $_POST["studentid"];
    $message = $_POST["message"];
    if (empty($message) || empty($studentid)) {
        echo "Missing fields, exiting";
        exit;
    }
    echo "$studentid : $message";
    
// INSERT INTO feedback (StudentID, Content) VALUES
// ('1191202266', 'Test 2 feedback content.');
    $query = "INSERT INTO feedback (StudentID, Content) VALUES ('$studentid', '$message')";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        echo "Error in sending feedback.";
        exit;
    }
    echo "Suceeded in sending feedback.";
    header("Location: ../feedback.php?message=success");
    exit;
}
?>