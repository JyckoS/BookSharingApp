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

    <title>Manage Loans - Book Sharings App MMU</title>
</head>

<body>
    <?php
    include "includes/header.php";
    ?>

    <?php

    // Fetch data from loan table
    $sql = "SELECT LoanID, StudentID, LoanDate, ExpiryDate FROM loan";
    $result = mysqli_query($conn, $sql);

    ?>

    <div class="content">
        <h2>Manage Loans</h2>
        <a href="manager.php" class="button">Back</a>
        <div class="table-container">
            <table>
                <tr>
                    <th>LoanID</th>
                    <th>StudentID</th>
                    <th>LoanDate</th>
                    <th>ExpiryDate</th>
                </tr>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['LoanID']; ?></td>
                        <td><?php echo $row['StudentID']; ?></td>
                        <td><?php echo $row['LoanDate']; ?></td>
                        <td><?php echo $row['ExpiryDate']; ?></td>
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