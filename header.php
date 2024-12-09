<?php 

    include(__DIR__ . '/includes/header.php');
    include(__DIR__ . '/includes/db.php');
    include(__DIR__ . '/includes/footer.php');
    


    // Set the timeout duration (in seconds)
    $timeout_duration = 300; // 10 minutes
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap css begin here -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="css/_modal.css">
    <!-- Bootstrap css end here -->
    <!-- Font Awesome CSS begin here -->
    <link rel="stylesheet" href="css/all.min.css">
    <!-- Font Awesome CSS end here -->
    <!-- Google fonts begin here -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link
    href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"
    rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- Google fonts end here -->

    
    <!-- CUSTOM CSS BEGIN HERE -->
    <link rel="stylesheet" href="css/style.css">
    <!-- <link rel="stylesheet" href="css/st.css"> -->
    <!-- CUSTOM CSS END HERE -->
    <title>Win-Win Learning!</title>
 
    <style>
         /* Basic styles */

        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .logo img {
            width: 175px;
            /* height: auto; */
        }
        .btn-pink{
            background-color: #ef1f89;
        }
        /* Dropdown on hover */
        .navbar-nav .nav-item.dropdown:hover .dropdown-menu {
            display: block;
            transition: 0.3s ease;
        }

        .custom-arrow {
            width: 40px;  /* Adjust width as needed */
            height: 40px; /* Adjust height as needed */
        }

        .carousel-control-prev, .carousel-control-next {
            top: 50%; /* Center vertically */
            transform: translateY(-50%);
        }

        .backtotop-wrapper {
            position: fixed;
            bottom: 20px;
            right: 20px; /* Change to "left: 20px;" if you want it on the left side */
            z-index: 1000;
        }

        .back-to-top .custom-arrow {
            width: 40px; /* Adjust the size as needed */
            height: 40px;
        }

        .back-to-top {
            cursor: pointer;
        }

        /* Background video */
        .background-video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
            opacity: 0.6;
        }

        /* Sound toggle button styling */
        .sound-button {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: rgba(255, 255, 255, 0.7);
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            z-index: 1;
            font-size: 14px;
            border-radius: 5px;
        }

        .carousel-inner video {
            object-fit: cover; /* This ensures the video covers the entire area */
            /*height: 115vh;  Adjust the height as needed */
            height: 1100px;
        }
        /* Add a light overlay effect to the videos */
        .carousel-item video::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.2); /* Adjust the color and opacity here */

            z-index: 1; /* Ensures the overlay is above the video */
            pointer-events: none; /* Ensures the overlay does not block video controls */
        }

        /* Position the video behind the overlay */
        .carousel-item video {
            position: relative;
            z-index: 0;
        }

        /* Styling for the round arrow button */
        .rounded-arrow {
            background-color: lightyellow; /* lightyellow background */
            border-radius: 50%; /* Makes it circular */
            /* padding: 10px; Adds padding inside the circle */
            width: 40px; /* Set the width of the arrow icon */
            height: 40px; /* Set the height of the arrow icon */
            display: inline-flex; /* Align the icon within the circle */
            align-items: center; /* Center the icon vertically */
            justify-content: center; /* Center the icon horizontally */
            cursor: pointer; /* Show pointer cursor on hover */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); /* Optional: adds a shadow effect */
        }

        /* CSS for round social media icons */
        .social-icon {
            width: 40px; /* Adjust icon size */
            height: 40px; /* Maintain square aspect ratio */
            /* background-color: darkgray; Background color for the circle */
            border-radius: 50%; /* Make it round */
            padding: 1px; /* Space between the icon and the edge */
            display: inline-block; /* Align icons inline */
            margin: 5px; /* Space between icons */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); /* Optional shadow effect */
            object-fit: cover; /* Ensures image fits well */
        }

        /* Fix positioning for wrapper */
        .wrapper {
            position: relative; /* Use relative positioning */
            overflow: hidden;
            width: 500px;
            height: 50px;
            text-align: center;
        }

        /* Fix slide animation */
        .slide-custom {
            width: 1200px;
            height: 50px;
            position: relative; /* Use relative positioning */
            animation: slideIn 5s forwards;
        }
        /* moz and webkit keyframes excluded for space */

        @keyframes slideIn {
            0% {
                transform: scaleX(0);
            }
            100% {
                transform: scaleX(1);
            }
        }
         /* bigshot one font */
        @import url(https://fonts.googleapis.com/css?family=Cabin+Condensed);

            /* CSS */

            .test-slide {
            animation-duration: 3s;
            animation-name: testSlide;
        }

        @keyframes testSlide {
            from {
                margin-left: 0%;
                width: 50%;
            }
            to {
                margin-left: 60%;
                width: 100%;
            }
        }


        html {
          height:100%;
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
          /* font-family:monospace; */
          font-family: auto;
        }

        @keyframes slide {
          0% {
            transform:translateX(-25%);
          }
          100% {
            transform:translateX(25%);
          }
        }

        /* Make sure submenus are correctly displayed */
        .dropdown-submenu:hover > .dropdown-menu {
            display: block;
            top: 0;
            left: 100%;
            margin-top: -1px;
        }

        .dropdown-menu {
            transition: all 0.3s ease; /* Smooth transitions */
        }

        .dropdown-submenu .dropdown-menu {
            margin-left: 10px; /* Indent submenus */
            top: 0; /* Align with parent item */
        }

        .dropdown-item:hover {
            background-color: #f1f1f1;
            cursor: pointer;
        }


        .carousel-item video {
            filter: brightness(50%);
        }

        .carousel-item video:hover {
            filter: brightness(100%);
        }

        #playAudioButton {
            border-radius: 15px !important;
            padding: 10px 20px;
            font-size: 16px;
            background-color: deeppink; /* Button color */
            color: white;
            border: ridge;
            /* border-radius: 10px; */
            cursor: pointer;
            /* align:center; */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);  Optional shadow
        }

        #playAudioButton:hover {
            background-color: blueviolet; /* Hover color */
        }

        .text-overlay {
            position: absolute;
            top: 50%; /* Center vertically */
            left: 50%; /* Center horizontally */
            transform: translate(-50%, -50%);
            color: white;
            background: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }

    </style>
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-light bg-light">
  
    <div class="logo">
        <a href="index.php"> <img src="LOGO.png" alt="Logo"> </a>
    </div>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
  <ul class="navbar-nav ml-auto">
  <!-- <ul class="navbar-nav ml-auto" style="background-color:powderblue;"> -->
        <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="aboutus.php">About us</a>
        </li>

        <!-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="allcourse.php" id="navbarDropdown" role="button">Courses</a>

                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="demo/jrkg.php">JR. KG.</a>
                        <a class="dropdown-item" href="demo/srkg.php">SR. KG.</a>
                        <a class="dropdown-item" href="demo/1.php">1 Std.</a>
                        <a class="dropdown-item" href="demo/2.php">2 Std.</a>
                        <a class="dropdown-item" href="demo/3.php">3 Std.</a>
                        <a class="dropdown-item" href="demo/4.php">4 Std.</a>
                        <a class="dropdown-item" href="demo/5.php">5 Std.</a>
                        <a class="dropdown-item" href="demo/6n7.php">6 & 7 Std.</a>
                        <a class="dropdown-item" href="demo/8n9.php">8 & 9 Std.</a>
                        <a class="dropdown-item" href="demo/10cbse.php">10 Std. CBSE</a>
                        <a class="dropdown-item" href="demo/10gseb.php">10 Std. GSEB</a>
                        <a class="dropdown-item" href="demo/gujaratisikho.php">Gujarati Sikho</a>
                        <a class="dropdown-item" href="demo/phonics.php">Phonics</a>
                    </div>
        </li> -->

        <!-- Dropdown Multiple Courses List -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button">
                Courses
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <!-- Sub-Menu for Kindergarten -->
                <li class="dropdown-submenu">
                    <a class="dropdown-item dropdown-toggle" href="#" onclick="toggleSubmenu(event, 'kindergartenMenu')">Kindergarten</a>
                    <ul class="dropdown-menu" id="kindergartenMenu" style="display: none;">
                        <li><a class="dropdown-item" href="demo/jrkg.php">JR. KG.</a></li>
                        <li><a class="dropdown-item" href="demo/srkg.php">SR. KG.</a></li>
                    </ul>
                </li>

                <li class="dropdown-submenu">
                    <a class="dropdown-item dropdown-toggle" href="#" onclick="toggleSubmenu(event, 'primarycourses')">Primary Courses</a>
                    <ul class="dropdown-menu" id="primarycourses" style="display: none;">
                        <li><a class="dropdown-item" href="demo/1.php">1 Std.</a></li>
                        <li><a class="dropdown-item" href="demo/2.php">2 Std.</a></li>
                        <li><a class="dropdown-item" href="demo/3.php">3 Std.</a></li>
                        <li><a class="dropdown-item" href="demo/4.php">4 Std.</a></li>
                        <li><a class="dropdown-item" href="demo/5.php">5 Std.</a></li>
                    </ul>
                </li>

                <!-- Additional Courses -->
                <li><a class="dropdown-item" href="demo/gujaratisikho.php">Gujarati Sikho</a></li>
                <li><a class="dropdown-item" href="demo/phonics.php">Phonics</a></li>
            </ul>
        </li>


        <li class="nav-item">
          <a class="nav-link" href="payment.php" style="color: red;">Payment</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="purchase.php" style="color: mediumblue;">Purchase</a>
        </li>
                    
        <!-- <li class="nav-item">
                        ?php if (isset($_SESSION['email'])): ?>
                        <div class="flex-btn">
                            <a href="logout.php" class="nav-link">Logout</a>
                        </div>
                        <div class="flex-btn">
                        ?php else: ?>
                        <a href="login.php" class="nav-link">Login</a>
                        ?php endif; ?>
                        <div>
        </li> -->

        <li class="nav-item">
            <?php if (isset($_SESSION['email'])): ?>
                <a href="logout.php" class="nav-link">Logout</a>
            <?php else: ?>
                <a href="login.php" class="nav-link">Login</a>
            <?php endif; ?>
        </li>

        <li class="nav-item">
            <!-- <a class="nav-link" href="index.php#Contact">Contact</a> -->
            <a class="nav-link" href="contact.php">Contact</a>
        </li>
    </ul>
  </div>
