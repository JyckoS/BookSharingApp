<?php
session_start();
if (!isset($_SESSION["userid"])) {
    header("Location: login.php");
    exit;
}

require 'db_connect.php';
$connection = openConnection();
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../css/footerstyle.css">
    <link rel="stylesheet" href="../css/headerstyle.css">
    <link rel="stylesheet" href="../css/button.css">
    <link rel="stylesheet" href="../css/managetable.css">

    <title>Your Wishlist - Book Sharings App MMU</title>
</head>

<body>
    <?php
    include "includes/header.php";
    ?>

    <?php
    // Get the logged-in user's ID
    $userId = $_SESSION["userid"];

    // Fetch data from wishlist table for the logged-in user
    $sql = "SELECT WishID, StudentID, Books FROM wishlist WHERE StudentID = ?";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, "s", $userId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    ?>

    <div class="content">
        <h2>Your Wishlist</h2>
        <a href="account_profile.php" class="button">Back to Profile</a>
        <div class="table-container">
            <table>
                <tr>
                    <th>WishID</th>
                    <th>StudentID</th>
                    <th>BookID</th>
                    <th>Action</th>
                </tr>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['WishID']; ?></td>
                        <td><?php echo $row['StudentID']; ?></td>
                        <td><?php echo $row['Books']; ?></td>
                        <td>
                            <form action="actions/remove_wishlist.php" method="post" onsubmit="return confirm('Are you sure you want to remove this book from your wishlist?');">
                                <input type="hidden" name="WishID" value="<?php echo $row['WishID']; ?>">
                                <button type="submit" class="button">Remove</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
    <?php
    include "includes/footer.php";
    ?>
</body>

</html>
<?php
closeConnection($connection);
?>
