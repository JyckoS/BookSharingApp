<?php
session_start();
if (!isset($_SESSION["userid"])) {
    header("Location: login.php");
    exit;
}

require 'db_connect.php';
$connection = openConnection();

// Pagination setup
$limit = 5; // Number of entries to show in a page.
if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
}
;
$start_from = ($page - 1) * $limit;

// Fetch data from loan table
$sql = "SELECT LoanID, StudentID, LoanDate, ExpiryDate FROM loan LIMIT $start_from, $limit";
$result = mysqli_query($connection, $sql);

// Fetch total number of records
$sql_total = "SELECT COUNT(*) FROM loan";
$result_total = mysqli_query($connection, $sql_total);
$row_total = mysqli_fetch_row($result_total);
$total_records = $row_total[0];
$total_pages = ceil($total_records / $limit);
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
        <div class="pagination">
            <?php
            for ($i = 1; $i <= $total_pages; $i++) {
                echo "<a href='manage_loans.php?page=" . $i . "' class='" . ($page == $i ? "active" : "") . "'>" . $i . "</a> ";
            }
            ?>
        </div>
    </div>
    <?php
    include "includes/footer.php";
    ?>
</body>

</html>
<?php
closeConnection($connection);
?>