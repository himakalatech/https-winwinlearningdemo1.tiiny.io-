<?php
    session_start();
    include 'header_login.php';
    include 'db.php';


    // Check if the user is logged in
    if (!isset($_SESSION['email'])) {
        echo "<script>alert('You must be logged in to access this page.'); window.location.href='login.php';</script>";
        exit();
    }

    // purchase.php or course.php  
    if (isset($_SESSION['message'])) {
        echo "<div class='alert'>" . $_SESSION['message'] . "</div>";
        unset($_SESSION['message']);
    }

    // Initialize variables
    $loggedInEmail = $_SESSION['email'] ?? null;
    $editData = [];
    $selectedCourses = [];
    // $allCourses = ['1st', '2nd', '3rd', '4th', '5th', '6n7th', '8n9th', '10cbse', '10gseb', 'gujaratisikho', 'phonics', 'srkg', 'jrkg'];
    $allCourses = ['1st', '2nd', '3rd', '4th', '5th', '6n7th', '8n9th', '10thCBSE', '10thGSEB', 'Gujaratisikho', 'Phonics', 'SrKg', 'JrKg'];

    // Fetch record for the logged-in email
    if ($loggedInEmail) {
        $query = "SELECT * FROM subjects WHERE email = ?";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "s", $loggedInEmail);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $editData = mysqli_fetch_assoc($result);
        $selectedCourses = explode(", ", $editData['coursename'] ?? "");
    }
    
    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["coursename"])) {
        // if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
        
        // Collect posted data
        $studentId = $_POST['id'];
        $name = trim($_POST['name']);
        $email = $loggedInEmail; // Use the logged-in user's email
        $password = trim($_POST['password']);
        $contactno = trim($_POST['contactno']);
        $gender = trim($_POST['gender']);
        $sclname = trim($_POST['sclname']);
        $sclcity = trim($_POST['sclcity']);
        $address = trim($_POST['address']);
        $city = trim($_POST['city']);
        $pincode = trim($_POST['pincode']);
        $currentDateTime = date("Y-m-d H:i:s");
        $country = "India";
        $state = "Gujarat";
        $selectedCourses = $_POST['coursename']; // Array of selected courses

        // Process courses
        $selectedCourses = $_POST['coursename'] ?? [];
        $coursename = implode(", ", $selectedCourses); // Combine courses into one string

        // Prepare courses for individual columns
        $courseColumns = array_pad($selectedCourses, 13, null); // Ensure 13 elements, pad with NULL
        list($course1, $course2, $course3, $course4, $course5, $course6, $course7, $course8, $course9, $course10, $course11, $course12, $course13) = $courseColumns;

        // Handle image upload
        $upload_dir = 'uploaded_img/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $image_folder = $editData['image'] ?? '';
        if (isset($_FILES['image']) && $_FILES['image']['name']) {
            $image = $_FILES['image']['name'];
            $image_tmp_name = $_FILES['image']['tmp_name'];
            $image_folder = $upload_dir . $image;
            if (!move_uploaded_file($image_tmp_name, $image_folder)) {
                echo "<script>alert('Image upload failed!');</script>";
            }
        }
        

            // Fetch record for the logged-in email
    if ($loggedInEmail) {
        $query = "SELECT * FROM subjects WHERE email = ?";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "s", $loggedInEmail);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $editData = mysqli_fetch_assoc($result);
        $selectedCourses = explode(", ", $editData['coursename'] ?? "");
    }

    // Fetch the courses that have been paid for by the student
    $query = "SELECT paid_courses FROM students WHERE id = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "i", $studentId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $studentData = mysqli_fetch_assoc($result);
    $paidCourses = explode(',', $studentData['paid_courses']); // Assuming paid courses are stored as a comma-separated list
    
    // Display the courses and check if each one is paid
    echo "<h2>Selected Courses:</h2>";
    foreach ($selectedCourses as $course) {
        if (in_array($course, $paidCourses)) {
            echo "<p><strong>$course</strong> - This Course Already Paid</p>";
        } else {
            echo "<p><strong>$course</strong> - <a href='pay_course.php?course=$course'>Pay Now</a></p>";
        }
    }

        // $course1    = $coursesArray[0] ?? null;
        // $course2    = $coursesArray[1] ?? null;
        // $course3    = $coursesArray[2] ?? null;
        // $course4    = $coursesArray[3] ?? null;
        // $course5    = $coursesArray[4] ?? null;
        // $course6    = $coursesArray[5] ?? null;
        // $course7    = $coursesArray[6] ?? null;
        // $course8    = $coursesArray[7] ?? null;
        // $course9    = $coursesArray[8] ?? null;
        // $course10   = $coursesArray[9] ?? null;
        // $course11   = $coursesArray[10] ?? null;
        // $course12   = $coursesArray[11] ?? null;
        // $course13   = $coursesArray[12] ?? null;

        
        if ($editData) { // Update existing record
        $query = "UPDATE subjects SET name=?, password=?, contactno=?, coursename=?, gender=?, sclname=?, sclcity=?, address=?, 
                city=?, pincode=?, image=?, UpDt=?, 
                coursename=?, course1=?, course2=?, course3=?, course4=?, course5=?, course6=?, 
                  course7=?, course8=?, course9=?, course10=?, course11=?, course12=?, course13=?, UpDt=? 
                  WHERE email=?";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "ssssssssssssssssssssssssss", $name, $password, $contactno, $coursename, $gender, $sclname, $sclcity, $address, $city, $pincode, 
            $image_folder, $currentDateTime,
                $course1, $course2, $course3, $course4, $course5, $course6, $course7, $course8, $course9, $course10, $course11, $course12, $course13, $currentDateTime, $email);
    } else { // Insert new record
        $query = "INSERT INTO subjects (name, email, contactno, coursename, course1, course2, course3, course4, course5, 
                  course6, course7, course8, course9, course10, course11, course12, course13, CrDt) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "ssssssssssssssssssssssssss", $name, $password, $contactno, $coursename, $gender, $sclname, $sclcity, $address, $city, $pincode, 
            $image_folder, $currentDateTime,
            $course1, $course2, $course3, $course4, $course5, $course6, $course7, $course8, $course9, $course10, $course11, $course12, $course13, $currentDateTime);
    }

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Record saved successfully!');</script>";
    } else {
        echo "<script>alert('Error saving record: " . mysqli_stmt_error($stmt) . "');</script>";
    }
    mysqli_stmt_close($stmt);
        
    }

