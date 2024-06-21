<!-- Made by JYCKO -->
<?php

session_start();
if (!isset($_SESSION["userid"])) {
    header("Location: login.php");
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>Frequently Asked Questions</title>
    <link rel="stylesheet" href="../css/faq.css">
</head>

<body>
    <?php
    include "includes/header.php";
    ?>
    <div class="faq">
        <h1>FAQ</h1>
        <p>Frequently Asked Questions</p>
        <?php

        require_once 'db_connect.php';

        session_start();

        $userid = $_SESSION["userid"];
        $conn = openConnection();
        $sql = "SELECT * FROM faq";
        $result = mysqli_query($conn, $sql);
        $index = 0;
        while ($row = mysqli_fetch_assoc($result)) {

            $question = $row["Content"];
            $answer = $row["Answer"];
            
            if (empty($answer) || $answer == "None") continue;
            $index++;
            echo "
            <article>
            <h2>Question #$index</h2>
            <h3>$question</h3>
            <p>$answer</p>
            </article>
            ";
        }
        if (isset($_GET["message"])) {
            if ($_GET["message"] == "success") {
                echo "<a>Your question has been sent.</a>";
            }
        }
        echo "
        <form action='actions/process_faq.php' method='post'>
        <input type='hidden' name='userID' value='$userid'>
             
        <textarea name='question' rows='4' cols='50' required></textarea>
        <br>
        <button type='submit'>Submit Question</button>
        </form>";
        ?>
    </div>
    <?php
    include "includes/footer.php";
    ?>
</body>

</html>