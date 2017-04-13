<?php
session_start();
//error_reporting(E_ALL); ini_set('display_errors', 1); 
$db = mysqli_connect("localhost","root","SAM@sam7","authentication");

//$conn = new mysqli("localhost", "root", "SAM@sam7","authentication");

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
} 
echo "Connected successfully";


if (isset($_POST['register_btn'])) {
    
    $username = mysqli_real_escape_string($db,$_POST['username']);
    $email = mysqli_real_escape_string($db,$_POST['email']);
    $city = mysqli_real_escape_string($db,$_POST['city']);
    $phone = mysqli_real_escape_string($db,$_POST['phone']);
    $password = mysqli_real_escape_string($db,$_POST['password']);
    $password2 = mysqli_real_escape_string($db,$_POST['password2']);
    
    if ($password == $password2) {
        $password = md5($password);
        $sql = "INSERT INTO users(username, email, city, phone, password) VALUES('$username','$email','$city','$phone','$password')";
        mysqli_query($db, $sql);
        $_SESSION['message'] = "You are now logged in";
        $_SESSION['username'] = $username;
//echo $sql;
        //header("location: home.php");
    }else {
        $_SESSION['message'] = "The password doesn't match";
    }
}
?>




<!DOCTYPE html>
<html>
<head>
    <title>Register</title></head>
<body>
    <div class="header">
    <h1>Register</h1>
    </div>
    
    <form method="post" action="register.php">
    <table>
        <tr>
        <td>Username:</td>
        <td><input type="text" name="username" class="textInput"></td>
        </tr>
        <tr>
        <td>Email:</td>
        <td><input type="email" name="email" class="textInput"></td>
        </tr>
	<tr>
        <td>City:</td>
        <td><input type="city" name="city" class="textInput"></td>
        </tr>
	<tr>
        <td>Phone:</td>
        <td><input type="phone" name="phone" class="textInput"></td>
        </tr>
        <tr>
        <td>Password:</td>
        <td><input type="password" name="password" class="textInput"></td>
        </tr>
        <tr>
        <td>Password again:</td>
        <td><input type="password" name="password2" class="textInput"></td>
        </tr>
        <tr>
        <td></td>
        <td><input type="submit" name="register_btn" value="Register"></td>
        </tr>
        </table>
    </form>
    </body>
</html>


