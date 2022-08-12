<?php

$conn = mysqli_connect("localhost", "root", "", "socialmedia") or die(mysqli_error($conn));

session_start();

if (!isset($_SESSION['user_id'])) {
    header('location:login.php');
} 

$userId = $_SESSION['user_id'];

?>