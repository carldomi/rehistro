<?php
include("..//dB/config.php");
session_start();

if(isset($_POST['registration'])){
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];
$phoneNumber = $_POST['phoneNumber'];
$gender = $_POST['gender'];
$birthday = $_POST['birthday'];

//validate if pareha ang password
if($password != $cpassword)
    $_SESSION['message'] = "Password and Confirm Password does Not Match";
    $_SESSION['code'] = "error";
}

//validate if email already exist
$query = "SELECT * FROM 'users' WHERE 'email' = '$email'";
$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) > 0){
    $_SESSION['message'] = "Email Address already exists";
    $_SESSION['code'] = 'error';
    header("Location: ./registration.php");
    exit(0);
}

//insert data sa database
$query = "INSERT INTO `users`(`userId`, `firstName`, `lastName`, `email`, `password`, `phoneNumber`, `gender`, `birthday`) 
VALUES ('$firstName','$lastName','$email','$password','$phoneNumber','$gender','$birthday')";

if(mysqli_query($conn, $query)){
    $_SESSION['message'] = "Registered Successfully";
    $_SESSION['code'] = "error";
    header("Location: ./login.php");
    exit(0);
}

?>