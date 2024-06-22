<?php

session_start();

require "db_connect.php";
$connection = openConnection();



?>

<!DOCTYPE html>
<html>
    <head>
        <title> MMU's Book Sharing Center </title>
        <link rel = "stylesheet" href = "../css/searchbooks.css?v=<?php echo time(); ?>"/>
    <head>

    <script>
    </script>
    <body>
        <header>
            <?php include "includes/header.php";?>
        </header>

        <h3> Search Books </h3>
        <div>
                <div style = 'margin-left:10%; margin-right:10%'>
                <?php
                    $sql = "SELECT * FROM books";
                    $result = $connection->query($sql);
                    

                    if(!$result)
                    {
                        die("Invalid query: " . $connection->error);
                    }

                    while ($row = mysqli_fetch_assoc($result)) { ?>
                    <div class = "books">
                        <p><?php echo $row['BookID']; ?></p>
                        <p style = "font-weight: bold;"><?php echo $row['Title']; ?></p>
                        <p>by <?php echo $row['Author']; ?></p>
                        <p>Published by <?php echo $row['Publisher']; ?></p>
                        <p>Published in the year <?php echo $row['YearPublished']; ?></p>
                        <p>Genre: <?php echo $row['Genre']; ?></p>
                        <p>Condition: <?php echo $row['BookCondition']; ?></p>
                        <p><?php echo $row['Status']; ?></p>
                        <p><a href="bookdetails.php?bookID=<?php echo $row['BookID']; ?>" class="button">View Book
                                Details</a></p>
                    </div>
                <?php } ?>

        

        </div>

        <footer>
            <?php include "includes/footer.php";?>
        </footer>
    </body>
</html>
