<!DOCTYPE html>
<html>
    <!-- Made by jycko -->
    <head>
        <link rel="stylesheet" href="../css/headerstyle.css">
        <link rel="stylesheet" href="css/headerstyle.css">

    </head>
    <body>
        <header>
            <div class = "topnav">
                <a href = "index.php"> Home </a>
                <a href = "#search"> Search Books </a>
                <a href = "#loan"> Loan Books </a>
                <a href = "registration.php"> Register Account </a>
                <a href = "login.php"> Log In </a>
            </div>

            <div class="headerstyle">
                <div>
                    <?php
                    $filename =  basename($_SERVER['PHP_SELF']);
                    if ($filename == "index.php" || $filename == "registration.php" || $filename == "login.php") {
                        echo '<img src="../images/mmu_logo.png" alt="Logo">';
                        return;
                    }
                    echo '<img src="../images/mmu_logo.png" alt="Logo">';
                    ?>
                </div>
            </div>
            <!-- Login button later -->
        </header>
    </body>
</html>