</nav>

    <!-- Navigation Section end here -->

<?php 
    include 'db.php';

    // // Check if there's a success message to display
    // if (isset($_SESSION['message'])) {
    //     echo "<div class='alert-success'>" . $_SESSION['message'] . "</div>";
    //     unset($_SESSION['message']); // Clear the message after displaying it
    // }

    //$query = "SELECT `Id`, `Name`,`detail`, `detail1`, `detail2`, `detail3`, `SubNm1`, `SubNm2`, `SubNm3`, `img1`, `img2`, `img3`, `img4` FROM `about` WHERE 1";
    $query = "SELECT `Id`, `Name`,`detail`, `detail1`, `SubNm1`, `img1`, `detail2`, `SubNm2`, `img2`, `detail3`, `SubNm3`, `img3`, `detail4`, `SubNm4`, `img4`, `detail5`, `SubNm5`, `img5`, `detail6`, `SubNm6`, `img6`, `detail7`, `SubNm7`, `img7`,`UpDt` FROM `home` WHERE 1";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row     = mysqli_fetch_assoc($result); // Fetch a single row as an associative array
        $Name    = $row['Name'];
        $img1    = $row["img1"];
        $detail1 = $row['detail1']; 
        $SubNm1  = $row['SubNm1'];
        $img2    = $row["img2"];
        $detail2 = $row['detail2'];
        $SubNm2  = $row['SubNm2'];
        $img3    = $row["img3"];
        $detail3 = $row['detail3'];
        $SubNm3  = $row['SubNm3'];
        $img4    = $row["img4"];
        $detail4 = $row['detail4']; 
        $SubNm4  = $row['SubNm4'];
        $img5    = $row["img5"];
        $detail5 = $row['detail5'];
        $SubNm5  = $row['SubNm5'];
        $img6    = $row["img6"];
        $detail6 = $row['detail6'];
        $SubNm6  = $row['SubNm6'];
        $img7    = $row["img7"];
        $detail7 = $row['detail7'];
        $SubNm7  = $row['SubNm7'];
        $detail = $row['detail'];

    } else {
        $detail1 = "Data not found"; // Display a fallback message if no data is available
    }
