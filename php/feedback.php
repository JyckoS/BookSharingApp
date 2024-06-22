<!-- Made by Jycko -->
<?php


session_start();
if (!isset($_SESSION["userid"])) {
    header("Location: login.php");
}

$userid = $_SESSION["userid"];
?>



<!DOCTYPE html>
<html> 
    <head>
        <title>MMU Book Sharing - Send Feedback</title>
        <link rel="stylesheet" href="../css/feedback.css">
</head>
<body>
<?php 
include "includes/header.php";
?>
<div class="feedbackform">
    <form action="actions/send_feedback.php" method="post">
        <!-- Check if student is logged in or not, if not send to login.php -->
        <label for="message">Write your feedback below</label>
        <textarea id="message" name="message" rows="6" required></textarea>
        <input type="hidden" name="studentid" value="<?php echo "$userid"; ?>"> 
        <input type="submit" value="Send Feedback">
    </form>
    <?php 
    if (isset($_GET["message"]) && $_GET["message"] = "success") {
        echo "<a>Your feedback has been succesfully sent.</a>";
    }
    ?>
</div>

<?php 
include "includes/footer.php";
?>
</body>
</html>