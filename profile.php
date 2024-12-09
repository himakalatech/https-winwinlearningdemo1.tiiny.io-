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
    $query = "SELECT name, image FROM registerdata WHERE email = $email";
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
   <title>profile</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/st.css">

</head>
<body>

<header class="header">
   
   <section class="flex">

      <a href="home.html" class="logo">win-win Learning</a>

      <form action="search.html" method="post" class="search-form">
         <input type="text" name="search_box" required placeholder="search courses..." maxlength="100">
         <button type="submit" class="fas fa-search"></button>
      </form>

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
               <img src="images/default_profile_image.jpg" class="image" alt="Profile Picture">
               <h3 class="name">Guest</h3>
            <?php endif; ?>
            <a href="login.php" class="option-btn">logout</a>
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

   </div>s

   <nav class="navbar">
      <a href="home.php"><i class="fas fa-home"></i><span>Home</span></a>
      <a href="about.php"><i class="fas fa-question"></i><span>about</span></a>
      <a href="courses.php"><i class="fas fa-graduation-cap"></i><span>courses</span></a>
      <a href="contact.php"><i class="fas fa-headset"></i><span>contact us</span></a>
   </nav>

</div>

<section class="user-profile">

   <h1 class="heading">your profile</h1>

   <div class="info">

      <div class="user">
      <?php if(!empty($user_name) && !empty($user_image)): ?>
               <img src="<?php echo $user_image; ?>" class="image" alt="Profile Picture">
               <h3 class="name"><?php echo $user_name; ?></h3>
            <?php else: ?>
               <img src="images/default_profile_image.jpg" class="image" alt="Profile Picture">
               <h3 class="name">Guest</h3>
            <?php endif; ?>
         <a href="update.php" class="inline-btn">update profile</a>
      </div>
   
      <div class="box-container">
   
         <div class="box">
            <div class="flex">
               <i class="fas fa-bookmark"></i>
               <div>
                  <span>4</span>
                  <p>saved playlist</p>
               </div>
            </div>
            <a href="#" class="inline-btn">view playlists</a>
         </div>
   
         <div class="box">
            <div class="flex">
               <i class="fas fa-heart"></i>
               <div>
                  <span>33</span>
                  <p>videos liked</p>
               </div>
            </div>
            <a href="#" class="inline-btn">view liked</a>
         </div>
   
         <div class="box">
            <div class="flex">
               <i class="fas fa-comment"></i>
               <div>
                  <span>12</span>
                  <p>videos comments</p>
               </div>
            </div>
            <a href="#" class="inline-btn">view comments</a>
         </div>
   
      </div>
   </div>

</section>
<section class="home-grid">

<h1 class="heading">quick options</h1>

<div class="box-container">

   <div class="box">
      <h3 class="title">likes and comments</h3>
      <p class="likes">total likes : <span>25</span></p>
      <a href="#" class="inline-btn">view likes</a>
      <p class="likes">total comments : <span>12</span></p>
      <a href="#" class="inline-btn">view comments</a>
      <p class="likes">saved playlists : <span>4</span></p>
      <a href="#" class="inline-btn">view playlists</a>
   </div>

   <div class="box">
      <h3 class="title">top categories</h3>
      <div class="flex">
         <a href="#"><i class="fas fa-code"></i><span>Mathematics</span></a>
         <a href="#"><i class="fas fa-chart-simple"></i><span>Economics</span></a>
         <a href="#"><i class="fas fa-cog"></i><span>Computer</span></a>
         <a href="#"><i class="fas fa-vial"></i><span>science</span></a>
      </div>
   </div>

   <div class="box">
      <h3 class="title">popular topics</h3>
      <div class="flex">
         <a href="#"><i class="fab fa-html5"></i><span>HTML</span></a>
         <a href="#"><i class="fab fa-css3"></i><span>CSS</span></a>
         <a href="#"><i class="fab fa-js"></i><span>javascript</span></a>
         <a href="#"><i class="fab fa-react"></i><span>react</span></a>
         <a href="#"><i class="fab fa-php"></i><span>PHP</span></a>
         <a href="#"><i class="fab fa-bootstrap"></i><span>bootstrap</span></a>
      </div>
   </div>
            </section>














<footer class="footer">

   &copy; copyright @ 2024 by <span>KalaTech</span> | all rights reserved!

</footer>

<!-- custom js file link  -->
<script src="js/script.js"></script>

   
</body>
</html>