?>

    <div class="container-fluid slider-images-position">
        <div class="row text-center">
            <div id="myCarousel1" class="carousel slide" data-ride="carousel" data-interval="5000" style="padding: 0">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel1" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel1" data-slide-to="1"></li>
                    <li data-target="#myCarousel1" data-slide-to="2"></li>
                    <li data-target="#myCarousel1" data-slide-to="3"></li>
                    <li data-target="#myCarousel1" data-slide-to="4"></li>
                    <li data-target="#myCarousel1" data-slide-to="5"></li>
                    <li data-target="#myCarousel1" data-slide-to="6"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <!-- <div class="carousel-item active">
                        <!-- <img src="./images/bgimage/23.avif" style="width: 100%; height: 50%" class="img-responsive" alt="Slide 1"> --
                        <video class="d-block w-100" autoplay muted loop playsinline>
                            <!-- <source src="./images/videos/vecteezy_fly-through-formulas-white_1623381.mp4" type="video/mp4"> --
                            <source src="./images/videos/<?php echo $img1; ?>" type="video/mp4">
                            <source src="./images/videos/vecteezy_fly-through-formulas-white_1623381.webm" type="video/webm">
                            Your browser does not support the video tag.
                        </video>
                    </div> -->

                    <div class="carousel-item active" style="position: relative;">
                        <!-- Video -->
                        <video class="d-block w-100" autoplay muted loop playsinline>
                            <source src="./images/videos/<?php echo $img1; ?>" type="video/mp4">
                            <source src="./images/videos/vecteezy_fly-through-formulas-white_1623381.webm" type="video/webm">
                        </video>

                        <!-- Text Overlay -->
                        <div class="text-overlay">
                            <h1><?php echo htmlspecialchars($detail1); ?></h1>
                            <p><?php echo htmlspecialchars($SubNm1); ?></p>
                        </div>

                        <!-- Text Overlay -->
                        <!-- <div class="carousel-caption d-flex align-items-center justify-content-center" 
                            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; color: white; background: rgba(0, 0, 0, 0.5); text-align: center;"> -->
                        <!-- <div id="myCarousel1" class="carousel slide d-flex align-items-center justify-content-center" data-ride="carousel" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; color: white; background: rgba(0, 0, 0, 0.5); text-align: center;">
                            <h1><?php echo htmlspecialchars($detail1); ?></h1>
                        </div> -->
                    </div>

                    <!-- <div class="carousel-item" style="heigth:1195px;">
                        <!-- <img src="./images/bgimage/11.jpg" style="width: 100%; height: 50%" class="img-responsive" alt="Slide 2"> --
                        <video class="d-block w-100" autoplay muted loop playsinline>
                            <!-- <source src="./images/videos/215471_small.mp4" type="video/mp4"> --
                            <source src="./images/videos/<?php echo $img2; ?>" type="video/mp4">
                            <source src="./images/videos/215471_small.webm" type="video/webm">
                            Your browser does not support the video tag.
                        </video>
                    </div> -->

                    <div class="carousel-item" style="position: relative;">
                        <!-- <img src="./images/bgimage/11.jpg" style="width: 100%; height: 50%" class="img-responsive" alt="Slide 2"> -->
                        <video class="d-block w-100" autoplay muted loop playsinline>
                            <!-- <source src="./images/videos/215471_small.mp4" type="video/mp4"> -->
                            <source src="./images/videos/<?php echo $img2; ?>" type="video/mp4">
                            <source src="./images/videos/215471_small.webm" type="video/webm">
                            Your browser does not support the video tag.
                        </video>
                        
                            <!-- Text Overlay -->
                        <div class="text-overlay">
                            <h1><?php echo htmlspecialchars($detail2); ?></h1>
                            <p><?php echo htmlspecialchars($SubNm2); ?></p>
                        </div>
                    </div>


                    <div class="carousel-item" style="position: relative;">
                        <!-- <img src="./images/bgimage/7.jpg" style="width: 100%; height: 50%" class="img-responsive" alt="Slide 3"> -->
                        <video class="d-block w-100" autoplay muted loop playsinline>
                            <!-- <source src="./images/videos/vecteezy_school-girl-talking-to-distance-tutor-with-video-call-on_4512037.mp4" type="video/mp4"> -->
                            <source src="./images/videos/<?php echo $img3; ?>" type="video/mp4">
                            <source src="./images/videos/vecteezy_school-girl-talking-to-distance-tutor-with-video-call-on_4512037.webm" type="video/webm">
                            Your browser does not support the video tag.
                        </video>

                        <!-- Text Overlay -->
                        <div class="text-overlay">
                            <h1><?php echo htmlspecialchars($detail3); ?></h1>
                            <p><?php echo htmlspecialchars($SubNm3); ?></p>
                        </div>

                        <!-- <div class="carousel-caption d-flex align-items-center justify-content-center" 
                            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; color: white; background: rgba(0, 0, 0, 0.5); text-align: center;"> -->
                        <!-- <div id="myCarousel1" class="carousel slide d-flex align-items-center justify-content-center" data-ride="carousel" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; color: white; background: rgba(0, 0, 0, 0.5); text-align: center;">
                            <h1><?php echo htmlspecialchars($detail3); ?></h1>
                        </div> -->
                    </div>

                    <div class="carousel-item">
                        <!-- <img src="./images/bgimage/16.avif" style="width: 100%; height: 50%" class="img-responsive" alt="Slide 4"> -->
                        <video class="d-block w-100" autoplay muted loop playsinline>
                            <!-- <source src="./images/videos/35449-407130915_small.mp4" type="video/mp4"> -->
                            <source src="./images/videos/<?php echo $img4; ?>" type="video/mp4">
                            <source src="./images/videos/35449-407130915_small.webm" type="video/webm">
                            Your browser does not support the video tag.
                        </video>
                        <!-- Text Overlay -->
                        <div class="text-overlay">
                            <h1><?php echo htmlspecialchars($detail4); ?></h1>
                            <p><?php echo htmlspecialchars($SubNm4); ?></p>
                        </div>
                        <!-- <div id="myCarousel1" class="carousel slide d-flex align-items-center justify-content-center" data-ride="carousel" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; color: white; background: rgba(0, 0, 0, 0.5); text-align: center;">
                            <h1><?php echo htmlspecialchars($detail4); ?></h1>
                        </div> -->
                    </div>

                    <div class="carousel-item">
                        <!-- <img src="./images/bgimage/20.avif" style="width: 100%; height: 50%" class="img-responsive" alt="Slide 5"> -->
                        <video class="d-block w-100" autoplay muted loop playsinline>
                            <!-- <source src="./images/videos/215475_small.mp4" type="video/mp4"> -->
                            <source src="./images/videos/<?php echo $img5; ?>" type="video/mp4">
                            <source src="./images/videos/215475_small.webm" type="video/webm">
                            Your browser does not support the video tag.
                        </video>
                        <!-- Text Overlay -->
                        <div class="text-overlay">
                            <h1><?php echo htmlspecialchars($detail5); ?></h1>
                            <p><?php echo htmlspecialchars($SubNm5); ?></p>
                        </div>
                        <!-- <div id="myCarousel1" class="carousel slide d-flex align-items-center justify-content-center" data-ride="carousel" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; color: white; background: rgba(0, 0, 0, 0.5); text-align: center;">
                            <h1><?php echo htmlspecialchars($detail5); ?></h1>
                        </div> -->
                    </div>
                    <div class="carousel-item">
                        <!-- <img src="./images/bgimage/25.avif" style="width: 100%; height: 50%" class="img-responsive" alt="Slide 6"> -->
                        <video class="d-block w-100" autoplay muted loop playsinline>
                            <!-- <source src="./images/videos/206779_small.mp4" type="video/mp4"> -->
                            <source src="./images/videos/<?php echo $img6; ?>" type="video/mp4">
                            <source src="./images/videos/206779_small.webm" type="video/webm">
                            Your browser does not support the video tag.
                        </video>
                         <!-- Text Overlay -->
                         <div class="text-overlay">
                            <h1><?php echo htmlspecialchars($detail6); ?></h1>
                            <p><?php echo htmlspecialchars($SubNm6); ?></p>
                        </div>
                        <!-- <div id="myCarousel1" class="carousel slide d-flex align-items-center justify-content-center" data-ride="carousel" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; color: white; background: rgba(0, 0, 0, 0.5); text-align: center;">
                            <h1><?php echo htmlspecialchars($detail6); ?></h1>
                        </div> -->
                    </div>
                    <div class="carousel-item">
                        <!-- <img src="./images/bgimage/10.jpg" style="width: 100%" class="img-responsive" alt="Slide 7"> -->
                        <video class="d-block w-100" autoplay muted loop playsinline>
                            <!-- <source src="./images/videos/1058-142621439_small.mp4" type="video/mp4"> -->
                            <source src="./images/videos/<?php echo $img7; ?>" type="video/mp4">
                            <source src="./images/videos/1058-142621439_small.webm" type="video/webm">
                            Your browser does not support the video tag.
                        </video>
                         <!-- Text Overlay -->
                         <div class="text-overlay">
                            <h1><?php echo htmlspecialchars($detail7); ?></h1>
                            <p><?php echo htmlspecialchars($SubNm7); ?></p>
                        </div>
                    </div>
                    
                    <!-- <div id="myCarousel1" class="carousel slide d-flex align-items-center justify-content-center" data-ride="carousel" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; color: white; background: rgba(0, 0, 0, 0.5); text-align: center;">
                            <h1><?php echo htmlspecialchars($detail7); ?></h1>
                    </div> -->
                </div>

                <!-- Left and right controls -->
                <a class="carousel-control-prev" href="#myCarousel1" role="button" data-slide="prev">
                    <span><img src="./images/left-arrow-svgrepo-com.svg" class="custom-arrow rounded-arrow" alt="Previous"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#myCarousel1" role="button" data-slide="next">
                    <span><img src="./images/right-arrow-svgrepo-com.svg" class="custom-arrow rounded-arrow" alt="Next"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
    <!-- start text banner begin here -->
    <div class="container-fluid bg-warning txt-banner" style="align-text:black">
        <div class="row bottom-banner">
            <div class="col-sm">
                <h5>
                    <i class="fa fa-address-book-o mr-6"></i>1st Std. to 10th Std. Complete Grammar Preparation
                </h5>
            </div>
            <div class="col-sm">
                <h5><i class="fa fa-users mr-2"></i>Expert Instructors</h5>
            </div>
            <div class="col-sm">
                <h5><i class="fa fa-universal-access mr-2"></i>Lifetime Access
                </h5>
            </div>
            <div class="col-sm">
                <h5><i class="fa fa-money mr-2"></i>Money Worth*
                </h5>
            </div>
        </div>
    </div>
    <!-- Start text banner end here -->

