<?php

$connection = null;
// Made by Jycko
function openConnection() {
    global $connection;
    if ($connection != NULL) return $connection;
    $user = "root";
    $host = "localhost";
    $password = "";
    $dbname = "mydb";
    $connection = mysqli_connect($host, $user, $password, $dbname);
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }
    #echo "MySQL connection successful";
    return $connection;
}

function closeConnection($connection) {
    mysqli_close($connection);
}

function getUserRowData($id) {
    $conn = openConnection();

    $table = "students";
    $columnid = "StudentID";
    if (str_contains($id, "MU")) {
        $table = "manager";
        $columnid = "ManagerID";
    }
    $query = "SELECT * FROM $table WHERE $columnid = '$id'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) <= 0) {
        return "Unknown User";
    }
    $row = mysqli_fetch_assoc($result);
    return $row;
}
function getAllBorrowedBookResult($userid) {
    $conn = openConnection();

    $query = "SELECT * FROM borrow WHERE StudentID = '$userid'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) <= 0) {
        return "unknown";
    }
    return $result;
}
function getAllLoanedBookResult($userid) {
    $conn = openConnection();

    $query = "SELECT * FROM loan WHERE StudentID = '$userid'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) <= 0) {
        return "unknown";
    }
    return $result;
}
function getPostData($id) {
    $conn = openConnection();

    $query = "SELECT * FROM forum_post WHERE PostID = '$id'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) <= 0) {
        return "unknown";
    }
    $row = mysqli_fetch_assoc($result);
    return $row;
    
}
function getImageSrc($row) {
    $image = $row["image_base64"];
    $imageSrc = "../images/dummy_cover.jpg";
    if (!empty($image)) {
        $imageSrc = "data:image/jpeg;base64," . $image;

    }
    return $imageSrc;
}
$connection = openConnection();
?>
