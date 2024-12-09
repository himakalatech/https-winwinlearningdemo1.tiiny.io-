<?php 
    session_start();
    include ('header.php');
    include 'db.php';

    // Check if there's a success message to display
    if (isset($_SESSION['message'])) {
        echo "<div class='alert-success'>" . $_SESSION['message'] . "</div>";
        unset($_SESSION['message']); // Clear the message after displaying it
    }


    // if(isset($_SESSION['email'])) {
    //     $email = $_SESSION['email'];
    //     //$query = "SELECT name, image FROM data WHERE id = $email";
    //     if ($email == "admin@123") {
    //         $stmt = $con->prepare("SELECT * FROM admin_login WHERE email = ?");
    //     } else {
    //         $stmt = $con->prepare("SELECT * FROM registerdata WHERE email = ?");
    //     }
    //     $result = mysqli_query($con, $query);
    //     if($result && mysqli_num_rows($result) > 0) {
    //         $user_info = mysqli_fetch_assoc($result);
    //         $user_name = $user_info['name'];
    //         $user_image = $user_info['image'];
    //     }
    // }

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

    } else {
        $detail1 = "Data not found"; // Display a fallback message if no data is available
    }
?>

 <!-- about us content begin here -->
 <div class="container mt-5">
        <!-- <h1 class="text-center">?php echo $Name; ?></h1> -->
    <div class="wrapper slide-custom">
        <h1 class="slide-custom">
            <span><?php echo $Name; ?></span>
            <!-- expands horizontally from 0 width to 100% width -->
        </h1>
    </div>

    <div class="container">
        <hr>
        <div class="row">
            <div class="col-md-6 d-flex align-items-center justify-content-center">
            <!-- <img src="./images/winwingrammarsupport.jpg" class="img-fluid" alt="Image 1" style="max-height: 200px;"> -->
                <!-- <img src="./images/?php echo $img1 ?>" class="img-fluid" alt="Image 1" style="max-height: 200px;"> -->
                <video class="d-block w-80" autoplay muted loop playsinline>
                                    <source src="./images/animation/winwingrammarsupport.mp4" type="video/mp4">
                                    <source src="./images/animation/winwingrammarsupport.webm" type="video/webm">
                                    Your browser does not support the video tag.
                                </video>
            </div>
            <div class="col-md-6">
                <h2><?php echo $detail1; ?></h2>
                <p><?php echo $SubNm1; ?></p>
            </div>
    </div>
    <div class="row mt-5">
        <!-- <div class="col-md-6 order-md-2 d-flex align-items-center justify-content-center">
        <!-- <img src="./images/accessable.jpg" class="img-fluid" alt="Image 2" style="max-height: 200px;"> --
        <img src="./images/?php echo $img2 ?>" class="img-fluid" alt="Image 2" style="max-height: 200px;">
        </div> -->
        <div class="col-md-6 order-md-1">
            <h2><?php echo $detail2; ?></h2>
            <p><?php echo $SubNm2; ?></p>
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
        <!-- <div class="col-md-6 d-flex align-items-center justify-content-center">
        <!-- <img src="./images/empowering.jpg" class="img-fluid" alt="Image 1" style="max-height: 200px;"> --
        <img src="./images/<?php echo $img3 ?>" class="img-fluid" alt="Image 3" style="max-height: 200px;">
        </div> -->

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
            <p><?php echo $SubNm3; ?></p>
        </div>
    </div>
    </div>
</div>
    <br>
    <br>
<!-- about us content end here -->

<?php 
    include('includes/footer.php');
?>