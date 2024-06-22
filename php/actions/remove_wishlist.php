<?php
session_start();
if (!isset($_SESSION["userid"])) {
    header("Location: ../login.php");
    exit;
}

require 'db_connect.php';
$connection = openConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $wishId = $_POST['WishID'];

    // Prepare and execute delete statement
    $sql = "DELETE FROM wishlist WHERE WishID = ?";
    $stmt = mysqli_prepare($connection, $sql);
    if ($stmt === false) {
        die('Prepare failed: ' . mysqli_error($connection));
    }

    mysqli_stmt_bind_param($stmt, "i", $wishId);
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['message'] = "Book removed from wishlist successfully.";
    } else {
        $_SESSION['message'] = "Failed to remove book from wishlist.";
    }

    mysqli_stmt_close($stmt);
}

closeConnection($connection);

// Redirect back to wishlist page
header("Location: ../user_wishlist.php");
exit;
?>
