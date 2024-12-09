<?php
    session_start();
    include('includes/header.php');
    include('includes/db.php');

    // Check if the user is logged in
    if (!isset($_SESSION['email'])) {
        echo "<script>alert('You must be logged in to access this page.'); window.location.href='login.php';</script>";
        exit();
    }

    // Check if there's a success message to display
    if (isset($_SESSION['message'])) {
        echo "<div class='alert-success'>" . $_SESSION['message'] . "</div>";
        unset($_SESSION['message']); // Clear the message after displaying it
    }

    $coursename = $_GET['coursename'] ?? '';
    $email = $_GET['email'] ?? '';
    $studcontact = $_GET['contactno'] ?? '';
    $usercontact = $_GET['usercontact'] ?? '';
    $paymentAmount = $_GET['payment'] ?? '';


    // echo $usercontact;
    // echo "=====================";
    // echo $email;
    // echo "=====================";
    // echo $studcontact;
    // echo "=====================";
    // echo $coursename; 
    // echo "=====================";
    // echo $paymentAmount;


    if (empty($coursename) || empty($email) || empty($studcontact) || empty($usercontact) || empty($paymentAmount)) {
        die("Error: Required fields are missing.");
    }

    // UPI Payment Data
    $upiID = "bh237215-1@okicici";
    $payeeName = "Mrs Bhavikaben";
    $transactionID = uniqid("TXN");
    $orderID = uniqid("ORDER");
    $currency = "INR";
    // $upiLink = "upi://pay?pa=$upiID&pn=$payeeName&am=$paymentAmount&cu=$currency&tid=$transactionID&tr=$orderID";
    $upiLink = "upi://pay?pa=" . urlencode($upiID) .
            "&pn=" . urlencode($payeeName) .
            "&am=" . urlencode($paymentAmount) .
            "&cu=" . urlencode($currency) .
            "&tid=" . urlencode($transactionID) .
            "&tr=" . urlencode($orderID);

    // QR Code URL
    $qrCodeUrl = "https://api.qrserver.com/v1/create-qr-code/?data=" . urlencode($upiLink) . "&size=200x200";

    // Handle Payment Completion
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get POST data
        echo "Enter Success condition";
        
        $paymentStatus = $_POST['payment_status'] ?? 'failed';
        $studcontact = $_POST['studcontact'] ?? '';
        $email = $_POST['email'] ?? '';
        $coursename = $_POST['coursename'] ?? '';
        $paymentAmount = $_POST['paymentAmount'] ?? '';

        if ($paymentStatus === 'success') {
            // Check if payment record exists
            $query = "SELECT * FROM payments WHERE studcontact = ?";
            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, "s", $studcontact);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            $existingCourses = [];
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                // Get the existing coursename and split into an array
                $existingCourses = explode(',', $row['coursename']);
            }

            // Merge existing courses with the new ones
            $newCourses = explode(',', $coursename);
            $mergedCourses = array_unique(array_merge($existingCourses, $newCourses));
    
            // Implode the merged courses back into a string
            $finalCourses = implode(',', $mergedCourses);

            

            if (mysqli_num_rows($result) > 0) {
                // Update existing record
                $updateQuery = "UPDATE payments SET coursename = ?, payment_amount = ?, email = ?, payment_status = 'completed', updated_at = NOW() WHERE studcontact = ?";
                $updateStmt = mysqli_prepare($con, $updateQuery);
                mysqli_stmt_bind_param($updateStmt, "ssss", $finalCourses, $paymentAmount, $email, $studcontact);
                mysqli_stmt_execute($updateStmt);
                echo "<script>alert('Payment Courses Update successfully!');</script>";
            } else {
                // Insert new payment record
                $insertQuery = "INSERT INTO payments (studcontact, email, coursename, payment_amount, payment_status, created_at) VALUES (?, ?, ?, ?, 'completed', NOW())";
                $insertStmt = mysqli_prepare($con, $insertQuery);
                mysqli_stmt_bind_param($insertStmt, "ssss", $studcontact, $email, $finalCourses, $paymentAmount);
                mysqli_stmt_execute($insertStmt);
                echo "<script>alert('Payment Courses successfully Insert!');</script>";
            }

            // Update the subject table
            $subjectUpdateQuery = "UPDATE subjects SET coursename = ? WHERE contactno = ?";
            $subjectUpdateStmt = mysqli_prepare($con, $subjectUpdateQuery);
            mysqli_stmt_bind_param($subjectUpdateStmt, "ss", $coursename, $studcontact);
            mysqli_stmt_execute($subjectUpdateStmt);

            // Response for JavaScript
            echo json_encode(['status' => 'success', 'message' => "Payment successful for $coursename!"]); 
        } else {
            // Payment failed
            echo json_encode(['status' => 'error', 'message' => "Payment failed! Please try again."]);
        }
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Payment</title>
</head>
<body>
    <div class="container">
        <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <h1>Payment for Course: <?php echo htmlspecialchars($coursename); ?></h1>
            <h2>Total Amount: ₹<?php echo htmlspecialchars($paymentAmount); ?></h2>

            <!-- Display QR Code -->
            <div>
                <img src="<?php echo $qrCodeUrl; ?>" alt="UPI QR Code" style="max-width: 300px;">
            </div>

            <p>Scan the QR code or <a href="<?php echo $upiLink; ?>">click here to pay</a>.</p>

            <!-- Payment Completion Form -->
            <form id="paymentForm">
                <input type="hidden" name="payment_status" value="success"> <!-- Simulated payment status -->
                <input type="hidden" name="studcontact" value="<?php echo htmlspecialchars($studcontact); ?>">
                <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
                <input type="hidden" name="coursename" value="<?php echo htmlspecialchars($coursename); ?>">
                <input type="hidden" name="paymentAmount" value="<?php echo htmlspecialchars($paymentAmount); ?>">

                <button type="button" id="completePayment" style="padding: 10px 20px; font-size: 16px; background-color: #4CAF50; color: white; border: none; border-radius: 5px; cursor: pointer;">Complete Payment</button>
            </form>
        </div>
        <div class="col-md-2"></div>
    </div>

    <!-- Display Success or Error Messages -->
    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-success">
            <?php echo $_SESSION['message']; unset($_SESSION['message']); ?>
        </div>
    <?php elseif (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger">
            <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>

    <script>
       document.getElementById('completePayment').addEventListener('click', function () {
            const form = document.getElementById('paymentForm');
            const formData = new FormData(form);

            // Fetch API to handle form data
            fetch('payment.php', {
                method: 'POST',
                body: formData,
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        alert(data.message);
                        window.location.href = "purchasenew.php"; // Redirect on success
                    } else {
                        alert("Payment failed: " + data.message); // Display specific error
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An unexpected error occurred. Please try again.');
                });
        });

    </script>

<!-- New Change amathi script code add -->
<script>
    function redirectToPayment() {
        const paymentAmount = document.getElementById('payment').value;
        if (paymentAmount && paymentAmount > 0) {
            window.location.href = "payment.php";
        } else {
            alert("Please select courses to calculate the payment.");
        }
    }

<script>
</body>
</html>