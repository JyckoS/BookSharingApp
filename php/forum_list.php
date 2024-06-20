<?php


session_start();
if (!isset($_SESSION["userid"])) {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<!-- Made by Jycko -->
<html>
    <head>
        <title>Request Books - MMU Book Sharing</title>
        <link rel="stylesheet" href="../css/forumlist.css">
    </head>
    <body>
        <?php
        include "includes/header.php";
        ?>

        <div class="forum">
            <h1>Request Forum - List of Requests</h1>
            <a href="forum_create.php">Create Request</a>
            <table>
            <thead>    
            <tr>
                <th></th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Request Date</th>
                    <th>Status</th>
                </tr>
</thead>
<tbody>
                <?php
                require_once "db_connect.php";
                $conn = openConnection();
                $query = "SELECT * FROM forum_request ORDER BY RequestDate DESC";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    $title = $row["Title"];
                    $userid = $row["StudentID"];
                    $author = $row["Author"];
                    $requestdate = $row["RequestDate"];
                    $status = $row["status"];
                    $image = $row["image_base64"];
                
                    // Check if image exists, if not then use dummy image
                    $imageSrc = "../images/dummy_cover.jpg";
                    if (!empty($image)) {
                        $imageSrc = "data:image/jpeg;base64," . $image;
 
                    }
                    echo "<tr>";

                    echo "<td>
                    <img src='$imageSrc' alt='cover'>
                    </td>
                    <td>$title</td>
                    <td>$author</td>
                    <td>$requestdate</td>
                    <td>$status</td>
                    ";
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
        <?php
        include "includes/footer.php";
        ?>
    </body>
</html>