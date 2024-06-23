<!-- Made by Batrisyia & Chew -->
<?php
session_start();

require "db_connect.php";
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../css/footerstyle.css">
    <link rel="stylesheet" href="../css/headerstyle.css">
    <link rel="stylesheet" href="../css/button.css">
    <link rel="stylesheet" href="../css/managetable.css">
    <link rel="stylesheet" href="../css/manager_view_book.css">
    <title>Book Details - Book Sharings App MMU</title>
</head>

<body>
    <header>
        <?php include "includes/header.php"; ?>
    </header>

    <div class="content">
        <h2>Book Details</h2>
        <div class="book-details">
            <?php
            if (!isset($_SESSION["userid"])) {
                header("Location: login.php");
                exit;
            }

            if (!isset($_GET['bookID'])) {
                header("Location: searchbooks.php"); // Redirect if bookID parameter is missing
                exit;
            }

            $bookID = $_GET['bookID'];
            $userID = $_SESSION["userid"]; // Get the logged-in user's ID
            
            $sql = "SELECT * FROM books WHERE BookID = $bookID";
            $result = mysqli_query($conn, $sql);

            // Check if the book with the provided BookID exists
            if (mysqli_num_rows($result) > 0) {
                $book = mysqli_fetch_assoc($result);
            } else {
                // Redirect to searchbooks.php if no book found with the provided BookID
                header("Location: searchbooks.php");
                exit;
            }

            // Function to convert BookCondition enum to readable format
            function getBookCondition($condition)
            {
                switch ($condition) {
                    case 'EXCELLENT':
                        return 'Excellent';
                    case 'BAD':
                        return 'Bad';
                    case 'MINOR_DAMAGES':
                        return 'Minor Damages';
                    case 'MISSING_PAGES':
                        return 'Missing Pages';
                    default:
                        return 'Unknown';
                }
            }

            // Function to handle adding the book to the wishlist
            if (isset($_POST['wishlist'])) {
                $insertWishlistSQL = "INSERT INTO wishlist (StudentID, Books) VALUES ('$userID', '$bookID')";
                mysqli_query($conn, $insertWishlistSQL);
                echo "<script>alert('Book added to wishlist!'); window.location.href='bookdetails.php?bookID=$bookID';</script>";
            }

            ?>

            <div>
                <img class='cover' src='<?php echo getImageSrc($book); ?>' alt='img'>
                <strong>Title:</strong> <?php echo htmlspecialchars($book['Title']); ?><br>
                <strong>Author:</strong> <?php echo htmlspecialchars($book['Author']); ?><br>
                <strong>Publisher:</strong> <?php echo htmlspecialchars($book['Publisher']); ?><br>
                <strong>Year Published:</strong> <?php echo $book['YearPublished']; ?><br>
                <strong>Genre:</strong> <?php echo htmlspecialchars($book['Genre']); ?><br>
                <strong>Book Condition:</strong> <?php echo getBookCondition($book['BookCondition']); ?><br>
                <strong>Description:</strong><br> <?php echo htmlspecialchars($book['Description']); ?><br>
                <strong>Status:</strong> <?php echo htmlspecialchars($book['Status']); ?><br>

                <!-- Borrow and Add to Wishlist Buttons -->
                <form id="borrowForm" action="borrowform.php" method="get" style="margin-top: 10px;">
                    <input type="hidden" name="bookID" value="<?php echo $bookID; ?>">
                    <?php if ($book['Status'] == 'AVAILABLE') { ?>
                        <button type="submit" class="button">Borrow</button>
                    <?php } ?>
                </form>
                <form method="post" style="margin-top: 10px;">
                    <button type="submit" name="wishlist" class="button">Add to Wishlist</button>
                </form>
            </div>
            <?php if (!empty($book['image_base64'])): ?>
                <div>
                    <img src="data:image/jpeg;base64,<?php echo $book['image_base64']; ?>" alt="Book Cover"
                        style="max-width: 200px; max-height: 300px;">
                </div>
            <?php endif; ?>
        </div>
        <a href="searchbooks.php" class="button">Back to Search</a>
    </div>

    <?php include "includes/footer.php"; ?>

</body>

</html>

<?php
closeConnection($conn);
?>