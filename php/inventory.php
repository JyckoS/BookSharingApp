<?php
session_start();
if (!isset($_SESSION["userid"])) {
    header("Location: login.php");
    exit;
}

require 'db_connect.php';
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../css/footerstyle.css">
    <link rel="stylesheet" href="../css/headerstyle.css">
    <link rel="stylesheet" href="../css/button.css">
    <link rel="stylesheet" href="../css/managetable.css">

    <title>Inventory - Book Sharings App MMU</title>
</head>

<body>
    <?php
    include "includes/header.php";
    ?>

    <?php
    $userId = $_SESSION["userid"];
    // Fetch data from borrow table for the logged-in user
    $sql = "SELECT BorrowID, BookID, StudentID, BorrowDate, ReturnDate FROM borrow WHERE StudentID = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $userId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    ?>

    <div class="content">
        <h2>Your Borrowed Books</h2>
        <a href="account_profile.php" class="button">Back to Profile</a>
        <div class="table-container">
            <table>
                <tr>
                    <th>BorrowID</th>
                    <th>BookID</th>
                    <th>StudentID</th>
                    <th>BorrowDate</th>
                    <th>ReturnDate</th>
                </tr>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['BorrowID']; ?></td>
                        <td><?php echo $row['BookID']; ?></td>
                        <td><?php echo $row['StudentID']; ?></td>
                        <td><?php echo $row['BorrowDate']; ?></td>
                        <td><?php echo $row['ReturnDate']; ?></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
    <?php
    include "includes/footer.php";
    ?>
</body>

</html>
<?php
closeConnection($conn);
?>
