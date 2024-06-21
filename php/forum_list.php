<?php
// Made By JYcko

session_start();
if (!isset($_SESSION["userid"])) {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<!-- Made by Jycko -->
<html>
    <head>
        <title>Request Bookss - MMU Book Sharing</title>
        <link rel="stylesheet" href="../css/forum_list.css">
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
                    $status = $row["Status"];
                   // $image = $row["image_base64"];
                    $id = $row["RequestID"];
                    // Check if image exists, if not then use dummy image
                    $imageSrc = getImageSrc($row);
                    echo "<tr>";

                    echo "<td>
                    <img src='$imageSrc' alt='cover'>
                    </td>
                    <td>$title</td>
                    <td>$author</td>
                    <td>$requestdate</td>";
                    if ($status == "OPEN") {
                    echo "
                    <td class='statusopen'>$status</td>";
                    }
                    else {
                        echo "<td class='statusclosed'>$status</td>";
                    }
                    echo "<td data-label='Action'><a href='forum_thread.php?id=$id' class='button'>Open</a></td>

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