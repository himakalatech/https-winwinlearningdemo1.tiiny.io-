<?php
   session_start(); // Ensure session is started for session variables
   include ('header.php'); 
   include ('db.php'); 
   //ob_start();

   // Check if there's a success message to display
   if (isset($_SESSION['message'])) {
      echo "<div class='alert-success'>" . $_SESSION['message'] . "</div>";
      unset($_SESSION['message']); // Clear the message after displaying it
   }


//    if (mysqli_connect_errno()) {
//       die("Database connection failed: " . mysqli_connect_error());
//   }

   //var_dump($_POST); // Check if form data is being posted

   // Query to fetch data from the `contact` table
   $query = "SELECT `Id`, `name`, `email`, `contactno`, `image`, `title1`, `custcontno`, `title2`, `custemaiid`, `CrDt`, `UpDt`, `subject`, `message`, `title3`, `costadd`, `title` FROM `contact` WHERE `title1` <> '' AND `custcontno` <> '' AND `title2` <> '' AND `custemaiid` <> '' AND `title3` <> '' AND `costadd` <> '' AND `title` <> '' LIMIT 1";

   $result = mysqli_query($con, $query);

   if ($result && mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      $title = $row['title'] ?? "Title not available";
      $title1 = $row['title1'] ?? "Title 1 not available";
      $title2 = $row['title2'] ?? "Title 2 not available";
      $title3 = $row['title3'] ?? "Title 3 not available";
      $custcontno = $row['custcontno'] ?? "Contact number not available";
      $custemaiid = $row['custemaiid'] ?? "Email not available";
      $costadd = $row['costadd'] ?? "Address not available";
   } else {
      // Set default fallback values if query result is empty
      $title = "Title not available";
      $title1 = "Title 1 not available";
      $title2 = "Title 2 not available";
      $title3 = "Title 3 not available";
      $custcontno = "Contact number not available";
      $custemaiid = "Email not available";
      $costadd = "Address not available";
   }


// Form submission
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Receiving form inputs
    $name = $_POST['name'];
    $email = $_POST['email']; 
    $contactnumber = $_POST['contactno'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Validate inputs
    if (!empty($name) && !empty($email) && !empty($contactnumber) && strlen($contactnumber) == 10 && !empty($message)) {
        
        // Check if contact number exists in the database
        $checkQuery = "SELECT id FROM contact WHERE contactno = ?";
        $checkStmt = mysqli_prepare($con, $checkQuery);
        mysqli_stmt_bind_param($checkStmt, "s", $contactnumber);
        mysqli_stmt_execute($checkStmt);
        mysqli_stmt_store_result($checkStmt);

        if (mysqli_stmt_num_rows($checkStmt) > 0) {
            // Update record if contact number exists
            $updateQuery = "UPDATE contact SET name = ?, email = ?, subject = ?, message = ?, contactno = ?, UpDt = NOW() WHERE contactno = ?";
            $updateStmt = mysqli_prepare($con, $updateQuery);
            mysqli_stmt_bind_param($updateStmt, "sssss", $name, $email, $subject, $message, $contactnumber);
            $result = mysqli_stmt_execute($updateStmt);
            mysqli_stmt_close($updateStmt);
        } else {
            // Insert new record if contact number does not exist
            $insertQuery = "INSERT INTO contact (name, email, contactno, subject, message, CrDt) VALUES (?, ?, ?, ?, ?, NOW())";
            $insertStmt = mysqli_prepare($con, $insertQuery);
            mysqli_stmt_bind_param($insertStmt, "sssss", $name, $email, $contactnumber, $subject, $message);
            $result = mysqli_stmt_execute($insertStmt);
            mysqli_stmt_close($insertStmt);
        }

        if ($result) {
            $_SESSION['message'] = 'Successfully Contacted';
            echo "<script>alert('Successfully Contacted');</script>";
        } else {
            $_SESSION['message'] = 'Failed to Contact. Please try again.';
            echo "<script>alert('Failed to Contact. Please try again.');</script>";
        }

        mysqli_stmt_close($checkStmt);
    } else {
        echo "<script>alert('Please enter valid information in all fields');</script>";
    }

    mysqli_close($con);
}
    
