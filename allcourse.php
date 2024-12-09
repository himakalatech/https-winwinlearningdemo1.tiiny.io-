<?php include ('header.php');
    include 'db.php';
    // Fetch record for the logged-in email

    
    $coursename = $_GET['coursename'] ?? '';
    $email = $_GET['email'] ?? '';
    $contactno = $_GET['contactno'] ?? '';

    // Ensure coursename and email are provided
    if (!empty($coursename) && !empty($email)) {
        $query = "SELECT `name`, `coursename`, `payment`, `contactno`, `email`, `image` FROM `subjects` WHERE WHERE `coursename` = ? AND `email` = ?";
        $result = mysqli_query($con, $query);

        $stmt = mysqli_prepare($con, $query);
        if ($stmt) {
        // Bind parameters
        mysqli_stmt_bind_param($stmt, "ss", $coursename, $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) > 0) {
            $row            = mysqli_fetch_assoc($result); // Fetch a single row as an associative array
            $name           = $row['name'];
            $coursename     = $row["coursename"];
            $payment        = $row['payment']; 
            $contactno      = $row['contactno'];
            $email          = $row['email'];
            $image          = $row["image"];

        } else {
            // Fallback if no record is found
            $name = "No data found for the provided details";
            $coursename = $payment = $contactno = $email = $image = "";
        }
    } else {
        echo "Error preparing the statement: " . mysqli_error($con);
    }
    }else{ // Handle missing parameters
    $name = "Invalid request";
    $coursename = $payment = $contactno = $email = $image = "";}

