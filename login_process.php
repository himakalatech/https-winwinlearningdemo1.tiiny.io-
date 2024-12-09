<?php
//ob_start();
session_start();
include("db.php");

if($_SERVER['REQUEST_METHOD'] == "POST") {
   $email      = $_POST['email'];
   $password   = $_POST['password'];
   
   if(!empty($email) && !empty($password) && !is_numeric($email)) {
       //$query = "SELECT * FROM registerdata WHERE email = '$email' LIMIT 1";
       if ($email == "admin@123") {
          $stmt = $con->prepare("SELECT * FROM admin_login WHERE email = ?");
      } else {
          $stmt = $con->prepare("SELECT * FROM registerdata WHERE email = ?");
      }

       //$result = mysqli_query($con, $query);
       $stmt->bind_param("s", $email); // "s" means the database expects a string
        $stmt->execute();
        $result = $stmt->get_result();
       
       if($result && mysqli_num_rows($result) > 0) {
           $user_data = mysqli_fetch_assoc($result);
           
           if($user_data['password'] == $password) {
               // Store user ID and course in session
               $_SESSION['email'] = $user_data['id'];
               $_SESSION['course'] = $user_data['course']; // Assuming 'course' is the column name in the database for the user's course
               $course = $_SESSION['course']; // Get the user's course
               switch ($course) {

                  case 'gujaratisikho':
                     header("Location: ./class/gujaratisikho.php");
                     exit();
                     break;
                  case 'phonics':
                     header("Location: ./class/phonics.php");
                     exit();
                     break;

                   case '10th CBSE':
                       header("Location: ./class/10cbse.php");
                       exit();
                       break;
                   case '10th GSEB':
                        header("Location: ./class/10gseb.php");
                        break;
                   case '9th':
                        header("Location: ./class/8n9.php");
                        break;
                   case '8th':
                        header("Location: ./class/8n9.php");
                        break;
                   case '7th':
                        header("Location: ./class/7.php");
                        break;
                  //  case '6th':
                  //       header("Location: ./class/7.php");
                  //       break;
                   case '5th':
                        header("Location: ./class/5.php");
                        break;
                   case '4th':
                        header("Location: ./class/4.php");
                        break;
                   case '3rd':
                        header("Location: ./class/3.php");
                        break;
                   case '2nd':
                        header("Location: ./class/2.php");
                        break;
                   case '1st':
                        header("Location: ./class/1.php");
                        break;
                       
                   case 'srkg':
                        header("Location: ./class/srkg.php");
                        break;

                   case 'jrkg':
                        header("Location: ./class/jrkg.php");
                        break;
                   // Add more cases for other courses if needed
                   default:
                       header("Location: home.php"); // Redirect to a default page if the course is not recognized
                       break;
               }
               exit;
           }
       }
       
       echo "<script type='text/javascript'> alert('Wrong username or password')</script>";
   } else { 
       echo "<script type='text/javascript'> alert('Please enter valid email and password')</script>";
   }
}
ob_end_flush();

// Fetching user data after login
$user_name = '';
$user_image = '';
if(isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    //$query = "SELECT name, image FROM data WHERE id = $user_id";
    $query = "SELECT name, image FROM registerdata WHERE id = $email";
    $result = mysqli_query($con, $query);
    if($result && mysqli_num_rows($result) > 0) {
        $user_info = mysqli_fetch_assoc($result);
        $user_name = $user_info['name'];
        $user_image = $user_info['image'];
    }
}
?>