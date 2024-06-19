<?php
// Made by Jycko
include 'php/db_connect.php';

session_start();
if (!isset($_SESSION["userid"])) {
    header("Location: php/login.php");
    exit;
}

$connection = openConnection();

$userId = $_SESSION["userid"];
$sql = "SELECT UserType FROM manager WHERE ManagerID='$userId'";
$result = mysqli_query($connection, $sql);
$user = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/footerstyle.css">
    <link rel="stylesheet" href="css/headerstyle.css">
    <title>Book Sharings App MMU</title>
</head>
<body>
<header>
    <div class="headerstyle">
        <div>
            <img src="images/mmu_logo.png" alt="Logo">
            <a href="php/actions/process_logout.php">Logout</a>
        </div>
    </div>
</header>
<div>
    <?php if ($user['UserType'] == 'MANAGER') { ?>
        <a href="php/manager.php">Manager Panel</a>
    <?php } ?>
</div>
<footer>
    <div class="footerstyle">
        <div>
            <h4>MMU Book Sharing</h4>
            <p>We help MMU Students to share and exchange books.</p>
        </div>
        <div>
            <h4>Navigation</h4>
            <a href="index.php">Home</a>
            <a href="php/aboutus.php">About Us</a>
            <a href="php/faq.php">FAQs</a>
        </div>
        <div>
            <p class="copyright">&copy; MMU Book Sharing. All rights belongs to MMU.</p>
        </div>
    </div>
</footer>
</body>
</html>
<?php
closeConnection($connection);
?>
