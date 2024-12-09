<?php 
include ('header_login.php');
include 'db.php';  

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Include your database connection file
  
    // Handle file upload
    $image = $_FILES['image']['name'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder   = '../uploaded_img/' . $image;
    // Retrieve other form data
    $firstname      = $_POST['name'];
    $fathername     = $_POST['fname'];
    $surname        = $_POST['lname'];
    $gender         = $_POST['gender'];
    $course         = $_POST['standard']; // Assuming 'standard' corresponds to the course
    $contactnumber  = $_POST['contactno'];
    $email          = $_POST['email'];    
    $schoolname     = $_POST['sclname'];
    $schoolcity     = $_POST['sclcity'];
    $address        = $_POST['address'];
    $password       = $_POST['password'];
    
    // Checking if all required fields are filled and valid
    if (!empty($firstname) && !empty($fathername) && !empty($surname) && !empty($gender) && !empty($course) && 
    !empty($contactnumber) && !empty($email) && !empty($schoolname) && !empty($schoolcity) && !empty($address) && !empty($password)) {
        // Move uploaded image to destination folder
        move_uploaded_file($image_tmp_name, $image_folder);
        // Inserting data into the database using prepared statement to prevent SQL injection
        $query = "INSERT INTO registerdata (image, name, fname, lname, gender, course, contactno, email, address, password, sclname, sclcity,CrDt) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,Now())";
        // Prepare the SQL statement
        $stmt = mysqli_prepare($con, $query);
        // Bind parameters
        mysqli_stmt_bind_param($stmt, "ssssssssssss", $image_folder, $firstname, $fathername, $surname, $gender, $course, $contactnumber, $email, $address, $password, $schoolname, $schoolcity);
        // Execute the statement
        mysqli_stmt_execute($stmt);
        // Check if the query was successful
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "<script type='text/javascript'> alert('Successfully Registered')</script>";
        } else {
            echo "<script type='text/javascript'> alert('Failed to register. Please try again.')</script>";
        }
        // Close statement
        mysqli_stmt_close($stmt);

    } else {
        echo "<script type='text/javascript'> alert('Please enter valid information in all fields')</script>";
    }
    // Close database connection
    mysqli_close($con);
}
?>


<div class="side-bar">
   <div id="close-btn">
      <i class="fas fa-times"></i>
   </div>
   
   <nav class="navbar">
            <div class="profile">
                <?php if(!empty($user_name) && !empty($user_image)): ?>
                <img src="./<?php echo $user_image; ?>" class="image" alt="Profile Picture">
                <h3 class="name"><?php echo $user_name; ?></h3>
                <?php else: ?>
                <img src="./images/img1.jpeg" class="image" alt="Profile Picture">
                <h3 class="name">Guest</h3>
                <?php endif; ?>
                <!-- redirection to the form where all the payment and registration process will happen -->
                <a href="register.php" class="btn">Register</a>
            </div>
            <div class="navbar">
            <a href=""><i class="fas fa-home"></i><span>Home</span></a>
            <a href="../e-edu/courses.php" class="popup-trigger"><i class="fas fa-graduation-cap"></i><span>Courses</span></a>
            <a href="../e-edu/purchase.php" class="popup-trigger"><i class="fa-solid fa-cart-plus"></i><span>Purchase Course</span></a>
            <a href="../e-edu/aboutus.php" class="popup-trigger"><i class="fas fa-question"></i><span>About</span></a>
            <a href="../e-edu/contact.php" class="popup-trigger"><i class="fas fa-headset"></i><span>Contact Us</span></a>
        </div>
    </nav>
</div>

<section class="form-container">
    <form name="myForm" action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
        <h3>Register Now</h3>
        <p>Insert Your Image <span>*</span></p>
        <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png">
        <p>First Name <span>*</span></p>
        <input type="text" name="name" placeholder="Enter your name" required maxlength="50" class="box">
        <p>Father Name <span>*</span></p>
        <input type="text" name="fname" placeholder="Enter your name" required maxlength="50" class="box">
        <p>Surname Name <span>*</span></p>
        <input type="text" name="lname" placeholder="Enter your name" required maxlength="50" class="box">
        <p>Gender <span>*</span></p>
        <select name="gender" class="box">
            <option value="">Select Gender</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="no">Rather Not Say</option>
        </select>
        <p>Standard <span>*</span></p>
        <select name="standard" class="box"> <!-- Changed from grade to standard -->
            <option value="select">Select Standard</option>
            <option value="gujaratisikho">Gujarati Sikho</option>
            <option value="phonics">Phonics</option>
            <option value="10th GSEB">10th GSEB</option>
            <option value="10th CBSE">10th CBSE</option>
            <option value="9th">9th & 8th Standard</option>
            <!-- <option value="8th">8th Standard</option> -->
            <option value="7th">7th & 6th Standard</option>
            <!-- <option value="6th">6th Standard</option> -->
            <option value="5th">5th Standard</option>
            <option value="4th">4th Standard</option>
            <option value="3rd">3rd Standard</option>
            <option value="2nd">2nd Standard</option>
            <option value="1st">1st Standard</option>
            <option value="srkg">Sr.K.G</option>
            <option value="jrkg">Jr.K.G</option>
        </select>
        <p>Contact Number <span>*</span></p>
        <input type="tel" name="contactno" placeholder="Enter your contact number" required maxlength="10" class="box">
        
        <p>Email <span>*</span></p>
        <input type="email" name="email" placeholder="Enter your email" required maxlength="50" class="box">
        <p>School Name <span>*</span></p>
        <input type="name" name="sclname" placeholder="Enter your School Name" required maxlength="50" class="box">
        <p>School City <span>*</span></p>
        <input type="city" name="sclcity" placeholder="Enter your School City" required maxlength="50" class="box">     
        <p>Address <span>*</span></p>
        <input type="text" name="address" placeholder="Enter your address" required maxlength="50" class="box">
        <p>Password <span>*</span></p>
        <input type="password" name="password" placeholder="Enter your password" required maxlength="20" class="box">
        <p>Confirm Your Password <span>*</span></p>
        <input type="password" name="cpassword" placeholder="Confirm your password" required maxlength="20" class="box">
        <input type="submit" value="Submit" name="submit" class="btn">  
        
    </form>
</section>

<?php include ('footer_login.php')?>
