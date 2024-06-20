<?php

session_start();
if (!isset($_SESSION["userid"])) {
    header("Location: login.php");
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>FAQ - MMU Book Sharing App</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- <div>
            <h3>Header & Navigation Bar</h3>
            <hr>
        </div> -->
    <?php
    include "includes/header.php";
    ?>
    <div>
        <h1>Frequently Asked Question</h1>
    </div>
    <div>
        <?php
        $sql = 'SELECT * FROM faq';

        if ($result = mysqli_query($conn, $sql)) {
            $questionNum = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                $question = $row['Content'];
                $answer = $row['Answer'];

                echo '<h2>Question #' . $questionNum . '</h2>';
                echo '<strong>' . $question . '</strong>';
                echo '<p>' . $answer . '</p>';
            }
        } else {
            echo "Error: " . mysqli_error($conn);
        }
        closeConnection($conn);
        ?>
    </div>
    <?php
    include "includes/footer.php";
    ?>
    <!-- <div>
            <hr>
            <h4>Footer</h4>
        </div> -->
</body>

</html>