<?php
session_start();
require_once 'db.php'; // Include the database connection file

$message = ""; // Initialize message variable

// Function to check if the user is already registered for a course
function isUserAlreadyRegisteredForCourse($user_id, $course_name) {
    global $con; // Access the global connection object
    $query = "SELECT * FROM subjects WHERE id = ? AND (course1 = ? OR course2 = ? OR course3 = ? OR course4 = ? OR course5 = ? OR course6 = ? OR course7 = ? OR course8 = ? OR course9 = ? OR course10 = ? OR course11 = ? OR course12 = ? OR course13 = ?)";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "isssssssssssss", $user_id, $course_name, $course_name, $course_name, $course_name, $course_name, $course_name, $course_name, $course_name, $course_name, $course_name, $course_name, $course_name, $course_name);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_num_rows($result) > 0;
}

// Check if the user is logged in or registered
if(isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $query = "SELECT * FROM registerdata WHERE id=?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // Store user data in PHP variables
        $name = $row['name'];
        $fname = $row['fname'];
        $lname = $row['lname'];
        $gender = $row['gender'];
        $course = $row['course'];
        $contactno = $row['contactno'];
        $email = $row['email'];
        $sclname = $row['sclname'];
        $sclcity = $row['sclcity'];
        $address = $row['address'];
        $profile_image = $row['image'];
    }
}

// Autofill course based on the page being viewed
$autofill_course = basename($_SERVER['PHP_SELF'], ".php");

// Retrieve course information from the URL
function getCourseFromURL() {
    if(isset($_GET['course'])) {
        return $_GET['course'];
    } else {
        return ""; // Default value if course information is not provided
    }
}
$autofill_course = getCourseFromURL();

// Function to check if the user is registered
function isUserRegistered() {
    // Add your logic here to check if the user is registered
    // For example, you can check if the user is logged in or if they have a registration record in the database
    // Return true if registered, false otherwise
    return false; // Change this based on your actual implementation
}

// Check if the user is registered
$userRegistered = isUserRegistered();

// Check if the form is submitted
if(isset($_POST['submit'])) {
    // Process the form data
    // Here you can perform validation, database insertion, etc.
    
    // For demonstration purposes, let's assume the form submission was successful
    $new_course_name = "$autofill_course"; // Assuming the new course name to be added

    if (!isUserAlreadyRegisteredForCourse($user_id, $new_course_name)) {
        $empty_course_field_found = false;
        for ($i = 1; $i <= 13; $i++) {
            $course_field = "course$i";
            //echo "Checking course field: $course_field<br>"; // Debugging statement
            $query = "SELECT id FROM subjects WHERE id = ? AND ($course_field IS NULL OR $course_field = '')";
            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, "i", $user_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if (mysqli_num_rows($result) > 0) {
                // Found an empty course field, update it with the new course
                $query = "UPDATE subjects SET $course_field = ? WHERE id = ? AND ($course_field IS NULL OR $course_field = '')";
                $stmt = mysqli_prepare($con, $query);
                mysqli_stmt_bind_param($stmt, "si", $new_course_name, $user_id);
                mysqli_stmt_execute($stmt);
                $empty_course_field_found = true;
                // $message = "Course $new_course_name added successfully to $course_field!";
                break; // Exit the loop after updating the course field
            }
        }
    
        if (!$empty_course_field_found) {
            $message = "All course slots are full. Cannot add new course.";
        }
    } else {
        $message = "You are already registered for course $new_course_name!";
    } 
}

// Close connection
mysqli_close($con); // Close the database connection after all operations
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <link rel="stylesheet" href="css/st.css">
    <script>
        function validateForm() {
            var standard = document.forms["myForm"]["standard"].value; // Changed from grade to standard
            var password = document.forms["myForm"]["password"].value;
            var cpassword = document.forms["myForm"]["cpassword"].value;

            if (standard == "select") { // Changed from grade to standard
                alert("Please select a valid standard"); // Changed from grade to standard
                return false;
            }

            if (password !== cpassword) {
                alert("Passwords do not match");
                return false;
            }
        }
    </script>

