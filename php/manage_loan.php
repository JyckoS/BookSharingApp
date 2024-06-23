<!-- Made by Chew -->

<?php
session_start();
if (!isset($_SESSION["userid"])) {
    header("Location: login.php");
    exit;
}

require 'db_connect.php';

// Initialize mode variable
$showPendingOnly = false;

// Check if the mode toggle is activated
if (isset($_GET['mode']) && $_GET['mode'] == 'pending') {
    $showPendingOnly = true;
}
?>



<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../css/footerstyle.css">
    <link rel="stylesheet" href="../css/headerstyle.css">
    <link rel="stylesheet" href="../css/button.css">
    <link rel="stylesheet" href="../css/managetable.css">

    <style>
        /* Additional styles for the tick icon */
        .tick-icon {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 24px;
            color: green;
        }

        /* Styles for the mode toggle */
        .mode-toggle {
            margin-bottom: 20px;
        }
    </style>

    <title>Manage Loans - Book Sharings App MMU</title>
</head>

<body>
    <?php include "includes/header.php"; ?>

    <?php
    // Fetch data from loan table
    if ($showPendingOnly) {
        // Fetch data only for loans with book status = PENDING
        $sql = "SELECT l.LoanID, l.StudentID, l.LoanDate, l.ExpiryDate FROM loan l 
            INNER JOIN books b ON l.LoanID = b.LoanID 
            WHERE b.Status = 'PENDING'";
    } else {
        // Fetch all loans
        $sql = "SELECT LoanID, StudentID, LoanDate, ExpiryDate FROM loan";
    }
    $result = mysqli_query($conn, $sql);
    ?>

    <div class="content">
        <h2>Manage Loans</h2>
        <a href="manager.php" class="button">Back</a>

        <!-- Mode toggle buttons -->
        <div class="mode-toggle">
            <a href="manage_loan.php" class="button">All Loans</a>
            <a href="manage_loan.php?mode=pending" class="button">Pending Loans Only</a>
        </div>

        <?php if ($showPendingOnly): ?>
            <!-- Display tick icon for pending loans mode -->
            <span class="tick-icon">&#10004;</span>
        <?php endif; ?>

        <div class="table-container">
            <table>
                <tr>
                    <th>LoanID</th>
                    <th>StudentID</th>
                    <th>LoanDate</th>
                    <th>ExpiryDate</th>
                    <th>Actions</th> <!-- New column for actions -->
                </tr>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['LoanID']; ?></td>
                        <td><?php echo $row['StudentID']; ?></td>
                        <td><?php echo $row['LoanDate']; ?></td>
                        <td><?php echo $row['ExpiryDate']; ?></td>
                        <td><a href="view_book.php?loan_id=<?php echo $row['LoanID']; ?>" class="button">View Book
                                Details</a></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>

    <?php include "includes/footer.php"; ?>
</body>

</html>

<?php
closeConnection($conn);
?>