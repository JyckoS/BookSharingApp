<!-- Made by Jycko -->
<?php


session_start();
if (!isset($_SESSION["userid"])) {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../css/aboutus.css">
    <title>MMU Book Sharing - About Us</title>
</head>

<body>
    <?php
    include "includes/header.php";
    ?>
    <!-- TITLE -->
    <div class="aboutus">
        <div class="title">
            <h1>MMU Book Sharing</h1>
            <h4>Exchange and share books</h4>
            
            <hr>
        </div>
        <article>
            <div class="flex">
            <img src="../images/bookicon.jpg" alt="wall">
            <h1>What is MMU Book Sharing?</h1>
</div>
            <p>Founded in 2024, MMUBookSharing.com is the home to the community for MMU Students
                where they are able to share the books they have and borrow books they need.
                We provide many features to ensure the best quality and the highest comfort so
                students are able to share and borrow books with ease.</p>
            <hr>
            <div class="flex">
            <img src="../images/bookicon.jpg" alt="wall">
            <h1>Loaning Books</h1>
</div>
            <p>
                You are able to loan your books, not only just to give them away.
                If you have a book that you want to share but be returned back after a certain
                period of time. You can loan it.
            </p>

            <hr>

            <div class="flex">
            <img src="../images/bookicon.jpg" alt="wall">
            <h1>Requesting Books</h1>
</div>            <p>We understand that sometimes the book you are looking for are not available
                in our inventory. In that case, you are able to request for books from the MMU
                community. You can request books in This forum. [Later change link]
            </p>
            <hr>
            <div class="flex">
            <img src="../images/bookicon.jpg" alt="wall">
            <h1>Meet our team!</h1>
</div>            <p>We are a team of students in Multimedia University, Cyberjaya, Malaysia who volunteered to make the Book Sharing System. </p>
            <p>We have Jycko Sianjaya, Batrisyia, Xim Chew, and Shazly</p>

        </article>
    </div>
    <?php
    include "includes/footer.php";
    ?>
</body>

</html>