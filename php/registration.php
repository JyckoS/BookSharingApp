
<!DOCTYPE html>
<html>
    <head>
        <title> MMU's Book Sharing Center: Register Now</title>
        <link rel = "stylesheet" type = "text/css" href = "../css/registration.css?v=<?php echo time(); ?>"/>
    </head>
    <body>

        <!--Navigation-->
        
        <?php include 'includes/header.php';?>

        <div class = "formRegister">

            <h2 class = "register"> Registration </h1>
            
            <form action = "db_connect.php" method = "post" novalidate>
                <p><label for = "studentID"> Student ID </label></p>
                <p><input type = "text" id = "userID" name = "userID" placeholder = "Enter Student ID" required/></p>

                <p><label for = "name"> Name </label></p>
                <p><input type = "text" id = "fullName" name = "fullName" placeholder = "Enter Your Name" required/></p>

                <p><label for = "email"> Email </label></p>
                <p><input type = "email" id = "email" name = "email" placeholder = "Enter Email" required/></p>

                <p><label for = "password"> Password </label></p>
                <p><input type = "password" id = "password" name = "password" placeholder = "Enter Password" required/></p>

                <p><label for = "password"> Password </label></p> <!-- come back to this -->
                <p><input type = "password" id = "passwordConfirmation" name = "passwordConfirmation" placeholder = "Enter Password" required/></p>


                <input type = "submit" value = "Submit"/>
            </form>
        <div>
        <footer>
            <?php include "includes/footer.php"; ?>
        </footer>
        
    </body>
    
</html>

/* made by batrisyia */
