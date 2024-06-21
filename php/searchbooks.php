<?php

session_start();

require "db_connect.php";
$connection = openConnection();

?>

<!--Made by Batrisyia -->

<!DOCTYPE html>
<html>
    <head>
        <title> MMU's Book Sharing Center </title>
        <link rel = "stylesheet" href = "../css/searchbooks.css"/>
    <head>

    <script>
    </script>
    <body>
        <header>
            <?php include "includes/header.php";?>
        </header>

        <h3> Search Books </h3>
        <div>
            <table>
                <tr>
                    <th> Book ID </th>
                    <th> Title </th>
                    <th> Author </th>
                    <th> Publisher </th>
                    <th> Year Published </th>
                    <th> Genre </th>
                    <th> Book Condition </th>
                    <th> Status </th>
                </tr>
                <?php
                    $sql = "SELECT * FROM books";
                    $result = $connection->query($sql);
                    
                    if(!$result)
                    {
                        die("Invalid query: " . $connection->error);
                    }
                    
                    while($row = $result->fetch_assoc()){
                            echo "<tr>
                                    <td>" .$row["BookID"]. "</td>
                                    <td>" .$row["Title"] ."</td>
                                    <td>" .$row["Author"] . "</td>
                                    <td>" .$row["Publisher"] . "</td>
                                    <td>" .$row["YearPublished"] . "</td>
                                    <td>" .$row["Genre"] . "</td>
                                    <td>" .$row["BookCondition"] . "</td>
                                    <td>" .$row["Status"] . "</td>
                            </tr>";
                        }

                ?>
            </table>


        </div>

        <footer>
            <?php include "includes/footer.php";?>
        </footer>
    </body>
</html>
