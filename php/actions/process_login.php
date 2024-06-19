<?php
// Made By Jycko
require_once "../db_connect.php";
$conn = openConnection();
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    // not post so leave
    header("Location: ../login.php?message=invalidpost");

    exit;
}
session_start();
if (!isset($_POST["userid"]) || !isset($_POST["password"])) {
    header("Location: ../login.php?message=invalidtext");

    exit;
}
$userid = $_POST["userid"];
$password = $_POST["password"];
$userid = mysqli_real_escape_string($conn, $userid);
$password = mysqli_real_escape_string($conn, $password);
$table = "students";
$column = "StudentID";
if (str_contains($userid, "MU")) {
    $table = "manager";
    $column = "ManagerID";
}
$query = "SELECT * FROM $table WHERE $column = '$userid'";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) <= 0) {
    header("Location: ../login.php?message=invalidid");

    // Invalid userid, check case sensitivity
    exit;
}
$row = mysqli_fetch_assoc($result);
if ($password != $row["Password"]) {
    header("Location: ../login.php?message=invalidpw");

    // Invalid password
    exit;
}
// Password and userid is correct, login the user.
$_SESSION["userid"] = $userid;
$_SESSION["username"] = $row["Name"];
$_SESSION["usertype"] = $row["UserType"];
header("Location: ../../index.php");
?>