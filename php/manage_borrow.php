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

    <title>Manage Borrow - Book Sharings App MMU</title>
</head>

<body>
    <?php
    include "includes/header.php";
    ?>

    <?php

    // Fetch data from borrow table
    $sql = "SELECT BorrowID, BookID, StudentID, BorrowDate, ReturnDate FROM borrow";
    $result = mysqli_query($conn, $sql);

    ?>

    <div class="content">
        <h2>Manage Borrow</h2>
        <a href="manager.php" class="button">Back</a>
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