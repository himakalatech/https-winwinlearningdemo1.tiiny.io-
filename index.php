<?php 
    session_start();
    //include('includes/header.php');
    include('includes/db.php');

    include(__DIR__ . 'includes/header.php');
    include(__DIR__ . 'includes/db.php');
    include(__DIR__ . 'includes/footer.php');
    

    if (file_exists('includes/header.php')) {
        include('includes/header.php');
    } else {
        echo "Header file not found.";
    }

    // Check if there's a success message to display
    if (isset($_SESSION['message'])) {
        //echo "<div class='alert-success'>" . $_SESSION['message'] . "</div>";
        unset($_SESSION['message']); // Clear the message after displaying it
    }
   

    $coursename = $_GET['coursename'] ?? '';
    $email = $_GET['email'] ?? '';
    $contactno = $_GET['contactno'] ?? '';

    // Query to fetch data
    $query = "SELECT `Id`, `Name`,`detail`, `detail1`, `detail2`, `detail3`, `SubNm1`, `SubNm2`, `SubNm3`, `img1`, `img2`, `img3`, `img4` FROM `about` WHERE 1";
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
        $detail  = $row['detail']; 

    } else {
        $Name = "About Us";
        $SubNm1 = "Data not found"; // Display a fallback message if no data is available
    }

    // Limit detail to a short preview (approx. 2 lines)
    $shortDetail1 = substr($SubNm1, 0, 100) . '...';
    $shortDetail2 = substr($SubNm2, 0, 100) . '...';
    $shortDetail3 = substr($SubNm3, 0, 100) . '...';

?>

