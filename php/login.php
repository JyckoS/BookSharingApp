<!DOCTYPE html>
<!-- Made by Jycko -->
<html>
    <head>
        <title>Login - MMU Book Sharing</title>
        <link rel="stylesheet" href="../css/login.css">
        <script src="../scripts/show_password.js"></script>
    </head>
    <body>
        <!-- Custom header because they havent logged in -->
        <header>

        </header>
        <div class="loginform">
            <img src="../images/mmu_logo.png" alt="logo">
            <br>
            <a>
            <?php
            
            if (isset($_GET["message"])) {
                $msgtype = $_GET["message"];
                $message = $msgtype;
                switch ($msgtype) {
                    case "invalidid":
                        $message = "That username is invalid. Make sure case sensitivity is correct.";
                        break;
                    case "invalidpw":
                        $message = "You have entered a wrong password.";
                        break;
                    case "notloggedin":
                        $message = "You need to log in to do that!";
                        break;
                    case "registered":
                        $message = "Successfully registered. Please login!";
                        break;

                }

                echo "$message";
            }
            ?>
            </a>
            <form action="actions/process_login.php" method="post">
                <label for="username">UserID</label>
                <input type="text" id="userid" name="userid" required>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                <button onclick="showPassword('password');" type="button" id="passwordtoggle">Show</button>
                <input type="submit" value="Login">

            </form>
            <p>Not registered? </p><a class="register" href="registration.php">Click me to register</a>
        </div>
        <!-- Custom footer because they havent logged in -->
        <footer>

        </footer>
</body>
</html>