?>

</head>

<body>

<style>
   /* Contact Box Styles */
   .box-container {
      margin-top: 20px;
   }

   .box {
      background-color: #f9f9f9;
      border-radius: 8px;
      padding: 20px;
      text-align: center;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
   }

   .box i {
      font-size: 2rem;
      color: #007bff;
      margin-bottom: 10px;
   }

   .box h3 {
      font-size: 1.2rem;
      color: #333;
      margin-bottom: 10px;
   }

   .box p, .box a {
      font-size: 1rem;
      color: #555;
   }

   .box a {
      text-decoration: none;
   }

   .box a:hover {
      color: #007bff;
   }

</style>

<section class="contact">
    <title>Contact Us</title>
    <div class="container mt-4" id="Contact">
        <!-- Contact Us Title -->
        <div class="wrapper slide-custom">
            <h1 class="slide-custom">
                <span><?php echo htmlspecialchars($title); ?></span>
            </h1>
        </div>
        <hr>
        <div class="row">
            <!-- Contact Form Section -->
            <div class="col-md-8">
               <form action="" target="_blank" method="post">
            <!-- <form action="inquiry.php" target="_blank" method="post"> -->
                    <input type="text" class="form-control" name="name" placeholder="Name" required><br>
                    <input type="email" class="form-control" name="email" placeholder="E-mail" required><br>
                    <input type="number" class="form-control" name="contactno" placeholder="Enter your number" required maxlength="10"><br>
                    <input type="text" class="form-control" name="subject" placeholder="Subject" required><br>
                    <textarea class="form-control" name="message" placeholder="How can we help you?" style="height: 15rem;"></textarea><br>
                    <input class="btn btn-success text-white font-weight-bolder" type="submit" value="Send" name="submit"><br><br>
                </form>
            </div>

            <!-- Contact Info Section -->
            <div class="col-md-4">
                <div class="box-container">
                    <div class="box">
                        <!-- <i class="fas fa-envelope"></i> -->
                        <div>
                              <img src="./images/logos/istockphoto-826567080-612x612.jpg" style="width: 50px;margin-bottom: 10px;" alt="email icon">
                        </div>
                        <h2><?php echo htmlspecialchars($title2); ?></h2>
                        <a href="mailto:<?php echo htmlspecialchars($custemaiid); ?>" style="color:blue;"><?php echo htmlspecialchars($custemaiid); ?></a>
                    </div>
                </div>
                <!-- You can add more boxes for additional contact info if needed -->
            </div>
        </div>
    </div>

    <!-- Additional Contact Info Boxes if needed -->
    <!-- <div class="container mt-4">
        <div class="row">
            <!-- Box 1: Phone Number --
            <div class="col-md-4">
                <div class="box-container">
                    <div class="box">
                        <i class="fas fa-phone"></i>
                        <h3>?php echo htmlspecialchars($title1); ?></h3>
                        <p>?php echo htmlspecialchars($custcontno); ?></p>
                    </div>
                </div>
            </div>

            <!-- Box 2: Address --
            <div class="col-md-4">
                <div class="box-container">
                    <div class="box">
                        <i class="fas fa-map-marker-alt"></i>
                        <h3>?php echo htmlspecialchars($title3); ?></h3>
                        <p>?php echo htmlspecialchars($costadd); ?></p>
                    </div>
                </div>
            </div>

            <!-- Box 3: Email --
            <div class="col-md-4">
                <div class="box-container">
                    <div class="box">
                        <i class="fas fa-envelope"></i>
                        <h3>Support</h3>
                        <a href="mailto:?php echo htmlspecialchars($custemaiid); ?>">?php echo htmlspecialchars($custemaiid); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
</section>


<?php 

include ('footer.php'); // Corrected the include statement
//ob_end_flush();
?>
