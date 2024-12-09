<?php 
session_start();
ob_start();

// Redirect logged-in users away from the login page
if (isset($_SESSION['email'])) {
    header("Location: ../e-edu/index.php"); // Redirect to the homepage or desired page
    exit();
}

include('header_login.php'); 
include('includes/db.php'); 


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {
        if ($email == "admin@123") {
            $stmt = $con->prepare("SELECT * FROM admin_login WHERE email = ? AND password = ?");
        } else {
            $stmt = $con->prepare("SELECT * FROM registerdata WHERE email = ? AND password = ?");
        }

        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $user_data = $result->fetch_assoc();

            if ($user_data['password'] == $password) {
                $_SESSION['email'] = $user_data['email'];
                $_SESSION['password'] = $user_data['password'];
                $_SESSION['contactno'] = $user_data['contactno'];
                $_SESSION['message'] = "echo <script>alert('Login successfull!');</script>"; // Success message

                // Redirect to the intended homepage after login
                //header("Location: ../e-edu/admin/index.php");
                header("Location: ../e-edu/index.php");
                exit();
            }
        }

        echo "<script type='text/javascript'> alert('Wrong username or password'); window.location.href='login.php';</script>";
    } else {
        echo "<script type='text/javascript'> alert('Please enter a valid email and password'); window.location.href='login.php';</script>";
    }
}

ob_end_flush();
?>


<!-- <div class="side-bar">
   <div id="close-btn">
      <i class="fas fa-times"></i>
   </div>
   <nav class="navbar">
      <div class="profile">
         <img src="./images/img1.jpeg" class="image" alt="Profile Picture">
         <h3 class="name">Guest</h3>
         <a href="register.php" class="btn">Register</a>
      </div>
      <div class="navbar">
         <a href=""><i class="fas fa-home"></i><span>Home</span></a>
         <a href="../e-edu/courses.php" class="popup-trigger"><i class="fas fa-graduation-cap"></i><span>Courses</span></a>
         <a href="../e-edu/purchase.php" class="popup-trigger"><i class="fa-solid fa-cart-plus"></i><span>Purchase Course</span></a>
         <a href="../e-edu/about.php" class="popup-trigger"><i class="fas fa-question"></i><span>About</span></a>
         <a href="../e-edu/contact.php" class="popup-trigger"><i class="fas fa-headset"></i><span>Contact Us</span></a>
      </div>
   </nav>
</div> -->

<section class="form-container">
    <div class="login-wrapper">
        <!-- Background Image Section -->
        <!-- <div class="login-image">
            <img src="images/course_icons/studimg.png" alt="Learning Icon">
        </div> -->

         <video class="d-block w-150" autoplay muted loop playsinline>
                            <source src="./images/animation/LoginImg.mp4" type="video/mp4">
                            <source src="./images/animation/LoginImg.webm" type="video/webm">
                            Your browser does not support the video tag.
                        </video>
    </div>
    <div class="form-container">
        <!-- Login Form Section -->
        <form action="" method="post" enctype="multipart/form-data">
            <h3>Login now</h3>
            <p><label>E-mail</label><span>*</span></p>
            <input type="email" name="email" placeholder="Please enter your email" class="box" required>
            <p>Your password <span>*</span></p>
            <input type="password" name="password" placeholder="Please enter your password" class="box" required>
            <input type="submit" value="Submit" name="submit" class="btn">
            <p>Not have an account? <a href="register.php">Signup here</a></p>
        </form>
    </div>
</section>


<?php include('footer_login.php'); ?>
