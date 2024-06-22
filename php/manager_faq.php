<?php
// Made by Jycko
session_start();
if (!isset($_SESSION["userid"])) {
    header("Location: login.php");
    exit;
}
if ($_SESSION["usertype"] != "MANAGER") {
    header("Location: login.php");
    exit;
}


?>
<!DOCTYPE html>

<html>

<head>
    <title>Manager - Answer FAQ</title>
    <link rel="stylesheet" href="../css/manager_feedback.css">
</head>

<body>
    <?php
    include "includes/header.php";
    ?>
    <article class="padd">
        <a href="manager.php" class="button">Back</a>
        <table>
            <thead>
                <th>Student Name</th>
                <th>Student ID</th>
                <th>Student Email</th>

                <th>Question</th>
                <th>Answer</th>
            </thead>
            <tbody>
                <?php
                require_once "db_connect.php";
                $conn = openConnection();
                $sql = "SELECT * FROM faq";
                $result = mysqli_query($conn, $sql);
                $nothing = true;
                while ($row = mysqli_fetch_assoc($result)) {

                    $qID = $row["QuestionID"];
                    $userid = $row["StudentID"];
                    $userData = getUserRowData($userid);
                    $content = $row["Content"];
                    $answer = $row["Answer"];

                    if ($answer != "None") continue;
                    $nothing = false;
                    // question is unanswered yet
                    $userName = $userData["Name"];
                    $email = $userData["Email"];
                    echo "<tr> 
                    <td>$userName</td>
                    <td>$userid</td>
                    <td>$email</td>
                    <td>$content</td>
                                                <form action='actions/answer_faq.php' method='post'>

                    <td>

        <textarea id='message' name='message' rows='3' required></textarea>
        <input type='hidden' name='questionid' value='$qID'>

                    </td>
                    <td>
        <input class='button' type='submit' value='Send Answer'>
                    </td>
                            </form>

                    </tr>";
                }

                if ($nothing) {
                    echo "<tr> <td colspan='5'>There are no FAQ questions.</td></tr>";
                }
                ?>
            </tbody>
        </table>

    </article>

    <?php
    include "includes/footer.php";
    ?>
</body>

</html>