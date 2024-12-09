<?php
    session_start();
    include('header_login.php');
    include('includes/db.php');

    //$_SESSION['email'] = $userEmailFromLogin;

    // Check if the user is logged in
    if (!isset($_SESSION['email'])) {
        echo "<script>alert('You must be logged in to access this page.'); window.location.href='login.php';</script>";
        exit();
    }

    $loggedInEmail = isset($_SESSION['email']) ? $_SESSION['email'] : null;

    if (!isset($_SESSION['email']) || !isset($_SESSION['contactno'])) {
        echo "<script>alert('Session error. Please log in again.'); window.location.href='login.php';</script>";
        exit();
    }

    $email = $_SESSION['email'];
    $contact_no = $_SESSION['contactno'];
    $purchased_courses = [];

   // Handle form submission for updating courses
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id']; // Get the record ID
    $updatedCourses = [];
    for ($i = 1; $i <= 13; $i++) {
        $courseField = 'course' . $i;
        $updatedCourses[$courseField] = $_POST[$courseField] ?? ''; // Get course values
    }

    // Prepare the UPDATE query dynamically
    $updateFields = [];
    foreach ($updatedCourses as $key => $value) {
        $updateFields[] = "$key = '" . mysqli_real_escape_string($con, trim($value)) . "'";
    }
    $updateQuery = "UPDATE subjects SET " . implode(', ', $updateFields) . " WHERE id = $id AND email = '$email'";
    
    if (mysqli_query($con, $updateQuery)) {
        echo "<script>alert('Courses updated successfully!');</script>";
    } else {
        echo "<script>alert('Error updating courses: " . mysqli_error($con) . "');</script>";
    }
}

// Fetch data for the logged-in user
$query = "SELECT * FROM subjects WHERE email = '$email'";
$result = mysqli_query($con, $query);
    
$columns = [];
$data = [];


// Process data to determine which columns have data
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row; // Save row for later rendering
        for ($i = 1; $i <= 13; $i++) {
            $courseField = 'course' . $i;
            if (!empty($row[$courseField]) && !in_array($courseField, $columns)) {
                $columns[] = $courseField; // Track columns with data
            }
        }
    }
} else {
    echo "<p>No records found.</p>";
    exit();
}

    // // Fetch purchased courses from the database
    // $query = "SELECT DISTINCT coursename FROM subjects WHERE email = ? AND contactno = ? AND payment > 0"; // Payment > 0 means paid

    // $stmt = mysqli_prepare($con, $query);
    // mysqli_stmt_bind_param($stmt, "ss", $email, $contact_no);

    // mysqli_stmt_execute($stmt);
    // $result = mysqli_stmt_get_result($stmt);

    // // Store purchased course names in an array
    // while ($row = mysqli_fetch_assoc($result)) {
    //     $purchased_courses[] = $row['coursename'];
    // }
    // mysqli_stmt_close($stmt);

    // List of all available courses
    $all_courses = [

        ["name" => "SrKg", "demoUrl" => "./demo/srkg.php", "videoUrl" => "./class/srkg.php"],
        ["name" => "JrKg", "demoUrl" => "./demo/jrkg.php", "videoUrl" => "./class/jrkg.php"],
        ["name" => "1st", "demoUrl" => "./demo/1.php", "videoUrl" => "./class/1.php"],
        ["name" => "2nd", "demoUrl" => "./demo/2.php", "videoUrl" => "./class/2.php"],
        ["name" => "3rd", "demoUrl" => "./demo/3.php", "videoUrl" => "./class/3.php"],
        ["name" => "4th", "demoUrl" => "./demo/4.php", "videoUrl" => "./class/4.php"],
        ["name" => "5th", "demoUrl" => "./demo/5.php", "videoUrl" => "./class/5.php"],
        ["name" => "7th", "demoUrl" => "./demo/6n7.php", "videoUrl" => "./class/7.php"],
        ["name" => "9th", "demoUrl" => "./demo/8n9.php", "videoUrl" => "./class/9.php"],
        ["name" => "10thCBSE", "demoUrl" => "./demo/10cbse.php", "videoUrl" => "./class/10cbse.php"],
        ["name" => "10thGSEB", "demoUrl" => "./demo/10gseb.php", "videoUrl" => "./class/10gseb.php"],
        ["name" => "Phonics", "demoUrl" => "./demo/phonics.php", "videoUrl" => "./class/phonics.php"],
        ["name" => "Gujaratisikho", "demoUrl" => "./demo/gujaratisikho.php", "videoUrl" => "./class/gujaratisikho.php"]
    ];