<br>
<!-- Audio Integration -->
<audio id="myAudio" loop>
    <source src="./song/educational-music-study-learning-student-background-intro-theme-263145.ogg" type="audio/ogg">
    <source src="./song/educational-music-study-learning-student-background-intro-theme-263145.mp3" type="audio/mpeg">
    Your browser does not support the audio element.
</audio>

<button id="playAudioButton" style="place-self:center; display: flow-root;">Play Audio</button>

<script>
    window.onload = function () {
        const audioElement = document.getElementById('myAudio');
        const playButton = document.getElementById('playAudioButton');

        // Ensure audio is initially stopped and configure settings
        audioElement.volume = 0.1;    // Set volume to 10%
        audioElement.muted = false;   // Unmute audio
        audioElement.pause();         // Pause audio initially

        // Event listener for Play Audio button
        playButton.addEventListener('click', () => {
            if (audioElement.paused) {
                // Play audio if paused
                audioElement.play().then(() => {
                    console.log('Audio started successfully.');
                    playButton.textContent = 'Pause Audio'; // Update button text to "Pause"
                }).catch(error => {
                    console.log('Error starting audio:', error);
                });
            } else {
                // Pause audio if playing
                audioElement.pause();
                playButton.textContent = 'Play Audio'; // Update button text to "Play"
            }
        });

        // Display the button until audio starts
        audioElement.addEventListener('play', () => {
            playButton.style.display = 'none'; // Hide the button after the audio starts
        });

        // If playback stops, show the button again
        audioElement.addEventListener('pause', () => {
            playButton.style.display = 'block'; // Show the button again if paused
        });

        // Error handling for audio playback
        audioElement.addEventListener('error', function () {
            console.error("Failed to load audio.");
            playButton.textContent = 'Audio Error'; // Update button text on error
        });
    }
