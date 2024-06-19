<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../css/headerstyle.css">
        <link rel="stylesheet" href="css/headerstyle.css">

    </head>
    <body>
        <header>
            <div class="headerstyle">
                <div>
                    <?php
                    $filename =  basename($_SERVER['PHP_SELF']);
                    if ($filename == "index.php") {
                        echo '<img src="images/mmu_logo.png" alt="Logo">';
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