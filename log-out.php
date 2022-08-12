

<?php
$conn = mysqli_connect("localhost", "root", "", "socialmedia") or die(mysqli_error($conn));

session_start();
session_unset();
header('location:log-in.php');
?>
	
