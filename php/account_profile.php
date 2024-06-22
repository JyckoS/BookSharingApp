<!-- Made by JYCKO -->
<?php
session_start();
if (!isset($_SESSION["userid"])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Account Profile -- Book Sharing MMU</title>
    <link rel="stylesheet" href="../css/profile.css">
    <link rel="stylesheet" href="../css/button.css">
    <style>
        .profile h3 {
            display: flex;
            align-items: center;
        }

        .profile .button {
            margin-left: auto;
            width: 150px; 
            text-align: center; 
        }
    </style>
</head>

<body>
    <?php
    include "includes/header.php";
    ?>

    <div class="profile">
        <h1>Account Profile</h1>

        <?php
        require_once 'db_connect.php';
        $userid = $_SESSION["userid"];
        $userrow = getUserRowData($userid);
        $name = $userrow["Name"];
        $email = $userrow["Email"];
        $type = $userrow["UserType"];
        $imagesrc = getImageSrc($userrow);

        $borrowedbooks = getAllBorrowedBookResult($userid);
        $loanedbooks = getAllLoanedBookResult($userid);
        $wishlistbooks = getAllWishlistResult($userid);

        echo "<img src='$imagesrc' alt='avatar'>";
        echo "<form action='actions/upload_avatar.php' method='post' enctype='multipart/form-data'>
        <input type='hidden' name='userID' value='$userid'>    
        <input type='file' name='image' accept='image/*' required>
            <button class='uploadbutton' type='submit'>Upload New Image</button>
        </form>";
        echo "<h2>Hello [$type] $name</h2>";
        echo "<h3>Email: $email</h3>";
        $amount_borrowed = 0;
        $amount_loaned = 0;
        $amount_wishlist = 0;

        if ($borrowedbooks != "unknown") {
            $amount_borrowed = mysqli_num_rows($borrowedbooks);
        }

        if ($loanedbooks != "unknown") {
            $amount_loaned = mysqli_num_rows($loanedbooks);
        }

        if ($wishlistbooks != "unknown") {
            $amount_wishlist = mysqli_num_rows($wishlistbooks);
        }

        echo "<div style='display: flex; align-items: center;'><h3>Borrowed Books: $amount_borrowed</h3> 
              <a href='inventory.php' class='button' style='margin-right: 10px;'>View Inventory</a></div>";
        echo "<div style='display: flex; align-items: center;'><h3>Loaned Books: $amount_loaned</h3>
              <a href='user_view_loan.php' class='button' style='margin-right: 10px;'>View Loan</a></div>";
        echo "<div style='display: flex; align-items: center;'><h3>Wishlist Books: $amount_wishlist</h3>
              <a href='wishlist.php' class='button' style='margin-right: 10px;'>View Wishlist</a></div>";
        ?>
    </div>

    <?php
    include "includes/footer.php";
    ?>
</body>

</html>