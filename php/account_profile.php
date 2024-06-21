<!-- Made by JYCKO -->
<?php

session_start();
if (!isset($_SESSION["userid"])) {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Account Profile -- Book Sharing MMU</title>
    <link rel="stylesheet" href="../css/profile.css">
</head>

<body>
    <?php
    include "includes/header.php";
    ?>

    <div class="profile">
        <h1>Account Profile</h1>

        <?php
        require_once 'db_connect.php';
        $conn = openConnection();
        session_start();
        $userid = $_SESSION["userid"];
        $userrow = getUserRowData($userid);
        $name = $userrow["Name"];
        $email = $userrow["Email"];
        $type = $userrow["UserType"];
        $imagesrc = getImageSrc($userrow);

        $borrowedbooks = getAllBorrowedBookResult($userid);
        $loanedbooks = getAllLoanedBookResult($userid);
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
        if ($borrowedbooks != "unknown") {
            $amount_borrowed = mysqli_num_rows($borrowedbooks);

        }

        if ($loanedbooks != "unknown") {
            $amount_loaned = mysqli_num_rows($loanedbooks);

        }
        echo "<h3>Borrowed Books: $amount_borrowed</h3>"; 
        echo "<h3>Loaned Books: $amount_loaned</h3>"; 

        ?>
    </div>

    <?php
    include "includes/footer.php";
    ?>
</body>

</html>