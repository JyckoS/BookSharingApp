<!DOCTYPE html>
<html>
    <head>
        <title> MMU's Book Sharing: Loan Books </title>
        <link rel = "stylesheet" href = "../css/loanbooks.css"/>
    </head>
    <?php
        include 'includes/header.php';
    ?>
    <body>
        <h3> Loan Books </h3>

        <p> Please fill in the form, if you're liked to loan books to other students. </p>
        <p> Please note that your book may take some time to get approved by the manager of this website. </p>
        
        <form action = "actions/process_loan.php" method = "post">
            <p> Book Information </p>

            <p><label for = "title"> Book Title </label></p>
            <p><input type = "text" id = "title" name = "title" placeholder = "Title" required/></p>
                
            <p><label for = "author"> Author </label></p>
            <p><input type = "text" id = "author" name = "author" placeholder = "Author" required/></p>

            <p><label for = "genre"> Genre </label></p>
            <p>
                <select id = "genre" name = "genre" required>
                    <option value="">Select Genre</option>
                    <option value="Fiction">Fiction</option>
                    <option value="Non-Fiction">Non-Fiction</option>
                    <option value="Science Fiction">Science Fiction</option>
                    <option value="Fantasy">Fantasy</option>
                    <option value="Biography">Biography</option>
                    <option value="Mystery">Mystery</option>
                    <option value="Romance">Romance</option>
                    <option value="History">History</option>
                    <option value="Other">Others</option>
                </select>
            </p>

            <p><label for = "description"> Book Description (What the book is about) </label></p>
            <p><input type = "text" id = "description" name = "description" placeholder = "Description" required/></p>

            <p><label for = "publisher"> Publisher </label></p>
            <p><input type = "text" id = "publisher" name = "publisher" placeholder = "Publisher" required/></p>

            <p><label for = "yearPublished"> Year Published </label></p>
            <p><input type = "number" id = "yearPublished" name = "yearPublished" placeholder = "Year Published" min="0" step="1" required/></p>

            <fieldset>
                <legend> Book Condition </legend>
                <label for = "excellent"> Excellent </label>
                <input type = "radio" id = "excellent" name = "bookCondition" value="EXCELLENT" required/>

                <label for = "bad"> Bad </label>
                <input type = "radio" id = "bad" name = "bookCondition" value="BAD" required/>

                <label for = "minorDamages"> Minor Damages </label>
                <input type = "radio" id = "minorDamages" name = "bookCondition" value="MINOR_DAMAGES" required/>

                <label for = "missingPages"> Missing Pages </label>
                <input type = "radio" id = "missingPages" name = "bookCondition" value="MISSING_PAGES" required/>
            </fieldset>

            <p> Duration of Loan </p>
            <p>
                <label for = "startDate"> Start of Loan </label>
                <input type = "date" id = "startDate" name = "startDate" required/>

                <label for = "endDate"> End of Loan </label>
                <input type = "date" id = "endDate" name = "endDate" required/>
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
        <?php
            include 'includes/footer.php';
        ?>
    </body>
</html>
