<?php
    require_once 'php/db_connect.php';
    $conn = openConnection();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>FAQ - MMU Book Sharing App</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <div>
            <h3>Header & Navigation Bar</h3>
            <hr>
        </div>
        <div>
            <h1>Frequently Asked Question</h1>
        </div>
        <div>
            <?php
                $sql = 'SELECT * FROM faq';
                
                if ($result = mysqli_query($conn, $sql))
                {
                    $questionNum = 1;
                    while ($row = mysqli_fetch_assoc($result))
                    {
                        $question = $row['Content'];
                        $answer = $row['Answer'];

                        echo '<h2>Question #'.$questionNum.'</h2>';
                        echo '<strong>'.$question.'</strong>';
                        echo '<p>'.$answer.'</p>';
                    }
                }
                else
                {
                    echo "Error: ". mysqli_error($conn);
                }
                closeConnection($conn);
            ?>
        </div>
        <div>
            <hr>
            <h4>Footer</h4>
        </div>
    </body>
</html>