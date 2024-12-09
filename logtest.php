<?php
session_start();
include("db.php");
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $email = $_POST['email'];
    $password = $_POST['pass'];
    if(!empty($email) && !empty($password) && !is_numeric($email))
    {
        $query = "SELECT * FROM registerdata where email = '$email' limit 1";
        $result = mysqli_query($con, $query);
        if($result)
        {
            if($result && mysqli_num_rows($result) > 0)
            {
                $user_data = mysqli_fetch_assoc($result);
                
                if($user_data['pass'] == $password)
                {
                    header("location: index.php");
                    die;
                }
            }
        }
        echo "<script type='text/javascript'> alert('wrong username or password')</script>";
    }
    else
    { 
        echo "<script type='text/javascript'> alert('wrong username or password')</script>";
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

.login{
    width: 360px;
    height: 320px;
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
    <div class="login">
<h1> Sign Up </h1>
<form method="POST">
    <label>E-mail</label>
    <input type="email" name="email" required>
    <label>Password</label>
    <input type="password" name="pass" required>
    <input type="submit" name="" value="submit">
</form>
<p>Not have an account? <br>
<a href="signup.php">Sign Up here</a> and
<a href="#"> Privicy Policy</a></p>    
</div>
</body>
</html>