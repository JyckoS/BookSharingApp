<!-- MADE BY JYCKO -->
<?php
require_once "../db_connect.php";

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: ../forum_list.php?message=error");

    exit;
}
if (!isset($_POST["requestID"]) || !isset($_POST["userID"])) {
    header("Location: ../forum_list.php?message=error");

    exit;
}
$requestID = $_POST["requestID"];
if (!isset($_POST["replyContent"]) || empty($_POST["replyContent"])) {
    header("Location: ../forum_thread.php?id=$requestID");

    exit;
}
$conn = openConnection();
// Insert post into the forum_post
$content = mysqli_real_escape_string($conn, $_POST["replyContent"]);
$userID = mysqli_real_escape_string($conn, $_POST["userID"]);

$sql = "INSERT INTO forum_post (StudentID, Content) VALUES ('$userID', '$content')";

$insert = mysqli_query($conn, $sql);

if (!$insert) {
    header("Location: ../forum_thread.php?id=$requestID&message=error");

    exit;
}

$postID = mysqli_insert_id($conn);
// Get posts in the thread
$sql_update = "UPDATE forum_request 
SET ForumPosts = JSON_ARRAY_APPEND(ForumPosts, '$', '$postID') WHERE RequestID='$requestID'";
$result = mysqli_query($conn, $sql_update);
if (!$result) {
    header("Location: ../forum_thread.php?id=$requestID&message=error");

    exit;
}
header("Location: ../forum_thread.php?id=$requestID");


?>