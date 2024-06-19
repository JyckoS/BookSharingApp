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

$connection = openConnection();
?>
