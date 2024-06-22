<?php


?>

<!DOCTYPE html>
<html>
    <head>
        <title> MMU's Book Sharing: Loan Books </title>
        <link rel = "stylesheet" href = "../css/loanbooks.css"/>
    </head>
    <body>
        <h3> Loan Books </h3>

        <p> Please fill in the form, if you're liked to loan books to other students. </p>
        <p> Please note that your book may take some to get approved by the manager of this website. </p>
        
        <form action = "actions/process_login.php" method = "post">
            <p> Book Information </p>

            <p><label for = "title"> Book Title </label></p>
            <p><input type = "text" id = "title" name = "title" placeholder = "Title"/></p>
                
            <p><label for = "author"> Author </label></p>
            <p><input type = "text" id = "author" name = "author" placeholder = "Author"/></p>

            <p><label for = "genre"> Genre </label></p>
            <p><input type = "text" id = "genre" name = "genre" placeholder = "Genre"/></p>

            <p><label for = "description"> Book Description (What the book is about) </label></p>
            <p><input type = "text" id = "description" name = "description" placeholder = "Description"/></p>

            <p><label for = "publisher"> Publisher </label></p>
            <p><input type = "text" id = "publisher" name = "publisher" placeholder = "Publisher"/></p>

            <p><label for = "yearPublished"> Year Published </label></p>
            <p><input type = "text" id = "yearPublished" name = "yearPublished" placeholder = "Year Published"/></p>

            <fieldset>
            <legend> Book Condition </legend>
                <label for = "excellent"> Excellent </label>
                <input type = "radio" id = "excellent" name = "bookCondition"/>

                <label for = "bad"> Bad </label>
                <input type = "radio" id = "bad" name = "bookCondition"/>

                <label for = "minorDamages"> Minor Damages </label>
                <input type = "radio" id = "minorDamages" name = "bookCondition"/>

                <label for = "missingPages"> Missing Pages </label>
                <input type = "radio" id = "missingPages" name = "bookCondition"/>
            </fieldset>

            <p> Duration of Loan <p>
            <p>
                <label for = "startDate"> Start of Loan </label>
                <input type = "date" id = "startDate" name = "startDate"/>

                <label for = "endDate"> End of Loan </label>
                <input type = "date" id = "endDate" name = "endDate"/>
            </p>

            <div class = "terms"> 
                <h4 style = "bold"> Terms and Conditions </h4>
                <p>By participating in our student-to-student book loaning service, you agree to accurately list book details, 
                    take responsibility for maintaining your book in its original condition, and consent to your book being lent 
                    to other students and the website manager. Disputes should be resolved via our mediation service. Our platform 
                    facilitates loans but does not assume liability for transaction issues. Continued use signifies acceptance of 
                    updated terms.</p>

            </div>

            <input type = "submit" value = "Submit"/>

        </form>

    </body>
</html>
