
<?php
// MADE BY JYCKO
require_once '../db_connect.php';

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: ../forum_list.php?message=error");

    exit;
}
if (!isset($_POST["userID"])) {
    header("Location: ../forum_list.php?message=error");

    exit;
}
if (!isset($_POST["question"]) || empty($_POST["question"])) {
    header("Location: ../forum_thread.php?id=$requestID");

    exit;
}
$conn = openConnection();
// Insert post into the forum_post
$content = mysqli_real_escape_string($conn, $_POST["question"]);
$userID = mysqli_real_escape_string($conn, $_POST["userID"]);

$sql = "INSERT INTO faq (StudentID, Content, Answer) VALUES ('$userID', '$content', 'None')";

$insert = mysqli_query($conn, $sql);

if (!$insert) {
    header("Location: ../faq.php?message=error");

    exit;
}
header("Location: ../faq.php?message=success");


?>