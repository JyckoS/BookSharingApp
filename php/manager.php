<?php

session_start();
if (!isset($_SESSION["userid"])) {
    header("Location: login.php");
}
?>
<?php
require_once 'db_connect.php';
$conn = openConnection();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manager Panel</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h2>Welcome, Manager!</h2>
    <a href="php/actions/process_logout.php">Logout</a>
    <h3>Manage Records</h3>
    <ul>
        <li><a href="manage_books.php">Manage Books</a></li>
        <li><a href="manage_borrow.php">Manage Borrow</a></li>
        <li><a href="manage_faq.php">Manage FAQ</a></li>
        <li><a href="manage_feedback.php">Manage Feedback</a></li>
        <li><a href="manage_forum_post.php">Manage Forum Posts</a></li>
        <li><a href="manage_forum_request.php">Manage Forum Requests</a></li>
        <li><a href="manage_loan.php">Manage Loans</a></li>
        <li><a href="manage_manager.php">Manage Managers</a></li>
        <li><a href="manage_review.php">Manage Reviews</a></li>
        <li><a href="manage_students.php">Manage Students</a></li>
    </ul>
</body>
</html>
<?php
closeConnection($connection);
?>