</script>

<style>
    #playAudioButton {
        border-radius: 15px !important;
        padding: 10px 20px;
        font-size: 16px;
        background-color: deeppink; /* Button color */
        color: white;
        border: ridge;
        cursor: pointer;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Optional shadow */
    }

    #playAudioButton:hover {
        background-color: blueviolet; /* Hover color */
    }
</style>



<script>
    const videoElement = document.querySelector('.carousel-item video');
    const isSafari = /^((?!chrome|android).)*safari/i.test(navigator.userAgent);
    
    if (isSafari) {
        // Only load .mov for Safari
        videoElement.innerHTML = `
            <source src="./images/videos/vecteezy_mother-teaching-lesson-for-daughter-by-laptop-asian-young_17202704.mov" type="video/quicktime">
            Your browser does not support the .mov video tag.
        `;
    }
</script>

<script>
    const dropdown = document.querySelector('.nav-item.dropdown');
    const dropdownMenu = document.querySelector('.dropdown-menu');

    dropdown.addEventListener('mouseenter', function() {
        dropdownMenu.style.display = 'block';
    });

    dropdown.addEventListener('mouseleave', function() {
        dropdownMenu.style.display = 'none';
    });
</script>

<!-- JavaScript for Toggling Submenus -->
<script>
    function toggleSubmenu(event, submenuId) {
        event.preventDefault(); // Prevent default link behavior

        // Close all open submenus
        const allSubmenus = document.querySelectorAll('.dropdown-menu > .dropdown-submenu > .dropdown-menu');
        allSubmenus.forEach(submenu => {
            if (submenu.id !== submenuId) {
                submenu.style.display = 'none';
            }
        });

        // Toggle the clicked submenu
        const submenu = document.getElementById(submenuId);
        submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
    }
</script>
