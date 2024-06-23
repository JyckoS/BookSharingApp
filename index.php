<?php
// Made by Jycko

session_start();
if (!isset($_SESSION["userid"])) {
    header("Location: php/login.php");
    exit;
}

require_once 'php/db_connect.php';;
$conn = openConnection();

$userId = $_SESSION['userid'] ?? null;
$userType = null;

if ($userId) {
    $sql = "SELECT UserType FROM manager WHERE ManagerID = '$userId'";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $userType = $user['UserType'];
    }
}



//$bookID = $_GET['bookID'];
?>

<!DOCTYPE html>
<html>

<head>
    <title>Book Sharings App MMU</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="css/footerstyle.css">
    <link rel="stylesheet" href="css/headerstyle.css">
</head>

<body>
    <header>
        <div class="headerstyle">
            <img src="images/mmu_logo.png" alt="Logo">
            <div class="topnav">
                <a href="index.php">Home</a>
                <a href="php/searchbooks.php">Search Books</a>
                <a href="php/loanbooks.php">Loan Books</a>
                <a href="php/forum_list.php">Request Books</a>

                <!-- Conditionally display Manager Function link -->
                <?php if ($userType === 'MANAGER') { ?>
                    <a href="php/manager.php">Manager Function</a>
                <?php } ?>

            </div>
            <button class="accountprofile" onclick="window.location.href='php/account_profile.php'">
                    <img src="images/profileicon.jpg" alt="Profile Icon">
                </button>
                <button class="accountprofile" onclick="window.location.href='php/actions/process_logout.php'">
                    <img src="images/logout.jpg" alt="Logout Button">
                </button>
        </div>
    </header>

    <h3 class = "information">
        MMU's Book Sharing Center (BDC) aims to foster a culture of reading and lifelong learning 
        by providing free access to books for students within Multimedia University.
        By recycling educational and recreational literature, the center will bridge the 
        gap between those who have excess books and those who need them, promoting sustainability and social responsibility.
    </h3>
    
    

    <section class = "container">
        <div class = "wrapper">
            <div class = "slideshow">
                <img id = "slide1" src = "images/index-join.jpg" alt = "Join Community"/>
                <img id = "slide2" src = "images/index-share.jpg" alt = "Share Books"/>
            </div>
            <div class = "slideshow-nav">
                    <a href = "#slide1"></a>
                    <a href = "#slide2"></a>
            </div>
        </div>
    </section>

    <br>

    

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
            <a href="php/feedback.php">Send Feedback</a>
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
