<!-- MADE BY JYCKO -->
<?php
require_once "../db_connect.php";
// echo 'a';
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: ../forum_list.php?message=error");

    exit;
}

if (!isset($_POST["requestID"]) || !isset($_POST["newStatus"])) {
    header("Location: ../forum_list.php?message=error");

    exit;
}
// echo 'c';
$conn = openConnection();
$newStatus = $_POST["newStatus"];
$requestID = $_POST["requestID"];
// echo "New '$newStatus': req '$requestID'";
$sql = "UPDATE forum_request SET Status='$newStatus' WHERE RequestID='$requestID'";
$update = mysqli_query($conn, $sql);

if ($update) {
    // Redirect back to the thread page with a success message
    header("Location: ../forum_thread.php?id=$requestID");
    exit;
} else {
    echo "Error occured";
} ?>