<style>
        /* Styles for popup menu */
        .popup-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9999;
        }

        .popup-content {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 5px;
            border-radius: 2px;
            z-index: 10000;
            width: 90%; /* 90% of the viewport width */
            height: 90%; /* 90% of the viewport height */
            max-width: 1920px; /* Maximum width */
            max-height: 1080px; /* Maximum height */
        }

        .popup-close {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
        }

        @media (min-width: 1600px) and (max-width: 2050px) {
            /* Tablets */
            .popup-content {
                width: 70%;
                height: 70%;
            }
        }

        @media (min-width: 1200px) and (max-width: 1920px) {
            /* Tablets */
            .popup-content {
                width: 70%;
                height: 70%;
            }
        }

        @media (min-width: 800px) and (max-width: 1280px) {
            /* Tablets */
            .popup-content {
                width: 70%;
                height: 70%;
            }
        }

        @media (min-width: 2560px) and (max-width: 1700px) {
            /* Tablets */
            .popup-content {
                width: 70%;
                height: 70%;
            }
        }

        @media (min-width: 1440px) and (max-width: 2560px) {
            /* android */
            .popup-content {
                width: 70%;
                height: 70%;
            }
        }

        @media (min-width: 1080px) and (max-width: 1920px) {
            /* android */
            .popup-content {
                width: 70%;
                height: 70%;
            }
        }

        @media (min-width: 14440x) and (max-width: 3120px) {
            /* android */
            .popup-content {
                width: 70%;
                height: 70%;
            }
        }

        @media (min-width: 1080px) and (max-width: 2280px) {
            /* android */
            .popup-content {
                width: 70%;
                height: 70%;
            }
        }

        @media (min-width: 1440px) and (max-width: 2960px) {
            /* android */
            .popup-content {
                width: 70%;
                height: 70%;
            }
        }

        @media (min-width: 1440px) and (max-width: 2560px) {
            /* android */
            .popup-content {
                width: 70%;
                height: 70%;
            }
        }
       
        @media (max-width: 767px) {
            /* Mobile devices */
            .popup-content {
                width: 90%;
                height: 90%;
            }
        }
    </style>

</head>
<body>
<header class="header">
    <section class="flex">
        <a href="index.php" class="logo">
            <img src="LOGO.png" alt="Win-Win Learning" style="max-height: 50px;">
        </a>
        <form action="search.html" method="post" class="search-form">
            <input type="text" name="search_box" required placeholder="Search courses..." maxlength="100">
            <button type="submit" class="fas fa-search"></button>
        </form>
        <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <div id="search-btn" class="fas fa-search"></div>
            <div id="user-btn" class="fas fa-user"></div>
            <div id="toggle-btn" class="fas fa-sun"></div>
        </div>
        <div class="profile">
        <?php if(!empty($name) && !empty($profile_image)): ?>
            <img src="./<?php echo $profile_image; ?>" class="image" alt="Profile Picture">
            <h3 class="name"><?php echo $name; ?></h3>
        <?php else: ?>
            <img src="./images/default_profile_image.jpg" class="image" alt="Profile Picture">
            <h3 class="name">Guest</h3>
        <?php endif; ?>
            <a href="login.php" class="option-btn">Login</a>
            <div class="flex-btn">
                <a href="./logout.php" class="option-btn">Logout</a>
            </div>
        </div>
    </section>
</header>
<div class="side-bar">
    <div id="close-btn">
        <i class="fas fa-times"></i>
    </div>
    <nav class="navbar">
    <div class="profile">
        <?php if(!empty($name) && !empty($profile_image)): ?>
            <img src="./<?php echo $profile_image; ?>" class="image" alt="Profile Picture">
            <h3 class="name"><?php echo $name; ?></h3>
        <?php else: ?>
            <img src="./images/default_profile_image.jpg" class="image" alt="Profile Picture">
            <h3 class="name">Guest</h3>
        <?php endif; ?>
        <!-- <a href="#" class="btn" onclick="openPopup('./profile.php');" data-page="./profile.php"><i></i><span>View Profile</span></a> -->
    </div>
    <div class="navbar">
                <a href="#"><i class="fas fa-home"></i><span>Home</span></a>
                <a href="#" onclick="openPopup('./courses.php');" class="popup-trigger" data-page="./courses.php"><i class="fas fa-graduation-cap"></i><span>courses</span></a>
                <a href="#" onclick="openPopup('./purchase.php');" class="popup-trigger" data-page="./purchase.php"><i class="fa-solid fa-cart-plus"></i><span>Purchase Course</span></a>
                <a href="#" onclick="openPopup('./ab.php');" class="popup-trigger" data-page="./about.php"><i class="fas fa-question"></i><span>about</span></a>
                <a href="#" onclick="openPopup('./contact.php');" class="popup-trigger" data-page="./contact.php"><i class="fas fa-headset"></i><span>contact us</span></a>
                
            </div>
        </nav>
</div>

 <!-- Popup Container -->
 <div class="popup-overlay" id="popupOverlay">
        <div class="popup-content" id="popupContent">
            <!-- Content will be loaded dynamically here -->
            <span class="popup-close" onclick="closePopup()">Close</span>
        </div>
    </div>    



<!-- Display the message -->
<div><?php echo $message; ?></div>

