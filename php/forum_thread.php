<?php
//Made By Jycko

session_start();
if (!isset($_SESSION["userid"])) {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Request Thread - Book SharingApp</title>
    <link rel="stylesheet" href="../css/forum_thread.css">

</head>

<body>
    <?php include "includes/header.php"; ?>
    <h1>
        <a href="forum_list.php">Request Forum</a> > Book Request Info
    </h1>
    <div class="thread">
        <?php
        if (!isset($_GET["id"]) || empty($_GET["id"])) {
            exit;
        }
        require_once "db_connect.php";
        session_start();
        $id = $_GET["id"];
        $conn = openConnection();
        $sql = "SELECT * FROM forum_request WHERE RequestID='$id'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) <= 0) {
            header("Location: forum_list.php?message=unknownid");
            exit;
        }
        $row = mysqli_fetch_assoc($result);
        $ownerID = $row["StudentID"];
        $title = $row["Title"];
        $author = $row["Author"];
        $posts = $row["ForumPosts"];
        $userID = $_SESSION["userid"];
        $userType = $_SESSION["usertype"];
        $hasAccess = false;
        if ($userID == $ownerID) $hasAccess = true;
        if ($userType == "MANAGER") $hasAccess = true;
        $ownerData = getUserRowData($ownerID);
        $ownerImage = getImageSrc($ownerData);
        $ownerName = $ownerData["Name"];
        $ownerType = $ownerData["UserType"];
        $status = $row['Status']; 

        if ($hasAccess) {
            $newStatus = ($status == 'OPEN') ? 'CLOSED' : 'OPEN';
            $buttonText = ($status == 'OPEN') ? 'Mark as Closed' : 'Mark as Open';
            
            echo "
                <form method='post' action='actions/process_status.php'>
                    <input type='hidden' name='requestID' value='$id'>
                    <input type='hidden' name='newStatus' value='$newStatus'>
                    <button type='submit'>$buttonText</button>
                </form>
            ";        
        }
        echo "<table>";
        // Make owner post
        echo "<tr class='owner'>
        <td class='user'><img src='$ownerImage' alt='cover'>
         <p>$ownerName</p> 
         <p>$ownerType</p>
         </td>
        <td class='content'> 
        <p>Requested book: <a>$title</a></p>
        <p>Book Author: <a>$author</a></p>
        
        </td>
        </tr>";
        if ($status == "OPEN") {
        // Now make reply button
         echo "<tr>
         <td colspan='2'>
             <form class='reply_form' action='actions/process_reply.php' method='post'>
                 <input type='hidden' id='requestID' name='requestID' value='$id'>
                <input type='hidden' id='userID' name='userID' value='$userID'>
                
                 <textarea name='replyContent' rows='4' cols='50' required></textarea>
                 <br>
                 <button type='submit'>Submit Reply</button>
             </form>
         </td>
         </tr>";
        }
        if (isset($posts) && !empty($posts)) {
            $postsArray = json_decode($posts, true);
            foreach ($postsArray as $postid) {
                $postData = getPostData($postid);
                if ($postData == "unknown") continue;
                $posterData = getUserRowData($postData["StudentID"]);
                $posterName = $posterData["Name"];
                $posterImage = getImageSrc($posterData);
                $posterType = $posterData["UserType"];
                $postContent = $postData["Content"];
            // Make other posts, reply etc.
            echo "
        <tr>
        <td class='user'>
        <img src='$posterImage' alt='cover'>
        <p>$posterName</p>
        <p>$posterType</p>
        </td>
        <td class='content'>
        <p>$postContent</p>
        </td>
        </tr>";
            }
        }
        echo "</table>";
        ?>


    </div>



    <?php include "includes/footer.php"; ?>

</body>

</html>