<!-- Made by Chew -->

<?php
session_start();
if (!isset($_SESSION["userid"])) {
    header("Location: login.php");
    exit;
}

require 'db_connect.php';
$connection = openConnection();
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../css/footerstyle.css">
    <link rel="stylesheet" href="../css/headerstyle.css">
    <link rel="stylesheet" href="../css/button.css">
    <title>Manager Panel - Book Sharings App MMU</title>
</head>

<body>
    <?php
    include "includes/header.php";
    ?>
    <div class="content">
        <h2>Welcome, Manager!</h2>
        <div class="button-container">
            <a href="manage_borrow.php" class="square-button">Manage Borrow</a>
            <a href="manage_loan.php" class="square-button">Manage Loans</a>
            <a href="manager_feedback.php" class="square-button">See Feedbacks</a>
            <a href="manager_faq.php" class="square-button">Answer FAQ</a>
            <a href="manager_students.php" class="square-button">Students List</a>

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