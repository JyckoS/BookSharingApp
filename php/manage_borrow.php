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
    $page  = $_GET["page"]; 
} else { 
    $page = 1; 
};  
$start_from = ($page-1) * $limit;

// Fetch data from borrow table
$sql = "SELECT BorrowID, BookID, StudentID, BorrowDate, ReturnDate FROM borrow LIMIT $start_from, $limit";
$result = mysqli_query($connection, $sql);

// Fetch total number of records
$sql_total = "SELECT COUNT(*) FROM borrow";
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

    <title>Manage Borrow - Book Sharings App MMU</title>
</head>
<body>
<?php
    include "includes/header.php";
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
            <?php while($row = mysqli_fetch_assoc($result)) { ?>
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
    <div class="pagination">
        <?php
        for ($i=1; $i<=$total_pages; $i++) { 
            echo "<a href='manage_borrow.php?page=".$i."' class='".($page == $i ? "active" : "")."'>".$i."</a> "; 
        }
        ?>
    </div>
</div>
<footer>
    <div class="footerstyle">
        <div>
            <h4>MMU Book Sharing</h4>
            <p>We help MMU Students to share and exchange books.</p>
        </div>
        <div>
            <h4>Navigation</h4>
            <a href="../index.php">Home</a>
            <a href="aboutus.php">About Us</a>
            <a href="faq.php">FAQs</a>
        </div>
        <div>
            <p class="copyright">&copy; MMU Book Sharing. All rights belong to MMU.</p>
        </div>
    </div>
</footer>
</body>
</html>
<?php
closeConnection($connection);
?>