?>


    <!-- Start Most Popular Course -->
    <div class="container mt-5">
        <!-- <h1 class="text-center">All Courses</h1> -->
        <div class="wrapper slide-custom">
            <h1 class="slide-custom">
                <span>All Courses</span>
                <!-- expands horizontally from 0 width to 100% width -->
            </h1>
        </div>

        <!-- Starting of most popular course 1st card deck -->
        <div class="card-deck mt-4">
            <!-- BEGINING OF BLOCK 2 -->
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
                                href="purchasenew.php?coursename=Phonics&email=<?php echo $email; ?>&contactno=<?php echo $contactno; ?>">
                                ENROLL
                            </a>
                    <a class="btn btn-success text-white font-weight-bolder float" href="demo/phonics.php">Trial</a>
                </div>
            </div>
            </a>
            <!-- END OF BLOCK 2 -->

            <!-- BEGINING OF BLOCK 3 -->
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
                    <!-- <a class="btn btn-danger text-white font-weight-bolder float-right" href="purchasenew.php?coursename=10th CBSE">ENROLL</a> -->
                    <a 
                                class="btn btn-danger text-white font-weight-bolder float-right" 
                                href="purchasenew.php?coursename=Phonics&email=<?php echo $email; ?>&contactno=<?php echo $contactno; ?>">
                                ENROLL
                            </a>
                    <a class="btn btn-success text-white font-weight-bolder float" href="demo/10cbse.php">Trial</a>
                </div>
            </div>
            </a>
            <!-- END OF BLOCK 3 -->
            
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
                    <!-- <a class="btn btn-danger text-white font-weight-bolder float-right" href="purchasenew.php?coursename=10th GSEB">ENROLL</a> -->
                    <a 
                                class="btn btn-danger text-white font-weight-bolder float-right" 
                                href="purchasenew.php?coursename=Phonics&email=<?php echo $email; ?>&contactno=<?php echo $contactno; ?>">
                                ENROLL
                            </a>
                    <a class="btn btn-success text-white font-weight-bolder float" href="demo/10gseb.php">Trial</a>
                </div>
            </div>
            </a>

        </div>
        <!-- end of the most popular course 1st card deck -->
        <!-- begin of the most popular course 2nd card deck -->
        <!-- BLOCK 1 BEGIN HERE -->
        <div class="card-deck mt-4">
            <!-- BLOCK 1 END HERE -->
            <!-- BLOCK 2 BEGIN HERE -->
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
                    <!-- <a class="btn btn-danger text-white font-weight-bolder float-right" href="purchasenew.php?coursename=9th">ENROLL</a> -->
                    <a 
                                class="btn btn-danger text-white font-weight-bolder float-right" 
                                href="purchasenew.php?coursename=Phonics&email=<?php echo $email; ?>&contactno=<?php echo $contactno; ?>">
                                ENROLL
                            </a>
                    <a class="btn btn-success text-white font-weight-bolder float" href="demo/8n9.php">Trial</a>
                </div>
            </div>
            </a>
            <!-- BLOCK 2 END HERE -->
            <!-- BLOCK 3 BEGIN HERE -->
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
                    <!-- <a class="btn btn-danger text-white font-weight-bolder float-right" href="purchasenew.php?coursename=7th">ENROLL</a> -->
                    <a 
                                class="btn btn-danger text-white font-weight-bolder float-right" 
                                href="purchasenew.php?coursename=Phonics&email=<?php echo $email; ?>&contactno=<?php echo $contactno; ?>">
                                ENROLL
                            </a>
                    <a class="btn btn-success text-white font-weight-bolder float" href="demo/6n7.php">Trial</a>
                </div>
            </div>
            </a>
            <!-- BLOCK 3 END HERE --> 
            
            <a href="#" class="btn" style="text-align: left; padding: 0px;"></a>
            <div class="card">
                <img src="./images/course_icons/win_win_learning_5th.png" class="card-img-top" alt="5th grade student enjoying the win win learning english grammar course from their laptop" />
                <div class="card-body">
                    <h5 class="test-slide">5th Grammar</h5>
                    <p class="card-text"></p>
                </div>
                <div class="card-footer">
                    <p class="card-text d-inline"> Price: <small><del>&#8377 1500</del></small>
                        <span class="font-weight-bolder">&#8377 500</span>
                    </p>
                    <!-- <a class="btn btn-danger text-white font-weight-bolder float-right" href="purchasenew.php?coursename=5th">ENROLL</a> -->
                    <a 
                                class="btn btn-danger text-white font-weight-bolder float-right" 
                                href="purchasenew.php?coursename=Phonics&email=<?php echo $email; ?>&contactno=<?php echo $contactno; ?>">
                                ENROLL
                            </a>
                    <a class="btn btn-success text-white font-weight-bolder float" href="demo/5.php">Trial</a>
                </div>
            </div>
            </a>

        </div>


        <!-- begin of the most popular course 3rd card deck -->
        <!-- BLOCK 1 BEGIN HERE -->
        <div class="card-deck mt-4">
            <!-- BLOCK 1 END HERE -->
            <!-- BLOCK 2 BEGIN HERE -->
            <a href="#" class="btn" style="text-align: left; padding: 0px;"></a>
            <div class="card">
                <img src="./images/course_icons/win_win_learning_4th.png" class="card-img-top" alt="win win learning, a kid is learning english grammar using win win learning english grammar session " />
                <div class="card-body">
                    <h5 class="test-slide">4th Grammar</h5>
                    <p class="card-text"></p>
                </div>
                <div class="card-footer">
                    <p class="card-text d-inline"> Price: <small><del>&#8377 1500</del></small>
                        <span class="font-weight-bolder">&#8377 500</span>
                    </p>
                    <!-- <a class="btn btn-danger text-white font-weight-bolder float-right" href="purchasenew.php?coursename=4th">ENROLL</a> -->
                    <a 
                                class="btn btn-danger text-white font-weight-bolder float-right" 
                                href="purchasenew.php?coursename=Phonics&email=<?php echo $email; ?>&contactno=<?php echo $contactno; ?>">
                                ENROLL
                            </a>
                    <a class="btn btn-success text-white font-weight-bolder float" href="demo/4.php">Trial</a>
                </div>
            </div>
            </a>
            <!-- BLOCK 2 END HERE -->
            <!-- BLOCK 3 BEGIN HERE -->
            <a href="#" class="btn" style="text-align: left; padding: 0px;"></a>
            <div class="card">
                <img src="./images/course_icons/win_win_learning_3rd.png" class="card-img-top" alt="a kid of 3rd grade enjoying the learning process, using the win win learning english grammar course" />
                <div class="card-body">
                    <h5 class="test-slide">3rd Grammar</h5>
                    <p class="card-text"></p>
                </div>
                <div class="card-footer">
                    <p class="card-text d-inline"> Price: <small><del>&#8377 1500</del></small>
                        <span class="font-weight-bolder">&#8377 500</span>
                    </p>
                    <!-- <a class="btn btn-danger text-white font-weight-bolder float-right" href="purchasenew.php?coursename=3rd">ENROLL</a> -->
                    <a 
                                class="btn btn-danger text-white font-weight-bolder float-right" 
                                href="purchasenew.php?coursename=Phonics&email=<?php echo $email; ?>&contactno=<?php echo $contactno; ?>">
                                ENROLL
                            </a>
                    <a class="btn btn-success text-white font-weight-bolder float" href="demo/3.php">Trial</a>
                </div>
            </div>
            </a>
            <!-- BLOCK 3 END HERE --> 
            
            <a href="#" class="btn" style="text-align: left; padding: 0px;"></a>
            <div class="card">
                <img src="./images/course_icons/win_win_learning_2nd.png" class="card-img-top" alt="win win learning, used by a kid for the learning of the english grammar" />
                <div class="card-body">
                    <h5 class="test-slide">2nd Gramamr</h5>
                    <p class="card-text"></p>
                </div>
                <div class="card-footer">
                    <p class="card-text d-inline"> Price: <small><del>&#8377 1500</del></small>
                        <span class="font-weight-bolder">&#8377 500</span>
                    </p>
                    <!-- <a class="btn btn-danger text-white font-weight-bolder float-right" href="purchasenew.php?coursename=2nd">ENROLL</a> -->
                    <a 
                                class="btn btn-danger text-white font-weight-bolder float-right" 
                                href="purchasenew.php?coursename=Phonics&email=<?php echo $email; ?>&contactno=<?php echo $contactno; ?>">
                                ENROLL
                            </a>
                    <a class="btn btn-success text-white font-weight-bolder float" href="demo/2.php">Trial</a>
                </div>
            </div>
            </a>
        
        </div>

             <!-- begin of the most popular course 3rd card deck -->
        <!-- BLOCK 1 BEGIN HERE -->
        <div class="card-deck mt-4">
            <!-- BLOCK 1 END HERE -->
            <!-- BLOCK 2 BEGIN HERE -->
            <a href="#" class="btn" style="text-align: left; padding: 0px;"></a>
            <div class="card">
            <!-- <img src="./images/course_icons/win_win_learning_1st.png" class="card-img-top" alt="win win learning english grammar session attend by the the 1st grade student" /> -->
            <img src="./images/course_icons/win_win_learning_1st.png" class="card-img-top" alt="win win learning english grammar session attend by the the 1st grade student" />
            
                <div class="card-body">
                    <h5 class="test-slide">1st Grammar</h5>
                    <p class="card-text"></p>
                </div>
                <div class="card-footer">
                    <p class="card-text d-inline"> Price: <small><del>&#8377 1500</del></small>
                        <span class="font-weight-bolder">&#8377 500</span>
                    </p>
                    <!-- <a class="btn btn-danger text-white font-weight-bolder float-right" href="purchasenew.php?coursename=1st">ENROLL</a> -->
                     <!-- <a class="btn btn-danger text-white font-weight-bolder float-right" href="class/1.php">ENROLL</a> --> 
                    <a 
                                class="btn btn-danger text-white font-weight-bolder float-right" 
                                href="purchasenew.php?coursename=Phonics&email=<?php echo $email; ?>&contactno=<?php echo $contactno; ?>">
                                ENROLL
                            </a>
                    <a class="btn btn-success text-white font-weight-bolder float" href="demo/1.php">Trial</a>
                </div>
            </div>
            </a>
            <!-- BLOCK 2 END HERE -->

            <!-- BEGINING OF BLOCK 1 -->
            <a href="#" class="btn" style="text-align: left; padding: 0px;"></a>
            <div class="card">
                <img src="./images/course_icons/win_win_learning_srkg.png" class="card-img-top" alt="Win-Win Learning Senior Kinder Garten image where a girl is studying grammar using her digital device" />
                <div class="card-body">
                    <h5 class="test-slide">Sr. K.G.</h5>
                    <p class="card-text"></p>
                </div>
                <div class="card-footer">
                    <p class="card-text d-inline"> Price: <small><del>&#8377 1500</del></small>
                        <span class="font-weight-bolder">&#8377 500</span>
                    </p>
                    <!-- <a class="btn btn-danger text-white font-weight-bolder float-right" href="purchasenew.php?coursename=SrKg">ENROLL</a> -->
                    <a 
                                class="btn btn-danger text-white font-weight-bolder float-right" 
                                href="purchasenew.php?coursename=Phonics&email=<?php echo $email; ?>&contactno=<?php echo $contactno; ?>">
                                ENROLL
                            </a>
                    <a class="btn btn-success text-white font-weight-bolder float" href="demo/srkg.php">Trial</a>
                </div>
            </div>
            </a>
            <!-- END OF BLOCK 1 -->

            <!-- BLOCK 3 BEGIN HERE -->
            <a href="#" class="btn" style="text-align: left; padding: 0px;"></a>
            <div class="card">
                <img src="./images/course_icons/win_win_learning_jrkg.png" class="card-img-top" alt="win win learning photo of a kid laughing while enjoy the english grammar course from the win win learning course " />
                <div class="card-body">
                    <h5 class="test-slide">Jr. K.G</h5>
                    <p class="card-text"></p>
                </div>
                <div class="card-footer">
                    <p class="card-text d-inline"> Price: <small><del>&#8377 1500</del></small>
                        <span class="font-weight-bolder">&#8377 500</span>
                    </p>
                    <!-- <a class="btn btn-danger text-white font-weight-bolder float-right" href="purchasenew.php?coursename=JrKg">ENROLL</a> -->
                    <a 
                                class="btn btn-danger text-white font-weight-bolder float-right" 
                                href="purchasenew.php?coursename=Phonics&email=<?php echo $email; ?>&contactno=<?php echo $contactno; ?>">
                                ENROLL
                            </a>
                    <a class="btn btn-success text-white font-weight-bolder float" href="demo/jrkg.php">Trial</a>
                </div>
            </div>
            </a>
            <!-- BLOCK 3 END HERE -->             
        </div>

        <div class="card-deck mt-4">
            <!-- BEGINING OF BLOCK 1 -->
            <a href="#" class="btn" style="text-align: left; padding: 0px;"></a>
            <div class="card">
                <img src="images/course_icons/win_win_learning_gujaratisikho.png" class="card-img-top" alt="Guitar" />
                <div class="card-body">
                    <h5 class="test-slide">Gujarati Sikho</h5>
                    <p class="card-text"></p>
                </div>
                <div class="card-footer">
                    <p class="card-text d-inline"> Price: <small><del>&#8377 1500</del></small>
                        <span class="font-weight-bolder">&#8377 500</span>
                    </p>
                    <!-- <a class="btn btn-danger text-white font-weight-bolder float-right" href="purchasenew.php?coursename=Gujaratisikho">ENROLL</a> -->
                    <a 
                                class="btn btn-danger text-white font-weight-bolder float-right" 
                                href="purchasenew.php?coursename=Phonics&email=<?php echo $email; ?>&contactno=<?php echo $contactno; ?>">
                                ENROLL
                            </a>
                    <a class="btn btn-success text-white font-weight-bolder float" href="demo/gujaratisikho.php">Trial</a>
                </div>
            </div>
            </a>
            <!-- END OF BLOCK 1 -->

            <div class="card" style="border: none"></div>
            <div class="card" style="border: none"></div>
        </div>
    </div>
    <br>
    
    <!-- ned of the most popular course 3rd card deck -->
   
    <!-- End Most Popular Course -->
 
 <?php 
    include('includes/footer.php');
?>