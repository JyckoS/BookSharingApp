<!-- Made by Chew -->

<?php
// borrowform.php
session_start();

require "db_connect.php";

if (!isset($_SESSION["userid"])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['bookID'])) {
    header("Location: searchbooks.php"); // Redirect if bookID parameter is missing
    exit;
}

$bookID = $_GET['bookID'];
$userID = $_SESSION["userid"]; // Get the logged-in user's ID
?>



<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../css/footerstyle.css">
    <link rel="stylesheet" href="../css/headerstyle.css">
    <link rel="stylesheet" href="../css/button.css">
    <link rel="stylesheet" href="../css/managetable.css">
    <link rel="stylesheet" href="../css/manager_view_book.css">
    <title>Borrow Book - Book Sharings App MMU</title>
</head>

<body>
    <header>
        <?php include "includes/header.php"; ?>
    </header>


    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $borrowDate = date('Y-m-d');
        $returnDate = $_POST['returnDate']; // Get the return date from the form
    
        $insertBorrowSQL = "INSERT INTO borrow (StudentID, BookID, BorrowDate, ReturnDate) VALUES ('$userID', '$bookID', '$borrowDate', '$returnDate')";
        mysqli_query($conn, $insertBorrowSQL);

        // Update book status to 'BORROWED'
        $updateBookSQL = "UPDATE books SET Status = 'BORROWED' WHERE BookID = $bookID";
        mysqli_query($conn, $updateBookSQL);

        echo "<script>alert('Book borrowed successfully!'); window.location.href='bookdetails.php?bookID=$bookID';</script>";
    }

    ?>

    <div class="content">
        <h2>Borrow Book</h2>
        <form method="post">
            <label for="returnDate">Return Date (YYYY-MM-DD):</label>
            <input type="date" id="returnDate" name="returnDate" required>
            <button type="submit" class="button">Confirm Borrow</button>
        </form>
        <a href="bookdetails.php?bookID=<?php echo $bookID; ?>" class="button">Cancel</a>
    </div>

    <?php include "includes/footer.php"; ?>
</body>

</html>

<?php
closeConnection($conn);
?>