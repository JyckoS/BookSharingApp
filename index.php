<?php
// Made by Jycko

session_start();
if (!isset($_SESSION["userid"])) {
    header("Location: php/login.php");
    exit;
}

?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/footerstyle.css">
    <link rel="stylesheet" href="css/headerstyle.css">
    <title>Book Sharings App MMU</title>
</head>
<body>
<?php
require_once 'php/db_connect.php';;
$conn = openConnection();
?>

<?php
$userId = $_SESSION['userid'] ?? null;
$userType = null;

if ($userId) {
    $sql = "SELECT UserType FROM manager WHERE ManagerID = '$userId'";
    $result = mysqli_query($connection, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $userType = $user['UserType'];
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/headerstyle.css">
</head>

<body>
    <header>
        <div class="headerstyle">
            <img src="images/mmu_logo.png" alt="Logo">
            <div class="topnav">
                <a href="index.php">Home</a>
                <a href="#search">Search Books</a>
                <a href="#loan">Loan Books</a>
                <a href="php/forum_list.php">Request Books</a>

                <!-- Conditionally display Manager Function link -->
                <?php if ($userType === 'MANAGER') { ?>
                    <a href="php/manager.php">Manager Function</a>
                <?php } ?>

                <a href="actions/process_logout.php">Logout</a>
            </div>
        </div>
    </header>
</body>

</html>

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
