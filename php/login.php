<!DOCTYPE html>
<!-- Made by Jycko -->
<html>
    <head>
        <title>Login - MMU Book Sharing</title>
    </head>
    <body>
        <!-- Custom header because they havent logged in -->
        <header>

        </header>
        <div>
            <?php

            if (isset($_GET["message"])) {
                $msgtype = $_GET["message"];
                $message = $msgtype;
                if ($msgtype == "invalidid") {
                    $message = "That username is invalid. Make sure case sensitivity is correct.";
                }
                else if ($msgtype == "invalidpw") {
                    $message = "You have entered a wrong password.";
                } 

                echo "<a> $message </a>";
            }
            ?>
            <form action="actions/process_login.php" method="post">
                <label for="username">UserID</label>
                <input type="text" id="userid" name="userid" required>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                <input type="submit" value="Login">

            </form>
        </div>
        <!-- Custom footer because they havent logged in -->
        <footer>

        </footer>
</body>
</html>