?>

<style>
        h1 {
            margin: 0;
            padding: 0;
            position: absolute;
            top: auto;
            left:auto;
            font-size: 5em;
            color: #ccc;
            width:50%;
        }

        h1::before {
            /* This will create the layer
               over original text*/
            content: attr(data-text);
            position: absolute;
            top: 0;
            left: 0;

            /* Setting different color than
               that of original text  */
            color: green;
            overflow: hidden;

            /* Setting width as 0*/
            width: 0%;
            transition: 1s;
        }

        h1:hover::before {

            /* Setting width to 100 on hover*/
            width: 100%;
        }

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
            text-align: center; /* Align text */
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
            width: 100px;
            height: 100px;
        }

        /* Add responsive font scaling for smaller devices */
        @media (max-width: 600px) {
            #student-table {
                font-size: 12px; /* Reduce font size on smaller screens */
            }
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 16px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        table th {
            background-color: #f4f4f4;
        }
        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    
</style>
    
<section class="courses">
    <h1 class="heading" data-text="Available Courses">Available Courses</h1><br><br><br>
    <div class="box-container" id="courseContainer"></div>

    <br>
    
    <!-- Table -->
    <table id="student-table">
    <thead>
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
            <?php foreach ($columns as $column) { ?>
                        <th><?= ucfirst($column) ?></th>
                    <?php } ?>
                    <th>Action</th>
            
        </tr>
            </thead>
        <!-- ?php
        if (!$loggedInEmail) {
            echo "<p>Please log in to view the data.</p>";
            exit; // Stop further execution if no user is logged in
        }

        $email = $_SESSION['email'];

        // Fetch all courses from the subjects table
    $query = "SELECT *,id, course1, course2, course3, course4, course5, course6, course7, course8, course9, course10, course11, course12, course13 FROM subjects WHERE email = '$email'";
    $result = mysqli_query($con, $query);
?> -->
    <tbody>
                <?php 
                $i=1;
                foreach ($data as $row) { ?>
                    <form method="POST">
                        <tr>
                            <td><?= htmlspecialchars($i++) ?></td>
                            <td><?= htmlspecialchars($row['image']) ?></td>
                            <td><?= htmlspecialchars($row['name']) ?></td>
                            <td><?= htmlspecialchars($row['coursename']) ?></td>
                            <td><?= htmlspecialchars($row['contactno']) ?></td>
                            <td><?= htmlspecialchars($row['email']) ?></td>
                            <td><?= htmlspecialchars($row['payment']) ?></td>
                            <td><?= htmlspecialchars($row['sclname']) ?></td>
                            <td><?= htmlspecialchars($row['sclcity']) ?></td>
                            <?php foreach ($columns as $column) { ?>
                                <td>
                                    <input type="text" name="<?= $column ?>" value="<?= htmlspecialchars($row[$column]) ?>" style= "background: content-box; width: 50px;" readonly>
                                </td>
                            <?php } ?>
                            <td><button class="btn" name="submit" type="submit" style="width: 120px;">Update</button></td>
                        </tr>
                    </form>
                <?php } ?>
            </tbody>

</section>

