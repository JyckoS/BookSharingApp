<?php

// Made by Batrisyia
session_start();

require "db_connect.php";
$connection = openConnection();

if (!isset($_SESSION["userid"])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['bookID'])) {
    header("Location: bookdetails.php"); // Redirect if bookID parameter is missing
    exit;
}

$bookID = $_GET['bookID'];

?>

<!DOCTYPE html>
<html>
    <head>
        <title>MMU's Book Sharing Center: Review Books</title>
        <link rel = "stylesheet" href = "../css/reviewbooks.css"/>
    </head>
    <body>
        <header>
            <?php include "includes/header.php"?>
            
        </header>
        <script> 
            date = new Date();
            year = date.getFullYear();
            month = date.getMonth() + 1;
            day = date.getDate();
            document.getElementById("currentDate").innerHTML = date + '/' + month;
        </script>

        <?php
            $sql = "SELECT * FROM books WHERE BookID = $bookID";
            $result = mysqli_query($connection, $sql);

            while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class = "theBooks">
                    <p> Book ID: <?php echo $row['BookID']; ?></p>
                    <p><b><?php echo $row['Title']; ?></b> by <?php echo $row['Author']; ?></p>
                    <p><b>Genre:</b><?php echo $row['Genre']; ?></p>
                    <p><b>Condition:</b><?php echo $row['BookCondition']; ?></p>
                    <p>Published by <i><?php echo $row['Publisher']; ?></i> in <?php echo $row['YearPublished']; ?> </p>
                    <p><b>Book Description:</b> <?php echo $row['Description']; ?></p>

                    
                </div>
            <?php } ?>    
        
        <form action = "actions/process_review.php" method = "post">
            <p><label for = "commentReview"> Your Book Review: </label><p>
            <input type="hidden" id ="bookID" name="bookID" value="<?php 
            $bookID = $_GET["bookID"];
            echo"$bookID";?>"> 
            
            <p><textarea id = "commentReview" name = "commentReview" rows ="10" cols = "100" placeholder="Type in your review here"></textarea></p>
            <p><input type = "submit" value = "Submit"/></p>
        </form>

    </body>

</html>
