<?php
session_start();
if (!isset($_SESSION["userid"])) {
    header("Location: login.php");
    exit;
}

require 'db_connect.php';

// Check if LoanID is provided via GET parameter
if (!isset($_GET['loan_id'])) {
    header("Location: manage_loans.php"); // Redirect if loan_id parameter is missing
    exit;
}

$loanID = $_GET['loan_id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Book Details</title>
    <!-- Include your CSS files -->
    <link rel="stylesheet" href="../css/manager_view_book.css">
    <style>
        /* Additional styles specific to the view_book.php page */
        .button-approve {
            background-color: #008CBA;
            /* Blue color for approve button */
        }

        .button-approve:hover {
            background-color: #005E7A;
            /* Darker blue on hover */
        }
    </style>
</head>

<body>
    <?php include "includes/header.php"; ?>

    <?php
    // Fetch book details based on LoanID
    $sql = "SELECT * FROM books WHERE LoanID = $loanID";
    $result = mysqli_query($conn, $sql);

    // Check if the book with the provided LoanID exists
    if (mysqli_num_rows($result) > 0) {
        $book = mysqli_fetch_assoc($result);
    } else {
        // Redirect to manage_loans.php if no book found with the provided LoanID
        header("Location: manage_loans.php");
        exit;
    }

    // Function to convert BookCondition enum to readable format
    function getBookCondition($condition)
    {
        switch ($condition) {
            case 'EXCELLENT':
                return 'Excellent';
            case 'BAD':
                return 'Bad';
            case 'MINOR_DAMAGES':
                return 'Minor Damages';
            case 'MISSING_PAGES':
                return 'Missing Pages';
            default:
                return 'Unknown';
        }
    }

    // Function to update book status from PENDING to AVAILABLE
    function approveBook($conn, $loanID)
    {
        $sql = "UPDATE books SET Status = 'AVAILABLE' WHERE LoanID = $loanID";
        if (mysqli_query($conn, $sql)) {
            return true;
        } else {
            return false;
        }
    }

    // Check if the book status is PENDING to display approve button
    $showApproveButton = false;
    if ($book['Status'] == 'PENDING') {
        $showApproveButton = true;
    }
    ?>

    <div class="content">
        <h2>Book Details</h2>
        <div class="book-details">
            <div>
                <strong>Title:</strong> <?php echo htmlspecialchars($book['Title']); ?><br>
                <strong>Author:</strong> <?php echo htmlspecialchars($book['Author']); ?><br>
                <strong>Publisher:</strong> <?php echo htmlspecialchars($book['Publisher']); ?><br>
                <strong>Year Published:</strong> <?php echo $book['YearPublished']; ?><br>
                <strong>Genre:</strong> <?php echo htmlspecialchars($book['Genre']); ?><br>
                <strong>Book Condition:</strong> <?php echo getBookCondition($book['BookCondition']); ?><br>
                <strong>Description:</strong><br> <?php echo htmlspecialchars($book['Description']); ?><br>
                <strong>Status:</strong>
                <?php echo htmlspecialchars($book['Status']); ?><?php if ($showApproveButton): ?>
                    <form method="post">
                        <input type="hidden" name="loan_id" value="<?php echo $loanID; ?>">
                        <button type="submit" name="approve" class="button button-approve">Approve</button>
                    </form>
                <?php endif; ?><br>
            </div>
            <?php if (!empty($book['image_base64'])): ?>
                <div>
                    <img src="data:image/jpeg;base64,<?php echo $book['image_base64']; ?>" alt="Book Cover"
                        style="max-width: 200px; max-height: 300px;">
                </div>
            <?php endif; ?>


        </div>
        <a href="manage_loan.php" class="button">Back to Loans</a>
    </div>

    <?php include "includes/footer.php"; ?>

    <?php
    // Process form submission to approve book
    if (isset($_POST['approve'])) {
        if (approveBook($conn, $loanID)) {
            // Redirect to the same page to avoid resubmission on refresh
            header("Location: view_book.php?loan_id=$loanID");
            exit;
        } else {
            echo "<script>alert('Failed to approve the book.');</script>";
        }
    }

    closeConnection($conn);
    ?>
</body>

</html>