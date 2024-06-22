<?php

    session_start();

    require "db_connect.php";
    $connection = openConnection();

    $userid = $_SESSION["userid"];
    
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $bookTitle = $_POST["bookTitle"];
        $author = $_POST["author"];
        $description = $_POST["description"];
        $genre = $_POST["genre"];
        $publisher = $_POST["publisher"];
        $yearPublished = $_POST["yearPublished"];
        $bookCondition = $_POST["bookCondition"];
        $startDate = $_POST["startDate"];
        $endDate = $_POST["endDate"];

        try{
            $query = "INSERT INTO books (Title, Author, Publisher, 
            YearPublished, Genre, BookCondition, Description, Status, StudentID) VALUES 
            ('$title', '$author', '$publisher', '$yearPublished', '$genre', '$bookCondition', '$description', 'AVAILABLE', '$userID')";

        }catch(PDOException $e){
            die("Query failed: " . $e->getMessage());
        }
    }
    else
    {
        header("Location:../index.php");
    }
    

?>
