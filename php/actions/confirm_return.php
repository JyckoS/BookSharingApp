<?php
session_start();
if (!isset($_SESSION["userid"])) {
    header("Location: login.php");
    exit;
}

require 'db_connect.php';
$connection = openConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $borrowId = $_POST['BorrowID'];
    $bookId = $_POST['BookID'];

    // Begin transaction
    mysqli_begin_transaction($connection);

    try {
        // Delete from borrow table
        $sqlDeleteBorrow = "DELETE FROM borrow WHERE BorrowID = ?";
        $stmtDeleteBorrow = mysqli_prepare($connection, $sqlDeleteBorrow);
        mysqli_stmt_bind_param($stmtDeleteBorrow, "i", $borrowId);
        mysqli_stmt_execute($stmtDeleteBorrow);

        if (mysqli_stmt_affected_rows($stmtDeleteBorrow) > 0) {
            // Update books table to set status to AVAILABLE
            $sqlUpdateBook = "UPDATE books SET Status = 'AVAILABLE' WHERE BookID = ?";
            $stmtUpdateBook = mysqli_prepare($connection, $sqlUpdateBook);
            mysqli_stmt_bind_param($stmtUpdateBook, "i", $bookId);
            mysqli_stmt_execute($stmtUpdateBook);

            if (mysqli_stmt_affected_rows($stmtUpdateBook) > 0) {
                // Commit transaction
                mysqli_commit($connection);
                $_SESSION['message'] = "Book return confirmed successfully.";
            } else {
                // Rollback transaction
                mysqli_rollback($connection);
                $_SESSION['message'] = "Failed to update book status.";
            }
        } else {
            // Rollback transaction
            mysqli_rollback($connection);
            $_SESSION['message'] = "Failed to remove borrow entry.";
        }

        mysqli_stmt_close($stmtDeleteBorrow);
        mysqli_stmt_close($stmtUpdateBook);

    } catch (Exception $e) {
        // Rollback transaction
        mysqli_rollback($connection);
        $_SESSION['message'] = "Transaction failed: " . $e->getMessage();
    }
}

closeConnection($connection);

// Redirect back to manage_borrow.php
header("Location: manage_borrow.php");
exit;
?>
