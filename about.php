<?php 
    include('includes/header.php');
    include('includes/db.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap css begin here -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/_modal.css">
    <!-- Bootstrap css end here -->
    <!-- Font Awesome CSS begin here -->
    <link rel="stylesheet" href="css/all.min.css">
    <!-- Font Awesome CSS end here -->
    <!-- Google fonts begin here -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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
            width: 150px;
            /* height: auto; */
        }
    </style>
</head>

<body>
    <!-- start text banner begin here -->
    <!-- <div class="container-fluid bg-danger txt-banner">
        <div class="row bottom-banner">
            <div class="col-sm">
                <h5>
                    <i class="fas fa-book-open mr-3"></i> 1st standard to 10th standard Complete Grammar Preparation
                </h5>
            </div>
            <div class="col-sm">
                <h5><i class="fa fa-users mr-3"></i>Expert Instructors</h5>
            </div>
            <div class="col-sm">
                <h5><i class="fas fa-keyboard mr-3"></i>Lifetime Access
                </h5>
            </div>
            <div class="col-sm">
                <h5><i class="fas fa-rupee-sign mr-3"></i>Money Worth*
                </h5>
            </div>
        </div>
    </div> -->
    <!-- Start text banner end here -->
 <!-- about us content begin here -->
 <div class="container mt-5">
        <h1 class="text-center">About Us</h1>

<div class="container">
    <div class="row">
        <div class="col-md-6 d-flex align-items-center justify-content-center">
            <img src="./images/winwingrammarsupport.jpg" class="img-fluid" alt="Image 1" style="max-height: 200px;">
        </div>
        <div class="col-md-6">
            <h2>Customized Grammar Support</h2>
            <p>We specialize in providing comprehensive English Grammar guidance tailored to 
                students across various grade levels, from Junior Kindergarten to 10th standard. 
                Our services cater to the needs of both English and Gujarati medium students, 
                ensuring inclusivity and accessibility for all learners. Through our 
                user-friendly website, students can access a wealth of resources including 
                grade-specific video lectures, interactive PowerPoint presentations with 
                accompanying audio, meticulously crafted worksheets for each subject, and 
                downloadable PDFs for all lessons.</p>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-md-6 order-md-2 d-flex align-items-center justify-content-center">
            <img src="./images/accessable.jpg" class="img-fluid" alt="Image 2" style="max-height: 200px;">
        </div>
        <div class="col-md-6 order-md-1">
            <h2>Accessible Resources for All</h2>
            <p>To get started, students simply need to register with their designated user 
                ID corresponding to their specific grade level. Our membership package 
                offers a full year of access to our extensive library of educational materials,
                 all at an affordable cost of only Rs.1000/-. For those seeking additional 
                 support, we also offer personalized online classes, available either on a 
                 one-on-one basis or within a group setting.</p>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-6 d-flex align-items-center justify-content-center">
            <img src="./images/empowering.jpg" class="img-fluid" alt="Image 1" style="max-height: 200px;">
        </div>
        <div class="col-md-6">
            <h2>Empowering English Mastery</h2>
            <p>At the core of our mission is the desire to make learning English Grammar an 
                effortless and enjoyable experience for students. We believe in alleviating 
                the academic pressures often associated with language learning, allowing 
                students to embrace the subject with confidence and enthusiasm. Join us 
                today and embark on a journey towards mastering English Grammar with ease. 
                Best regards, Rajul Sheth.
            </p>
        </div>
    </div>
    <!-- Add more rows with the same structure for other topics -->
    </div>
</div>
    <br>
    <br>
<!-- about us content end here -->
 
<?php 
    include('includes/footer.php');
?>