<section class="form-container">
    <form name="myForm" action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
        <h3>Adding New Level</h3>
        <!-- Existing HTML form fields -->
        <!-- Name -->
        <input type="text" id="name" name="name" placeholder="Enter your name" required maxlength="50" class="box" value="<?php echo isset($name) ? $name : ''; ?>">
        <!-- Father Name -->
        <input type="text" id="fname" name="fname" placeholder="Enter your father's name" required maxlength="50" class="box" value="<?php echo isset($fname) ? $fname : ''; ?>">
        <!-- Surname -->
        <input type="text" id="lname" name="lname" placeholder="Enter your surname" required maxlength="50" class="box" value="<?php echo isset($lname) ? $lname : ''; ?>">
        <!-- Gender -->
        <select id="gender" name="gender" class="box">
            <option value="">Select Gender</option>
            <option value="male" <?php if(isset($gender) && $gender == 'male') echo 'selected'; ?>>Male</option>
            <option value="female" <?php if(isset($gender) && $gender == 'female') echo 'selected'; ?>>Female</option>
            <option value="no" <?php if(isset($gender) && $gender == 'no') echo 'selected'; ?>>Rather Not Say</option>
        </select>
        <!-- Course -->
        <select id="standard" name="standard" class="box">
            <!-- Show all options if the user is not registered -->
            <?php if (!$userRegistered) { ?>
                <option value="<?php echo $autofill_course; ?>"><?php echo $autofill_course; ?></option>
                <!-- Add more options as needed -->
            <?php } else { ?>
                <!-- Show only the autofilled option if the user is registered -->
                <option value="select">Select Standard</option>
            <?php } ?>
        </select>
        <!-- Hidden input to pass course information -->
        <input type="hidden" name="course" value="<?php echo $autofill_course; ?>">
        <!-- Other form fields and HTML content -->
        <!-- Contact Number -->
        <input type="tel" id="cnum" name="cnum" placeholder="Enter your contact number" required maxlength="10" class="box" value="<?php echo isset($contactno) ? $contactno : ''; ?>">
        <!-- Email -->
        <input type="email" id="email" name="email" placeholder="Enter your email" required maxlength="50" class="box" value="<?php echo isset($email) ? $email : ''; ?>">
        <!-- School Name -->
        <input type="text" id="sclname" name="sclname" placeholder="Enter your school name" required maxlength="50" class="box" value="<?php echo isset($sclname) ? $sclname : ''; ?>">
        <!-- School City -->
        <input type="text" id="scity" name="scity" placeholder="Enter your school city" required maxlength="50" class="box" value="<?php echo isset($sclcity) ? $sclcity : ''; ?>">
        <!-- Address -->
        <input type="text" id="address" name="address" placeholder="Enter your address" required maxlength="50" class="box" value="<?php echo isset($address) ? $address : ''; ?>">
        <!-- Password -->
        <input type="password" name="pass" placeholder="Enter your password" required maxlength="20" class="box">
        <input type="submit" value="Submit" name="submit" class="btn">
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </form>
</section>
<!-- ?php 
    include('footer.php');
?> -->
<footer class="footer">
    &copy; Copyright @ 2024 by <span>    <a href="https://www.kalatech.co.in/">KalaTech</a></span> | All rights reserved!
</footer>
<script src="js/script.js"></script>
<script src="js/buy.js"></script>

<!-- custom js file link  -->
<script src="../js/script.js"></script>
    <script>
        // Function to open the popup
        function openPopup(pageUrl) {
            var popupOverlay = document.getElementById('popupOverlay');
            var popupContent = document.getElementById('popupContent');
            // Load the content of the pageUrl into the popupContent
            popupContent.innerHTML = '<object type="text/html" data="' + pageUrl + '" style="width:100%; height:100%;"></object>';
            // Show the popup
            popupOverlay.style.display = 'block';
        }

        function closePopup() {
            var popupOverlay = document.getElementById('popupOverlay');
            // Hide the popup
            popupOverlay.style.display = 'none';
        }
      
        // Close the popup when user clicks outside the popup content
        window.onclick = function(event) {
            var popupOverlay = document.getElementById('popupOverlay');
            if (event.target == popupOverlay) {
                popupOverlay.style.display = "none";
            }
        };
    </script>

<!-- custom js file link  -->
<script src="../js/script.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let listVideos = document.querySelectorAll('.video-list .vid');
            let mainVideo = document.getElementById('mainVideo');
            let title = document.querySelector('.main-video .title');

            listVideos.forEach(video => {
                video.onclick = () => {
                    listVideos.forEach(vid => vid.classList.remove('active'));
                    video.classList.add('active');
                    if (video.classList.contains('active')) {
                        let src = video.querySelector('video').getAttribute('src');
                        mainVideo.src = src;
                        let text = video.querySelector('.title').innerHTML;
                        title.innerHTML = text;
                    }
                };
            });
        });
    </script>

</body>
</html>
