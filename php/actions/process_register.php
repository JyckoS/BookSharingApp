<!-- Made by Jycko -->
<?php
require_once "../db_connect.php";

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: ../registration.php?message=error");

    exit;
}

if (!isset($_POST["userID"])
|| !isset($_POST["fullName"])
|| !isset($_POST["email"])
|| !isset($_POST["password"])
|| !isset($_POST["passwordConfirmation"])) {
    header("Location: ../registration.php?message=errorx");
    exit;
}
if ($_POST["password"] !== $_POST["passwordConfirmation"]) {
    header("Location: ../registration.php?message=passwordmismatch");
    exit;
}
session_start();
$conn = openConnection();
$sql = "SELECT StudentID, Email FROM students";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    if ($_POST["email"] == $row["Email"]) {
        header("Location: ../registration.php?message=mailexist");
        exit;
    }
    if ($_POST["userID"] == $row["StudentID"]) {
        header("Location: ../registration.php?message=idexist");
        exit;
    }
}
$studentid = mysqli_real_escape_string($conn, $_POST["userID"]);
$fullname = mysqli_real_escape_string($conn, $_POST["fullName"]);

$email = mysqli_real_escape_string($conn, $_POST["email"]);

$password = mysqli_real_escape_string($conn, $_POST["password"]);


// email and userid are unused, go register to sql
$query = "INSERT INTO students 
(StudentID, Name, Email, Password, UserType)
 VALUES 
 ('$studentid', '$fullname', '$email', '$password', 'STUDENT')
 ";
 $insert = mysqli_query($conn, $query);
 if (!$insert) {
    header("Location: ../registration.php?message=error2");
    exit;
 }

 header("Location: ../login.php?message=registered");
 exit;
?>