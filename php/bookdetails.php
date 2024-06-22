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
    header("Location: searchbooks.php"); // Redirect if bookID parameter is missing
    exit;
}

$bookID = $_GET['bookID'];

?>


<!DOCTYPE html>
<html>
    <head>
        <link rel = "stylesheet" href = "../css/bookdetails.css"/>
    <head>
    <body>
        <header>
        <?php include "includes/header.php" ?>
        </header>

        <h3 style = "margin-left:20px"> Book Details </h3>

        <div class = "bookDetails">
        <?php
            $sql = "SELECT * FROM books WHERE BookID = $bookID";
            $result = mysqli_query($connection, $sql);

            /*
            if (mysqli_num_rows($result) > 0) {
                $book = mysqli_fetch_assoc($result);
            } else {
                header("Location: searchbooks.php");
                exit;
            }
                */

            while ($row = mysqli_fetch_assoc($result)) { ?>
                <div>
                    <p> Book ID: <?php echo $row['BookID']; ?></p>
                    <p style = "font-weight: bold;"><?php echo $row['Title']; ?></p>
                    <p>by <?php echo $row['Author']; ?></p>
                    <p>Published by <?php echo $row['Publisher']; ?></p>
                    <p>Published in the year <?php echo $row['YearPublished']; ?></p>
                    <p>Description: <?php echo $row['Description']; ?></p>
                    <p>Genre: <?php echo $row['Genre']; ?></p>
                    <p>Condition: <?php echo $row['BookCondition']; ?></p>
                    <p><?php echo $row['Status']; ?></p>
                </div>
            <?php } ?>    
        </div>
    </body>
</html>
