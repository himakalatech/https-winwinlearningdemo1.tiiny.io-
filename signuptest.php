<?php
session_start();
include("db.php");
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $firstname = $_POST['name'];
    $fathername = $_POST['fname'];
    $surname = $_POST['lname'];
    $contactnumber = $_POST['cnum'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $password = $_POST['pass'];

    if(!empty($email) && !empty($password) && !is_numeric($email))
    {
        $query = "insert into data (name, fname, lname, contactno, email, address, password) values('$firstname','$fathername','$surname','$contactnumber','$email','$address','$password')";
        mysqli_query($con, $query);
        echo "<script type='text/javascript'> alert('Successfully Register')</script>";
    }
    else
    {
        echo "<script type='text/javascript'> 
        alert('Please Enter Some Valid Information')</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
body{
    background: url(images/1.jpeg);
    width: 100%;
    height: 100vh;
    font-family: sans-serif;
}
.signup{
    width: 400px;
    height: 950px;
    margin: auto;
    background: whitesmoke;
    border-radius: 3px;
}
h1{
    text-align: center;
}
h4{
    text-align: center;
    padding-top: 15px;
}
form{
    width: 300px;
    margin-left: 20px;
}
form label{
    display: flex;
    margin-top: 20px;
    font-size: 20px;
}
form input{
    width: 100%;
    padding: 7px;
    border: none;
    border: 1px solid gray;
    border-radius: 6px;
outline: none;
}
input[type="submit"]{
    width: 320px;
    height: 25px;
    margin-top: 20px;
    border: none;
    background-color: red;
    color: wheat;
    font-size: 18px;
    cursor: pointer;
}
input[type="submit"]:hover{
    color: white;
    background: rgb(12, 211, 247);
}
p{
    text-align: center;
    padding-top: 20px;
    font-size: 15px;
}
</style>
</head>
<body>
    <div class="signup">
<h1>
    sign Up
</h1>
<h4>
    It's will take a short time
</h4>
<form method="post">
    <label>First Name</label>
    <input type="text" name="name" required>
    <label>Father Name</label>
    <input type="text" name="fname" required>
    <label>Last Name</label>
    <input type="text" name="lname" required>
    <label>Contact Number</label>
    <input type="tel" name="cnum" required>
    <label>E-mail</label>
    <input type="email" name="email" required>
    <label>Address</label>
    <input type="text" name="address" required>
    <label>Password</label>
    <input type="password" name="pass" required>
    <input type="submit" name="" value="submit">
</form>

<p>By clicking the Sign Up button, you agree to our <br>
<a href="">Terms and conditions</a> and
<a href="#"> Privicy Policy</a></p>
<p>already have an account? <a href="logtest.php">Login here</a></p>    
</div>
</body>
</html>