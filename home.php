<?php
session_start();
include('includes/db.php');
// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    // Redirect to login page if not logged in
    header("Location: index.php");
    exit;
}
// Fetch user's name and image from the database based on the session user ID
$user_name = '';
$user_image = '';
if(isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    //$query = "SELECT name, image FROM data WHERE id = $user_id";
    if ($email == "admin@123") {
        $stmt = $con->prepare("SELECT * FROM admin_login WHERE email = ?");
    } else {
        $stmt = $con->prepare("SELECT * FROM registerdata WHERE email = ?");
    }
    $result = mysqli_query($con, $query);
    if($result && mysqli_num_rows($result) > 0) {
        $user_info = mysqli_fetch_assoc($result);
        $user_name = $user_info['name'];
        $user_image = $user_info['image'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Home</title>
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/st.css">
   <link rel="stylesheet" href="css/player.css">
</head>
<body>
   <header class="header">
      <section class="flex">
         <a href="home.php" class="logo">Win-Win Learning!</a>
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
            <<?php if(!empty($user_name) && !empty($user_image)): ?>
               <img src="<?php echo $user_image; ?>" class="image" alt="Profile Picture">
               <h3 class="name"><?php echo $user_name; ?></h3>
            <?php else: ?>
               <img src="images/default_profile_image.jpg" class="image" alt="Profile Picture">
               <h3 class="name">Guest</h3>
            <?php endif; ?>
            <!-- <a href="profile.php" class="btn">view profile</a> -->
            <div class="flex-btn">
                        <?php if (isset($_SESSION['email'])): ?>
                        <div class="flex-btn">
                            <a href="logout.php" class="option-btn">Logout</a>
                        </div>
                        <div class="flex-btn">
                        <?php else: ?>
                        <a href="login.php" class="option-btn">Login</a>
                        <?php endif; ?>
                        <div>
                    <!-- <a href="login.php" class="option-btn">logout</a> -->
               <!-- <a href="register.html" class="option-btn">register</a> -->
            </div>
         </div>
      </section>
   </header>
   <div class="side-bar">
      <div id="close-btn">
         <i class="fas fa-times"></i>
      </div>
      <div class="profile">
      <?php if(!empty($user_name) && !empty($user_image)): ?>
               <img src="<?php echo $user_image; ?>" class="image" alt="Profile Picture">
               <h3 class="name"><?php echo $user_name; ?></h3>
            <?php else: ?>
               <img src="images/default_profile_image.jpg" class="image" alt="Profile Picture">
               <h3 class="name">Guest</h3>
            <?php endif; ?>
         <a href="profile.php" class="btn">view profile</a>
      </div>

      <nav class="navbar">
         <a href="home.php"><i class="fas fa-home"></i><span>Home</span></a>
         <a href="about.php"><i class="fas fa-question"></i><span>About</span></a>
         <a href="courses.php"><i class="fas fa-graduation-cap"></i><span>Courses</span></a>
         <!-- <a href="teachers.php"><i class="fas fa-chalkboard-user"></i><span>teachers</span></a> -->
         <a href="contact.php"><i class="fas fa-headset"></i><span>Contact Us</span></a>
      </nav>
   </div>
   
   <section class="courses">

   <!-- <section class="playlist-videos courses">
        <h3 class="heading">Grammar Tutorials for 9th Standard</h3>
        <div class="container">
            <div class="main-video">
                <div class="video">
                    <video id="mainVideo" controls controlsList="nodownload" muted autoplay></video>
                    <h3 class="title">01. Introduction to Chapters</h3>
                </div>
            </div>
            <div class="video-list">
                <div class="vid active">
                    <video src="videos/vid1.mp4" muted></video>
                    <h3 class="title">Introduction to Chapters</h3>
                </div>
                <div class="vid">
                    <video src="videos/vid2.mp4" muted></video>
                    <h3 class="title">01. CHAPTER ONE </h3>
                </div>
                <div class="vid">
                    <video src="videos/vid3.mp4" muted></video>
                    <h3 class="title">02. CHAPTER TWO</h3>
                </div>
                <div class="vid">
                    <video src="videos/vid4.mp4" muted></video>
                    <h3 class="title">03. CHAPTER THREE</h3>
                </div>
                <div class="vid">
                    <video src="videos/vid5.mp4" muted></video>
                    <h3 class="title">04. CHAPTER FOUR</h3>
                </div>
                <div class="vid">
                    <video src="videos/vid6.mp4" muted></video>
                    <h3 class="title">05. CHAPTER FIVE</h3>
                </div>
                <div class="vid">
                    <video src="videos/vid1.mp4" muted></video>
                    <h3 class="title">06. CHAPTER SIX</h3>
                </div>
                <div class="vid">
                    <video src="videos/vid2.mp4" muted></video>
                    <h3 class="title">07. CHAPTER SEVEN</h3>
                </div>
            </div>
        </div>
    </section>
 -->
   </section>

   <footer class="footer">
      &copy; copyright @ 2022 by <span>mr. web designer</span> | all rights reserved!
   </footer>
   <!-- custom js file link  -->
   <script src="js/script.js"></script>
<!-- custom js file link  -->
<script src="js/script.js"></script>
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