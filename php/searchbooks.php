<?php

session_start();

require "db_connect.php";
$connection = openConnection();

?>

<!--Made by Batrisyia And Jycko -->

<!DOCTYPE html>
<html>
    <head>
        <title> MMU's Book Sharing Center </title>
        <link rel="stylesheet" href="../css/search_books.css">
    </head> 

    <body>
        
        <?php include "includes/header.php"; ?>
        <h3 class="center">Search Books</h3>

        <div class="searchcontainer">
        <form method="GET" action="" class="search">
            <div class="filter">
                <label for="genre">Genre:</label>
                <select name="genre" id="genre">
                    <option value="">All</option>
                    <option value="Fiction">Fiction</option>
                    <option value="Non-Fiction">Non-Fiction</option>
                    <option value="Science Fiction">Science Fiction</option>
                    <option value="Fantasy">Fantasy</option>
                    <option value="Biography">Biography</option>
                    <option value="Mystery">Mystery</option>
                    <option value="Romance">Romance</option>
                    <option value="History">History</option>
                    <option value="Other">Others</option>
                </select>
            </div>
            <div class="filter">
                <label for="sort_year">Sort by Year:</label>
                <select name="sort_year" id="sort_year">
                    <option value="newest">Newest to Oldest</option>
                    <option value="oldest">Oldest to Newest</option>
                </select>
            </div>
            <div class="filter">
                <label for="search">Search:</label>
                <input type="text" name="search" id="search" placeholder="The book Author, or Title, or Publisher"/>
            </div>
            <button type="submit" class="button">Apply</button>
        </form>
        <div>
            <table class="book">
                <tr>
                    <th>Book Cover</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Publisher</th>
                    <th>Year Published</th>
                    <th>Genre</th>
                    <th>Book Condition</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                <?php

                    $sql = "SELECT * FROM books WHERE 1=1";
                    
                    if (!empty($_GET['genre'])) {
                        $genre = mysqli_real_escape_string($connection, $_GET['genre']);
                        $sql .= " AND Genre = '$genre'";
                    }

                    if (!empty($_GET['search'])) {
                        $search = mysqli_real_escape_string($connection, $_GET['search']);
                        $sql .= " AND 
                        (Author LIKE '%$search%' 
                        OR 
                        Title LIKE '%$search%' 
                        OR 
                        Publisher LIKE '%$search%')";
                    }

                    if (!empty($_GET['sort_year'])) {
                        if ($_GET['sort_year'] == 'newest') {
                            $sql .= " ORDER BY YearPublished DESC";
                        } elseif ($_GET['sort_year'] == 'oldest') {
                            $sql .= " ORDER BY YearPublished ASC";
                        }
                    }
                    $result = $connection->query($sql);

                    if (!$result) {
                        die("Invalid query: " . $connection->error);
                    }
                    
                    while ($row = $result->fetch_assoc()) {
                        $imgSrc = getImageSrc($row);
                        $bookID = $row["BookID"];
                        echo "<tr>
                                <td>" . "<img src='$imgSrc' alt='cover'>" . "</td>
                                <td>" . $row["Title"] . "</td>
                                <td>" . $row["Author"] . "</td>
                                <td>" . $row["Publisher"] . "</td>
                                <td>" . $row["YearPublished"] . "</td>
                                <td>" . $row["Genre"] . "</td>
                                <td>" . $row["BookCondition"] . "</td>
                                <td>" . $row["Status"] . "</td>
                                <td>" . "<a href='bookdetails.php?bookID=$bookID'class='button'>View</a></p>"  . "</td>" .
                                
                            "</tr>";
                    
                    }
                ?>
            </table>
        </div>
                </div>
        <?php include "includes/footer.php"; ?>
    </body>
</html>
