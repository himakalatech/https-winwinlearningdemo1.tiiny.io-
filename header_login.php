<?php 
//session_start();
include('includes/db.php'); 

// Set the timeout duration (in seconds)
$timeout_duration = 600; // 10 minutes
//$timeout_duration = 900; // 15 minutes

// Check if the last activity time is set
if (isset($_SESSION['last_activity'])) {
    // Calculate the time difference since the last activity
    $time_since_last_activity = time() - $_SESSION['last_activity'];

    // If the time exceeds the timeout duration, log the user out
    if ($time_since_last_activity > $timeout_duration) {
        session_unset(); // Clear session data
        session_destroy(); // Destroy the session
        header("Location: login.php?timeout=true"); // Redirect to login page with a message
        exit;
    }
}

// Update the last activity time to the current time
$_SESSION['last_activity'] = time();


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
                $_SESSION['name'] = $user_data['name']; // Store the name in session
                $_SESSION['message'] = "echo <script>alert('Login successful!');</script>";
        
                // Redirect to the intended homepage after login
                header("Location: ../e-edu/index.php");
                exit();
            }
        }
        echo "<script type='text/javascript'> alert('Wrong username or password'); window.location.href='login.php';</script>";
    } else {
        echo "<script type='text/javascript'> alert('Please enter a valid email and password'); window.location.href='login.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!-- <title>login</title> -->
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/st.css">
   <link rel="stylesheet" href="css/style.css">
   <!-- <link rel="stylesheet" href="css/style.css"> -->
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

        html {
          height:100%;
        }

        body {
          margin:0;
        }

        .bg {
          animation:slide 3s ease-in-out infinite alternate;
          background-image: linear-gradient(-60deg, #6c3 50%, #09f 50%);
          bottom:0;
          left:-50%;
          opacity:.5;
          position:fixed;
          right:-50%;
          top:0;
          z-index:-1;
        }

        .bg2 {
          animation-direction:alternate-reverse;
          animation-duration:4s;
        }

        .bg3 {
          animation-duration:5s;
        }

        .content {
          background-color:rgba(255,255,255,.8);
          border-radius:.25em;
          box-shadow:0 0 .25em rgba(0,0,0,.25);
          box-sizing:border-box;
          left:50%;
          padding:10vmin;
          position:fixed;
          text-align:center;
          top:50%;
          transform:translate(-50%, -50%);
        }

        h1 {
          font-family:monospace;
        }

        @keyframes slide {
          0% {
            transform:translateX(-25%);
          }
          100% {
            transform:translateX(25%);
          }
        }
    </style>
</head>
<body>
<header class="header">   
   <section class="flex">
      <!-- <a href="index.php" class="logo"><img src="LOGO.png" style: height='50px'></a> -->
    <a href="./index.php" class="logo">
      <img src="LOGO.png" alt="Win-Win Learning" style="max-height: 50px;">
    </a>   

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="search-btn" class="fas fa-search"></div>
         <div id="user-btn" class="fas fa-user"></div>
         <div id="toggle-btn" class="fas fa-sun"></div>
      </div>

      <div class="profile">
                <?php if(!empty($user_name) && !empty($user_image)): ?>
                <img src="./<?php echo $user_image; ?>" class="image" alt="Profile Picture">
                <h3 class="name"><?php echo $user_name; ?></h3>
                <?php else: ?>
                <img src="./images/img1.jpeg" class="image" alt="Profile Picture">
                <!-- <h3 class="name">Guest</h3> -->
                <h3 class="name">
                    <?php 
                    if (isset($_SESSION['name']) && !empty($_SESSION['name'])) {
                        //echo htmlspecialchars($_SESSION['name']); 
                        echo strtoupper(htmlspecialchars($_SESSION['name'])); 
                    } else {
                        echo "Guest"; 
                    }
                    ?>
                </h3>
                <?php endif; ?>
                <!-- <a href="profile.html" class="btn">view profile</a> -->
                <div class="flex-btn">
                <a href="register.php" class="btn">Register</a>
                </div>
                <!-- <div class="flex-btn"> -->
                    <li class="nav-item">
                        <?php if (isset($_SESSION['email'])): ?>
                        <div class="flex-btn">
                            <a href="logout.php" class="option-btn">Logout</a>
                        </div>
                        <div class="flex-btn">
                        <?php else: ?>
                        <a href="login.php" class="option-btn">Login</a>
                        <?php endif; ?>
                        <div>
                    </li>
                    <!-- <a href="../admin/logout.php" class="option-btn">Logout</a> -->
                <!-- </div> -->
            </div>
   </section>
</header> 


<div class="bg"></div>
        <div class="bg bg2"></div>
        <div class="bg bg3"></div>
        <!-- <div class="content">
        <h1>Sliding Diagonals Background Effect</h1>
    </div> -->

<div class="side-bar">
   <div id="close-btn">
      <i class="fas fa-times"></i>
   </div>
   <nav class="navbar">
      <div class="profile">
         <img src="./images/img1.jpeg" class="image" alt="Profile Picture">
                <!-- <h3 class="name">Guest</h3> -->
                <h3 class="name">
                    <?php 
                    if (isset($_SESSION['name']) && !empty($_SESSION['name'])) {
                        //echo htmlspecialchars($_SESSION['name']); 
                        echo strtoupper(htmlspecialchars($_SESSION['name'])); 
                    } else {
                        echo "Guest"; 
                    }
                    ?>
                </h3>
         <a href="register.php" class="btn">Register</a>
      </div>
      <div class="navbar">
         <a href="index.php"><i class="fas fa-home"></i><span>Home</span></a>
         <a href="../e-edu/courses.php" class="popup-trigger"><i class="fas fa-graduation-cap"></i><span>Courses</span></a>
         <!-- <a href="../e-edu/payment.php" class="popup-trigger"><i class="fa-solid fa-cart-plus"></i><span>Purchase Course</span></a> -->
         <!-- <a href="../e-edu/purchasenew.php" class="popup-trigger"><i class="fa-solid fa-cart-plus"></i><span>Purchase Course</span></a> -->
         <a href="../e-edu/purchase.php" class="popup-trigger"><i class="fa-solid fa-cart-plus"></i><span>Purchase Course</span></a>
         <a href="../e-edu/aboutus.php" class="popup-trigger"><i class="fas fa-question"></i><span>About</span></a>
         <a href="../e-edu/contact.php" class="popup-trigger"><i class="fas fa-headset"></i><span>Contact Us</span></a>
      </div>
   </nav>
</div>