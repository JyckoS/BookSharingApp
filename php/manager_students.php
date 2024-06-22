<?php
// by jcko
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
    <title>Manager - Student List</title>
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
            </thead>
            <tbody>
                <?php
                require_once "db_connect.php";
                $conn = openConnection();
                $sql = "SELECT * FROM students";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {

                    $userid = $row["StudentID"];

                    // question is unanswered yet
                    $userName = $row["Name"];
                    $email = $row["Email"];
                    echo "<tr> 
                    <td>$userName</td>
                    <td>$userid</td>
                    <td>$email</td>
                    </tr>";
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