<script>
    // Fetch PHP data into JavaScript
    const purchasedCourses = <?php echo json_encode($purchased_courses); ?>; // List of purchased courses
    const allCourses = <?php echo json_encode($all_courses); ?>; // List of all available courses

    // Function to display available courses
    function displayCourses(purchasedCourses, allCourses) {
        const courseContainer = document.getElementById('courseContainer');
    
        allCourses.forEach(course => {
            const isPurchased = purchasedCourses.includes(course.name); // Check if course is purchased
            const newBox = document.createElement('div');
            newBox.className = 'box';

            // Determine payment for the course
            const paymentAmount = getPaymentForCourse(course.name);

            // Create the content for purchased or unpurchased courses
            let contentHTML = '';

            if (isPurchased) {
                // Display only the message if the course is already paid
                contentHTML = `
                    <div class="tutor">
                        <img src="images/img1.jpeg" alt="Course Image">
                        <div class="info">
                            <h3 class="card-title">${course.name}</h3>
                            <p style="color: green; font-size: medium;">This Course Already Paid</p> 
                        </div>
                    </div>
                `;
            } else {
                // Display Demo and Add buttons for unpurchased courses
                contentHTML = `
                    <div class="tutor">
                        <img src="images/img1.jpeg" alt="Course Image">
                        <div class="info">
                            <h3 class="card-title">${course.name}</h3>
                            <a href="${course.demoUrl}" class="inline-btn" target="_blank">Demo</a>
                            <a href="../e-edu/purchasenew.php?coursename=${encodeURIComponent(course.name)}&email=<?php echo $_SESSION['email']; ?>&contactno=<?php echo $_SESSION['contactno']; ?>" class="inline-btn" target="_blank">Add</a>

                            <p style="color:red; font-size: medium;">Price: ₹${paymentAmount}</p>
                        </div>
                    </div>
                `;
            }

            // Set the HTML content for the new course box
            newBox.innerHTML = contentHTML;
            courseContainer.appendChild(newBox);
        });
    }


    // Helper function to calculate payment dynamically for a given course
    function getPaymentForCourse(coursename) {
        //// Main Code Use
        // if (["JrKg", "SrKg", "1st", "2nd", "3rd", "4th"].includes(coursename)) {
        //     return 500;
        // } else if (["5th", "7th", "9th"].includes(coursename)) {
        //     return 1000;
        // } else if (["10th GSEB", "10th CBSE", "Phonics", "Gujaratisikho"].includes(coursename)) {
        //     return 1500;
        // } else {
        //     return 0;
        // }

        //Now Currently use  Tempary Code use check payment and QR Code wise
        if (["JrKg", "SrKg", "1st", "2nd", "3rd", "4th"].includes(coursename)) {
            return 1;
        } else if (["5th", "7th", "9th"].includes(coursename)) {
            return 2;
        } else if (["10thGSEB", "10thCBSE", "Phonics", "Gujaratisikho"].includes(coursename)) {
            return 3;
        } else {
            return 0;
        }
    }

    // Add courses to the page when it loads
    window.onload = () => {
        displayCourses(purchasedCourses, allCourses);
    };
</script>

<script>
    function displayCourses(purchasedCourses, allCourses) {
        const courseContainer = document.getElementById('courseContainer');

        allCourses.forEach(course => {
            const isPurchased = purchasedCourses.includes(course.name);
            const newBox = document.createElement('div');
            newBox.className = 'box';

            const contentHTML = `
                <div class="tutor">
                    <img src="images/img1.jpeg" alt="Course Image">
                    <div class="info">
                        <h3>${course.name}</h3>
                        <a href="${course.demoUrl}" class="inline-btn" target="_blank">Demo</a>
                        ${isPurchased 
                            ? `<p style="color: green;">Already Paid</p>` 
                            : `<a href="purchase.php?course=${encodeURIComponent(course.name)}" class="inline-btn">Purchase</a>`}
                    </div>
                </div>
            `;

            newBox.innerHTML = contentHTML;
            courseContainer.appendChild(newBox);
        });
    }
</script>


<br>
<?php include('footer_login.php'); ?>
