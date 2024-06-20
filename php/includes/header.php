<?php
require_once 'db_connect.php';
;
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
<!-- Made by jycko & batrisyia -->

<head>
    <link rel="stylesheet" href="../css/headerstyle.css">
</head>

<body>
    <header>
        <div class="headerstyle">
            <img src="../images/mmu_logo.png" alt="Logo">
            <div class="topnav">
                <a href="../index.php">Home</a>
                <a href="#search">Search Books</a>
                <a href="#loan">Loan Books</a>
                <a href="forum_list.php">Request Books</a>

                <!-- Conditionally display Manager Function link -->
                <?php if ($userType === 'MANAGER') { ?>
                    <a href="manager.php">Manager Function</a>
                <?php } ?>

                <a href="actions/process_logout.php">Logout</a>
            </div>
        </div>
    </header>
</body>

</html>