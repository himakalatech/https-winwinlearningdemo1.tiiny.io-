<?php
session_start();
include('includes/db.php');
// Fetch user's name, image, and enrolled course from the database based on the session user ID
$user_name = '';
$user_image = '';
$user_course = ''; // Variable to store the enrolled course
if(isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $query = "SELECT name, image, course FROM data WHERE id = $user_id";
    $result = mysqli_query($con, $query);
    if($result && mysqli_num_rows($result) > 0) {
        $user_info = mysqli_fetch_assoc($result);
        $user_name = $user_info['name'];
        $user_image = $user_info['image'];
        $user_course = $user_info['course']; // Fetching enrolled course
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>courses</title>
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/st.css">
    <link rel="stylesheet" href="css/player.css">
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
<style>
/* Hide the download button */
.video-controls button[data-download] {
    display: none;
}
</style>
</head>
<body>
<header class="header">
        <section class="flex">
            <!-- <a href="home.html" class="logo">Win-Win Learning</a> -->
            <a href="index.php" class="logo">
            <img src="LOGO.png" alt="Win-Win Learning" style="max-height: 50px;">
            </a>
            <!-- <form action="search.html" method="post" class="search-form">
                <input type="text" name="search_box" required placeholder="search courses..." maxlength="100">
                <button type="submit" class="fas fa-search"></button>
            </form> -->
            <div class="icons">
                <div id="menu-btn" class="fas fa-bars"></div>
                <div id="search-btn" class="fas fa-search"></div>
                <div id="user-btn" class="fas fa-user"></div>
                <div id="toggle-btn" class="fas fa-sun"></div>
            </div>
            <div class="profile">
                <?php if(!empty($user_name) && !empty($user_image)): ?>
                <img src="<?php echo $user_image; ?>" class="image" alt="Profile Picture">
                <h3 class="name"><?php echo $user_name; ?></h3>
                <?php else: ?>
                <img src="images/img1.jpeg" class="image" alt="Profile Picture">
                <h3 class="name">Guest</h3>
                <?php endif; ?>
                <!-- <a href="profile.html" class="btn">view profile</a> -->
                <div class="flex-btn">
                <a href="logout.php" class="option-btn">Register</a>
                    <a href="logout.php" class="option-btn">Login</a>
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
                <?php if(!empty($user_name) && !empty($user_image)): ?>
                <img src="<?php echo $user_image; ?>" class="image" alt="Profile Picture">
                <h3 class="name"><?php echo $user_name; ?></h3>
                <?php else: ?>
                <img src="images/img1.jpeg" class="image" alt="Profile Picture">
                <h3 class="name">Guest</h3>
                <?php endif; ?>
                <!-- <a href="../logout.php" class="option-btn">Register</a>
                    <a href="../logout.php" class="option-btn">Login</a> -->
                    <a href="register.php" class="btn">Register</a>
                <!-- <a href="../profile.php" class="btn">view profile</a> -->
                <!-- <a href="#" class="btn" onclick="openPopup('../profile.php');" data-page="../profile.php"><i></i><span>View Profile</span></a> -->
            </div>
            <div class="navbar">
                <a href="#"><i class="fas fa-home"></i><span>Home</span></a>
                <a href="#" onclick="openPopup('aboutus.html');" class="popup-trigger" data-page="aboutus.html"><i class="fas fa-question"></i><span>about</span></a>
                <a href="#" onclick="openPopup('courses.php');" class="popup-trigger" data-page="courses.php"><i class="fas fa-graduation-cap"></i><span>courses</span></a>
                <a href="#" onclick="openPopup('purchase.php');" class="popup-trigger" data-page="purchase.php"><i class="fa-solid fa-cart-plus"></i><span>Purchase Course</span></a>
                <!-- <a href="#" onclick="openPopup('courses.php');" class="popup-trigger" data-page="courses.php"><i class="fas fa-graduation-cap"></i><span>courses</span></a> -->
                <a href="#" onclick="openPopup('co.php');" class="popup-trigger" data-page="contact.php"><i class="fas fa-headset"></i><span>contact us</span></a>
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
    <h3 class="heading">Grade 10 Demo videos</h3>
      <div class="container">
        <div class="main-video">
            <div class="video">
                <h3 class="title">Video for Trial </h3>
                <!-- <video id="mainVideo" controls controlsList="nodownload" muted autoplay></video> -->
                <video src="../videos/vid1.mp4" id="mainVideo" controls controlsList="nodownload" muted></video>
                
            </div>
        </div> 
    </div>  
    <!-- Footer -->
    <footer class="footer">
        &copy; copyright @ 2024 by <span> KalaTech</span> | all rights reserved!
    </footer>
    <!-- custom js file link  -->
    <script src="js/script.js"></script>
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