<style>

    h4 {
            font-size: 1.5em;
            font-family: serif;
            color: transparent;
            text-align: center;
            animation: effect 2s linear infinite;
        }
        
 
        @keyframes effect {
            0% {
                background: linear-gradient(#008000, #00FF00);
                -webkit-background-clip: text;
            }
 
            100% {
                background: linear-gradient(#3CE7D7, #000FFF);
                -webkit-background-clip: text;
            }
        }
</style>

    <!-- Win Win Learning Events -->
    <svg viewbox="0 0 100 10">
        <defs>
            <linearGradient id="gradient">
            <stop color="#000"/>
            </linearGradient>
            <pattern id="wave" x="0" y="-0.5" width="100%" height="100%" patternUnits="userSpaceOnUse">
            <path id="wavePath" d="M-40 9 Q-30 7 -20 9 T0 9 T20 9 T40 9 T60 9 T80 9 T100 9 T120 9 V20 H-40z" mask="url(#mask)" fill="url(#gradient)"> 
                <animateTransform
                    attributeName="transform"
                    begin="0s"
                    dur="1.5s"
                    type="translate"
                    from="0,0"
                    to="40,0"
                    repeatCount="indefinite" />
            </path>
            </pattern>
        </defs>
        <text text-anchor="middle" x="50" y="10" font-size="10" fill="gray" fill-opacity="20">Win Win Learning</text>
        <text text-anchor="middle" x="50" y="10" font-size="10" fill="url(#wave)"  fill-opacity="15">Win Win Learning</text>
    </svg>

    <!-- about us content begin here -->
    <div class="container mt-5" text-center>
            <!-- <h1 class="text-center"><?php echo $Name; ?></h1> -->
            <div class="wrapper slide-custom">
                <h1 class="slide-custom">
                    <span><?php echo $Name; ?></span>
                    <!-- expands horizontally from 0 width to 100% width -->
                </h1>
            </div>
        </div>
        <div class="container">
            <hr>
            <div class="row">
                <!-- <div class="col-md-6 d-flex align-items-center justify-content-center">
                <!-- <img src="./images/winwingrammarsupport.jpg" class="img-fluid" alt="Image 1" style="max-height: 200px;"> --
                <img src="./images/<?php echo $img1 ?>" class="img-fluid" alt="Image 1" style="max-height: 200px;">
                </div> -->
                <div class="col-md-6 d-flex align-items-center justify-content-center">
                    <video class="d-block w-80" autoplay muted loop playsinline>
                                <source src="./images/animation/winwingrammarsupport.mp4" type="video/mp4">
                                <source src="./images/animation/winwingrammarsupport.webm" type="video/webm">
                                Your browser does not support the video tag.
                            </video>
                </div>  
                <div class="col-md-6">
                    <h2><?php echo $detail1; ?></h2>
                    <p><?php echo $shortDetail1; ?></p>
                    <a class="btn btn-primary text-white font-weight-bolder" href="aboutus.php"><?php echo $detail; ?></a>
                </div>

        </div>
        <div class="row mt-5">
            
            <div class="col-md-6 order-md-1">
                <h2><?php echo $detail2; ?></h2>
                <!-- <p>?php echo $SubNm2; ?></p> -->
                <p><?php echo $shortDetail2; ?></p>
                <a class="btn btn-primary text-white font-weight-bolder" href="aboutus.php"><?php echo $detail; ?></a>
            </div>
            <div class="col-md-6 order-md-2 d-flex align-items-center justify-content-center">
            <!-- <img src="./images/accessable.jpg" class="img-fluid" alt="Image 2" style="max-height: 200px;"> -->
                            <video class="d-block w-80" autoplay muted loop playsinline>
                                <source src="./images/animation/accessable.mp4" type="video/mp4">
                                <source src="./images/animation/accessable.webm" type="video/webm">
                                Your browser does not support the video tag.
                            </video>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-6 d-flex align-items-center justify-content-center">
            <!-- <img src="./images/empowering.jpg" class="img-fluid" alt="Image 1" style="max-height: 200px;"> -->
            <video class="d-block w-80" autoplay muted loop playsinline>
                                <source src="./images/animation/empowering.mp4" type="video/mp4">
                                <source src="./images/animation/empowering.webm" type="video/webm">
                                Your browser does not support the video tag.
                            </video>
            </div>
            <div class="col-md-6">
                <h2><?php echo $detail3; ?></h2>
                <!-- <p>?php echo $SubNm3; ?></p> -->
                <p><?php echo $shortDetail3; ?></p>
                <a class="btn btn-primary text-white font-weight-bolder" href="aboutus.php"><?php echo $detail; ?></a>
            </div>
        </div>
        </div>
    </div>
    <br>


<!-- about us content end here -->
    <!-- <div class="text-center m-2">
            <a class="btn btn-pink text-white font-weight-bolder" href="aboutus.php">?php echo $detail ?> </a>
    </div>
</div>
    <br> -->


    <!-- Start Most Popular Course -->
    <div class="container mt-5">
        <!-- <h1 class="text-center" data-text="Our Course">Our Course</h1> -->
        <div class="wrapper slide-custom">
            <h1 class="slide-custom">
                <span>Our Course</span>
                <!-- expands horizontally from 0 width to 100% width -->
            </h1>
        </div>

        <hr>
<?php
    // Fetch record for the logged-in email
    $loggedInEmail = $email;
    if ($loggedInEmail) {
        $query = "SELECT * FROM subjects WHERE email = ?";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "s", $loggedInEmail);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $editData = mysqli_fetch_assoc($result);
        //$selectedCourses = explode(", ", $editData['coursename'] ?? "");
    }

    // Pre-fill variables
    $name = $editData['name'] ?? '';
    $password = $editData['password'] ?? '';
    $sclname = $editData['sclname'] ?? '';
    $sclcity = $editData['sclcity'] ?? '';
    $address = $editData['address'] ?? '';
    $city = $editData['city'] ?? '';
    $pincode = $editData['pincode'] ?? '';
    $gender = $editData['gender'] ?? '';
    $selectedCourses = explode(", ", $editData['coursename'] ?? '');
    $payment = $editData['payment'] ?? '';
?>
        <!-- Starting of most popular course 1st card deck -->
        <div class="card-deck mt-4">
             <!-- BEGINING OF BLOCK 1 -->
                <a href="#" class="btn" style="text-align: left; padding: 0px;"></a>
                    <div class="card">
                        <img src="images/course_icons/win_win_learning_gujaratisikho.png " class="card-img-top" alt="Guitar" />
                        <div class="card-body">
                            <!-- <h5 class="card-title">Gujarati Sikho</h5> -->
                            <h5 class="test-slide">Gujarati Sikho</h5>
                            <p class="card-text"></p>
                        </div>
                        <div class="card-footer">
                            <p class="card-text d-inline"> Price: <small><del>&#8377 1500</del></small>
                                <span class="font-weight-bolder">&#8377 500</span>
                            </p>
                            <!-- <a class="btn btn-danger text-white font-weight-bolder float-right" href="#">ENROLL</a> -->
                            <!-- <a class="btn btn-danger text-white font-weight-bolder float-right" href="purchasenew.php?coursename=Gujaratisikho">ENROLL</a> -->
                            <a 
                                class="btn btn-danger text-white font-weight-bolder float-right" 
                                href="purchasenew.php?coursename=Phonics&email=<?= urlencode($_SESSION['email'] ?? '') ?>&contactno=<?= urlencode($_SESSION['contactno'] ?? '') ?>">
                                ENROLL
                            </a>
                            <a class="btn btn-success text-white font-weight-bolder float" href="demo/gujaratisikho.php">Trial</a>
                        </div>
                    </div>
                </a>
            <!-- END OF BLOCK 1 -->

             <!-- BLOCK 2 BEGIN HERE -->
             <a href="#" class="btn" style="text-align: left; padding: 0px;"></a>
                    <div class="card">
                    <img src="./images/course_icons/win_win_learning_6n7.png" class="card-img-top" alt="6th standard online grammar, student is studying online using win win english grammar learning" />
                        <div class="card-body">
                        <h5 class="test-slide">6th & 7th Grammar</h5>
                            <p class="card-text"></p>
                        </div>
                        <div class="card-footer">
                            <p class="card-text d-inline"> Price: <small><del>&#8377 1500</del></small>
                                <span class="font-weight-bolder">&#8377 500</span>
                            </p>
                            <!-- <a class="btn btn-danger text-white font-weight-bolder float-right" href="purchasenew.php?coursename=7">ENROLL</a> -->
                             <!-- ENROLL BUTTON WITH SESSION VARIABLES -->
                            <a 
                                class="btn btn-danger text-white font-weight-bolder float-right" 
                                href="purchasenew.php?coursename=Phonics&email=<?= urlencode($_SESSION['email'] ?? '') ?>&contactno=<?= urlencode($_SESSION['contactno'] ?? '') ?>">
                                ENROLL
                            </a>
                            <a class="btn btn-success text-white font-weight-bolder float" href="demo/6n7.php">Trial</a>
                        </div>
                    </div>
                </a>
            <!-- BLOCK 2 END HERE -->
            <!-- BLOCK 3 BEGIN HERE -->
                <a href="#" class="btn" style="text-align: left; padding: 0px;"></a>
                    <div class="card">
                    <img src="./images/course_icons/win_win_learning_8n9.png" class="card-img-top" alt="a student taking a notes of english grammer, while using win win learning online english grammar session" />
                        <div class="card-body">
                            <h5 class="test-slide">8th & 9th Grammar</h5>
                            <p class="card-text"></p>
                        </div>
                        <div class="card-footer">
                            <p class="card-text d-inline"> Price: <small><del>&#8377 1500</del></small>
                                <span class="font-weight-bolder">&#8377 500</span>
                            </p>
                            <!-- <a class="btn btn-danger text-white font-weight-bolder float-right" href="purchasenew.php?coursename=8n9">ENROLL</a> -->
                            <a 
                                class="btn btn-danger text-white font-weight-bolder float-right" 
                                href="purchasenew.php?coursename=Phonics&email=<?= urlencode($_SESSION['email'] ?? '') ?>&contactno=<?= urlencode($_SESSION['contactno'] ?? '') ?>">
                                ENROLL
                            </a>
                            <a class="btn btn-success text-white font-weight-bolder float" href="demo/8n9.php">Trial</a>
                        </div>
                    </div>
                </a>
            <!-- BLOCK 3 END HERE -->  
           
        </div>
        <!-- end of the most popular course 1st card deck -->
        <!-- begin of the most popular course 2nd card deck -->
        <!-- BLOCK 1 BEGIN HERE -->
        <div class="card-deck mt-4">

            <!-- BEGINING OF BLOCK 1 -->
                <a href="#" class="btn" style="text-align: left; padding: 0px;"></a>
                    <div class="card">
                    <img src="./images/course_icons/win_win_learning_10gseb.png" class="card-img-top" alt="student is enjoying the live session of the english grammar provided by the win win learning online" />
                        <div class="card-body">
                            <h5 class="test-slide">10th GSEB</h5>
                            <p class="card-text"></p>
                        </div>
                        <div class="card-footer">
                            <p class="card-text d-inline"> Price: <small><del>&#8377 1500</del></small>
                                <span class="font-weight-bolder">&#8377 500</span>
                            </p>
                            <!-- <a class="btn btn-danger text-white font-weight-bolder float-right" href="purchasenew.php?coursename=10gseb">ENROLL</a> -->
                            <a 
                                class="btn btn-danger text-white font-weight-bolder float-right" 
                                href="purchasenew.php?coursename=Phonics&email=<?= urlencode($_SESSION['email'] ?? '') ?>&contactno=<?= urlencode($_SESSION['contactno'] ?? '') ?>">
                                ENROLL
                            </a>
                            <a class="btn btn-success text-white font-weight-bolder float" href="demo/10gseb.php">Trial</a>
                        </div>
                    </div>
                </a>
            <!-- BLOCK 1 END HERE -->
             
        
            <!-- BEGINING OF BLOCK 2 -->
                <a href="#" class="btn" style="text-align: left; padding: 0px;"></a>
                    <div class="card">
                    <img src="./images/course_icons/win_win_learning_10cbse.png" class="card-img-top" alt="win-win learning a student is creating grammar notes while studying online" />
                        <div class="card-body">
                            <h5 class="test-slide">10th CBSE</h5>
                            <p class="card-text"></p>
                        </div>
                        <div class="card-footer">
                            <p class="card-text d-inline"> Price: <small><del>&#8377 1500</del></small>
                                <span class="font-weight-bolder">&#8377 500</span>
                            </p>
                            <!-- <a class="btn btn-danger text-white font-weight-bolder float-right" href="purchasenew.php?coursename=10cbse">ENROLL</a> -->
                            <a 
                                class="btn btn-danger text-white font-weight-bolder float-right" 
                                href="purchasenew.php?coursename=Phonics&email=<?= urlencode($_SESSION['email'] ?? '') ?>&contactno=<?= urlencode($_SESSION['contactno'] ?? '') ?>">
                                ENROLL
                            </a>
                            <a class="btn btn-success text-white font-weight-bolder float" href="demo/10cbse.php">Trial</a>
                        </div>
                    </div>
                </a>
            <!-- END OF BLOCK 2 -->

 

            <!-- BEGINING OF BLOCK 3 -->
                <a href="#" class="btn" style="text-align: left; padding: 0px;"></a>
                    <div class="card">
                    <img src="./images/course_icons/win_win_learning_phonics.png" class="card-img-top" alt="Win-Win Learning a girl is stydying online using her laptop, and ejoying the session of grammar" />
                        <div class="card-body">
                            <h5 class="test-slide">Phonics</h5>
                            <p class="card-text"></p>
                        </div>
                        <div class="card-footer">
                            <p class="card-text d-inline"> Price: <small><del>&#8377 1500</del></small>
                                <span class="font-weight-bolder">&#8377 500</span>
                            </p>
                            <!-- <a class="btn btn-danger text-white font-weight-bolder float-right" href="purchasenew.php?coursename=Phonics">ENROLL</a> -->
                            <a 
                                class="btn btn-danger text-white font-weight-bolder float-right" 
                                href="purchasenew.php?coursename=Phonics&email=<?= urlencode($_SESSION['email'] ?? '') ?>&contactno=<?= urlencode($_SESSION['contactno'] ?? '') ?>">
                                ENROLL
                            </a>

                            <a class="btn btn-success text-white font-weight-bolder float" href="demo/phonics.php">Trial</a>
                        </div>
                    </div>
                </a>
            <!-- END OF BLOCK 3 -->
        </div>
        <br>
        <div class="text-center m-2">
            <a class="btn btn-primary text-white font-weight-bolder" href="allcourse.php">View All Course</a>
        </div>
    </div>
    <!-- ned of the most popular course 2nd card deck -->
   
    <!-- End Most Popular Course -->

    <br>
    
    <?php
//session_start(); // Ensure session is started for session variables
// include('includes/header.php'); 
// include 'db.php'; 
//ob_start();

// Check if there's a success message to display
if (isset($_SESSION['message'])) {
    echo "<div class='alert-success'>" . $_SESSION['message'] . "</div>";
    unset($_SESSION['message']); // Clear the message after displaying it
}

// Query to fetch data from the `contact` table
$query = "SELECT `Id`, `heading`, `name`, `email`, `contactno`, `image`, `CrDt`, `UpDt`, `subject`, `message`, `title` FROM `contact` LIMIT 1";

$result = mysqli_query($con, $query);

if ($result && mysqli_num_rows($result) > 0) {
   $row = mysqli_fetch_assoc($result);
   $name = $row['name'] ?? "Title not available";
   $heading = $row['heading'] ?? "Heading Name not available";
   $email = $row['email'] ?? "email not available";
   $contactno = $row['contactno'] ?? "contactno not available";
   $subject = $row['subject'] ?? "subject not available";
   $message = $row['message'] ?? "message not available";
}
// Validating required fields and ensuring contact number is valid length (e.g., 10 digits)
if (!empty($name) && !empty($email) && !empty($contactno) && strlen($contactno) == 10 && !empty($message)) {

    // Checking if contact number already exists
    $checkQuery = "SELECT id FROM contact WHERE contactno = ?";
    $checkStmt = mysqli_prepare($con, $checkQuery);
    mysqli_stmt_bind_param($checkStmt, "s", $contactnumber);
    mysqli_stmt_execute($checkStmt);
    mysqli_stmt_store_result($checkStmt);

    if (mysqli_stmt_num_rows($checkStmt) > 0) {
         $insertQuery = "INSERT INTO contact (name, email, contactno, subject, message, CrDt) VALUES (?, ?, ?, ?, ?, NOW())";
        $insertStmt  = mysqli_prepare($con, $insertQuery);
        mysqli_stmt_bind_param($insertStmt, "ssssssssssss",$name, $email, $contactnumber, $subject, $message);
        $result = mysqli_stmt_execute($insertStmt);
        mysqli_stmt_close($insertStmt);

        if ($result) {
            echo "<script>alert('Successfully Contacted');</script>";
        } else {
            echo "<script>alert('Failed to Contact. Please try again.');</script>";
        }
    }

    mysqli_stmt_close($checkStmt);

    } else {
        echo "<script>alert('Please enter valid information in all fields');</script>";
    }
    mysqli_close($con);
?>

    <!-- START OF CONTACT US -->
    <div class="container mt-4" id="Contact">
        <!-- Start Contact Us Container -->
        <!--<h2 class="text-center mb-4">Contact Us</h2> Contact Us Heading -->
        <div class="wrapper slide-custom">
            <h1 class="slide-custom">
                <span>Contact Us</span>
                <!-- expands horizontally from 0 width to 100% width -->
            </h1>
        </div>
        <hr>

        <!-- Start Contact Us Row -->
        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <!-- Start contact us 1st Column -->
                <!-- <form action="contact.php" target="_blank" method="post"> -->
                <form action="inquiry.php" target="_blank" method="post">
                    <input type="text" class="form-control" name="name" placeholder="Name" required> <br>
                    <input type="email" class="form-control" name="email" placeholder="E-mail" required><br>
                    <input type="number" placeholder="Enter your number" name="contactno" required maxlength="10" class="form-control"><br>
                    <input type="text" class="form-control" name="subject" placeholder="Subject" required> <br>
                    <textarea class="form-control" name="message" placeholder="How can we help you?"
                        style="height: 15rem;"></textarea><br>
                    <input class="btn btn-success text-white font-weight-bolder" type="submit" value="Send" name="submit" style="width:100px;"> <br><br>
                </form>

            
            </div>

            <!-- END CONTACT US 1ST COLUMN -->
            <!-- <div class="col-md-4 stripe text-white text-center">

                <!-- START CONTACT US 2ND COLUMN --
                <h4>Need a hand with English grammar?</h4>
                <p>English grammar help from KG to 10th grade! 
                    Questions? Just ask in the form. Easy 
                    learning awaits!</p>
            </div>  -->


            <!-- End contact us 2nd column -->
        </div> <!-- End contact us Row -->
    </div>
    <!-- END OF CONTACT US -->

    <!-- Start Students Testimonial -->
    <!-- Reviews by Students -->
    <!-- <div id="makeitfull">
        <a href="#review_section"><img src="images/img4.jpeg"></a>
    </div>
    <div class="review">
        <div class="diffSection" id="review_section">
            <center>
                <p style="font-size: 40px; padding: 100px; padding-bottom: 40px; color: #2E3D49;">Parents Reviews</p>
            </center>
        </div>
        <div class="rev-container">
            <div class="rev-card">
                <div class="identity">
                    <img src="images/img3.jpeg">
                    <p>Sophie Daniel</p>
                    <h6>Java</h6>
                    <div class="rating"><img src="images/star.png"><img src="images/star.png"><img
                            src="images/star.png"><img src="images/star.png"><img src="images/star.png">
                    </div>
                </div>
                <div class="rev-cont">
                    <p id="title">Review:</p>
                    I did Java Fundamenetal course with Rishab Sir. It was a great experience. The brain teasers and
                    assignments, actually the whole lot of content was really good. Some problems were challenging yet
                    interesting. Was explained very well where ever I stuck...
                    </p>
                </div>
            </div>
            <div class="rev-card">
                <div class="identity">
                    <img src="images/img2.jpeg">
                    <p>Clayton Clair</p>
                    <h6>C/C++</h6>
                    <div class="rating"><img src="images/star.png"><img src="images/star.png"><img
                            src="images/star.png"><img src="images/star.png"><img src="images/star.png"></div>
                </div>
                <div class="rev-cont"> <p id="title">Review:</p>
                    <p id="content">
                        When I was watching "Dear Zindagi", I could relate Sharukh Khan to Arnav Bhaiya. The way Sharukh
                        Khan was giving life lessons to Alia Bhatt, in the same way Arnav Bhaiya will give coding life
                        lessons which will guide you throughout your code life...
                    </p>
                </div>
            </div>               
            
        </div>
    </div> -->
    <!-- End of Students Testimonial -->

<?php 
    include('includes/footer.php');
?>