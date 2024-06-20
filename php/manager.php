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
