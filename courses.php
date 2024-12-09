<?php
    session_start();
    include('header_login.php');
    include('includes/db.php');

    // Check if the user is logged in
    if (!isset($_SESSION['email'])) {
        echo "<script>alert('You must be logged in to access this page.'); window.location.href='login.php';</script>";
        exit();
    }

    $email = $_SESSION['email'];
    //$contact_no = $_SESSION['contactno'];
    $payment_status = 1;
    // Get purchased courses by the user
    $purchased_courses = [];

    // Fetch purchased courses for the logged-in user
    $query = "SELECT DISTINCT coursename FROM subjects WHERE email = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Store purchased course names in an array
    while ($row = mysqli_fetch_assoc($result)) {
        $purchased_courses[] = $row['coursename'];
    }
    mysqli_stmt_close($stmt);

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



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select All Courses</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <link rel="stylesheet" href="css/st.css">
</head>
<body>
<section class="courses">
    <h1 class="heading">Your Select Courses</h1>
    <div class="box-container" id="courseContainer"></div>
</section>
<script src="js/script.js"></script>

<script>
    // Fetch PHP data into JavaScript
    const purchasedCourses = <?php echo json_encode($purchased_courses); ?>;
    const allCourses = <?php echo json_encode($all_courses); ?>;

    // Function to dynamically add courses to the page
    function addCoursesToPage(purchasedCourses, allCourses) {
        const courseContainer = document.getElementById('courseContainer');

        allCourses.forEach((course) => {
            const isPurchased = purchasedCourses.includes(course.name);
            const newBox = document.createElement('div');
            newBox.className = 'box';

            // Generate content based on purchase status
            let contentHTML = `
                <div class="tutor">
                    <img src="images/img1.jpeg" alt="Course Image">
                    <div class="info">
                        <h3 class="card-title">${course.name}</h3>`;

            if (isPurchased) {
                // For purchased courses, show "View Course" button
                contentHTML += `
                    <a href="${course.videoUrl}" class="inline-btn" target="_blank">View Course</a>
                `;
            } else {
                // For unpurchased courses, display only a message with a purchase link
                contentHTML += `
                    <p style="color: red; font-size: medium;">This course isn't yet purchased.</p>
                    <a href="../e-edu/purchasenew.php?coursename=${encodeURIComponent(course.name)}&email=<?php echo $_SESSION['email']; ?>&contactno=<?php echo $_SESSION['contactno']; ?>" class="inline-btn" target="_blank">Go to Purchase Page</a>
                `;
            }

            contentHTML += `
                    </div>
                </div>
            `;

            newBox.innerHTML = contentHTML;
            courseContainer.appendChild(newBox);
        });
    }

    // Add courses to the page when it loads
    window.onload = () => {
        addCoursesToPage(purchasedCourses, allCourses);
    };

</script>

<?php include('footer_login.php'); ?>
</body>
</html>