?>

<style>
    /* General table styling */
    #student-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px; /* Set font size */
    }

    /* Styling for table headers */
    #student-table th {
        border: 2px solid #ddd; /* Add border */
        padding: 8px; /* Add padding */
        background-color: #f2f2f2; /* Light background for header */
        text-align: left; /* Align text */
    }

    /* Styling for table rows */
    #student-table td {
        border: 2px solid #ddd; /* Add border */
        padding: 8px; /* Add padding */
        text-align: left; /* Align text */
    }
    
    /* Alternate row color */
    #student-table tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    /* Hover effect for rows */
    #student-table tr:hover {
        background-color: #f1f1f1;
    }

    /* Table border */
    #student-table {
        border: 2px solid #ccc; /* Add outer border */
    }

    #student-table img {
        width: 70px;
        height: 70px;
    }

    /* Add responsive font scaling for smaller devices */
    @media (max-width: 600px) {
        #student-table {
            font-size: 12px; /* Reduce font size on smaller screens */
        }
    }
</style>

<!-- Form -->
<section class="form-container">
    <!-- <form action="" name="myForm" method="post" enctype="multipart/form-data"> -->
    <!-- Form to select courses -->
    <form action="purchasenew.php" name="myForm" method="post" enctype="multipart/form-data">
        <h1 class="heading">Select Courses</h1>
        <input type="hidden" name="id" value="<?php echo $editData['Id'] ?? ''; ?>">
        <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png">
        <input type="text" name="name" placeholder="Enter Your Name" class="box" required value="<?php echo $editData['name'] ?? ''; ?>">
        <input type="email" name="email" placeholder="Enter email" class="box" required value="<?php echo $editData['email'] ?? ''; ?>">
        <input type="password" name="password" placeholder="Enter your password" class="box" required value="<?php echo $editData['password'] ?? ''; ?>">
        <input type="tel" name="contactno" placeholder="Contact Number" class="box" required value="<?php echo $editData['contactno'] ?? ''; ?>">

        <select name="coursename[]" class="box" multiple onchange="updatePaymentAmount()">
            <?php foreach ($allCourses as $course): ?>
                <option value="<?php echo $course; ?>" style="background-color:  <?php echo in_array($course, $selectedCourses) ? '#d3ffd3' : '#ffffff'; ?>;" 
                        <?php echo in_array($course, $selectedCourses) ? 'selected' : ''; ?>>
                    <?php echo $course; ?>
                </option>
            <?php endforeach; ?>
        </select>

        <input type="text" name="payment" id="payment" placeholder="Total Payment" class="box" value="<?php echo $editData['payment'] ?? 0; ?>" readonly>
        <button type="button" class="btn btn-success" style="width:50%" id="payNowButton" onclick="redirectToPayment()">Pay Now</button>

        <input type="submit" name="submit" value="Submit" class="btn">
    </form>
