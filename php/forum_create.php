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
    <title>Create book request - MMU Book Sharing</title>
    <link rel="stylesheet" href="../css/forumlist.css">
</head>

<body>
    <?php
    include "includes/header.php";
    ?>

    <div>
        <h1>
            <a href="forum_list.php">Request Forum</a> -> Create book request</h1>
        <form action="actions/create_request.php" method="post" enctype="multipart/form-data">
            <label for="title">Book Title:</label>
            <input type="text" id="title" name="title" required>
            <label for="author">Book Author:</label>
            <input type="text" id="author" name="author" required>
            <label for="cover_picture">[Optional] Add Book Cover</label>
            <p>Adding a book cover will help people recognize the book more easily</p>
            <input type="file" id="image" name="image" accept="image/">
            
            <input type="submit" value="Post Request">
        </form>

    </div>
    <?php
    include "includes/footer.php";
    ?>
</body>

</html>