</section>

<!-- Table -->
<section class="teachers">
    <table id="student-table" border="1" style="font-size: 16px; width: 100%; margin-top: 10px;">
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Name</th>
            <th>Courses</th>
            <th>Contact No</th>
            <th>Email</th>
            <th>Payment</th>
            <th>School</th>
            <th>City</th>
            <th>Course</th>
            <th>Actions</th>
        </tr>
        <?php
        if ($loggedInEmail) {
            $id=1;
            // Fetch records where the email matches the logged-in user's email
            $query = "SELECT * FROM subjects WHERE email = ?";
            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, "s", $loggedInEmail);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $id++; ?></td>
                <!-- Display the image -->
                 <td><img src="<?php echo !empty($row['image']) ? '../' . htmlspecialchars($row['image']) : '../uploaded_img/dummy.jpg'; ?>" 
                             alt="Profile" 
                             height="50"></td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                             <!--<td><?php echo htmlspecialchars($row['coursename']); ?></td> -->
                            <td>
                                <?php
                                    $courses = [];
                                    for ($i = 1; $i <= 13; $i++) {
                                        if (!empty($row["course$i"])) {
                                            $courses[] = htmlspecialchars($row["course$i"]);
                                        }
                                    }
                                    echo implode(", ", $courses);
                                ?>
                            </td>
                            <td><?php echo htmlspecialchars($row['contactno']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['payment']); ?></td>
                            <td><?php echo htmlspecialchars($row['sclname']); ?></td>
                            <td><?php echo htmlspecialchars($row['sclcity']); ?></td>
                            <td>
                    <?php
                        // Collect all course fields from course1 to course13
                        $coursename = [];
                        for ($j = 1; $j <= 13; $j++) {
                            $courseField = 'course' . $j;
                            if (!empty($row[$courseField])) {
                                $coursename[] = $row[$courseField]; // Add non-empty coursename to the array
                            }
                        }
                        // Join coursename with a comma separator
                        echo implode(', ', $coursename);
                    ?>
                </td>
                <td>
                    <form method="post">
                    <a href="?edit_id=<?php echo $row['Id']; ?>">Edit</a>
                        <input type="hidden" name="delete_id" value="<?php echo $row['Id']; ?>">
                        <a onclick="return confirm('Are you sure?')">Delete</a>
                    </form>
                </td>

            </tr>
            <?php }
            } else {
                echo '<tr><td colspan="10">No records found for your email.</td></tr>';
            }
        } else {
            echo '<tr><td colspan="10">You are not logged in.</td></tr>';
        }
        ?>
</section>

<script>
    function updatePaymentAmount() {
        const selectedCourses = Array.from(document.querySelector('select[name="coursename[]"]').selectedOptions);
        const coursePrices = {
            "JrKg": 1, "SrKg": 1, "1st": 1, "2nd": 1, "3rd": 1, 
            "4th": 1, "5th": 2, "6n7th": 2, "8n9th": 2, 
            "10thCBSE": 3, "10thGSEB": 3, "Gujaratisikho": 3, "Phonics": 3
        };

        let totalAmount = 0;
        selectedCourses.forEach(option => {
            totalAmount += coursePrices[option.value] || 0;
        });

        document.getElementById('payment').value = totalAmount;
    }

    function redirectToPayment() {
        const selectedCourses = Array.from(document.querySelector('select[name="coursename[]"]').selectedOptions)
                                     .map(option => option.value);
        const email = "<?php echo $editData['email'] ?? ''; ?>";
        const usercontact = "9033109926";
        const studcontact = "<?php echo $editData['contactno'] ?? ''; ?>";
        const payment = document.getElementById('payment').value;

        const url = `payment.php?usercontact=${encodeURIComponent(usercontact)}&email=${encodeURIComponent(email)}&contactno=${encodeURIComponent(studcontact)}&coursename=${encodeURIComponent(selectedCourses.join(','))}&payment=${encodeURIComponent(payment)}`;
        window.location.href = url;
    }
</script>

<?php 
    include('footer_login.php');
?>