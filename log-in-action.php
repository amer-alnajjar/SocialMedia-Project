<?php
$conn = mysqli_connect("localhost", "root", "", "socialmedia") or die(mysqli_error($conn));
session_start();

if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $email = stripslashes($email);
  $email = mysqli_real_escape_string($conn, $email);
  $email = htmlspecialchars($email);

  $password = $_POST['password'];
  $password = stripslashes($password);
  $password = mysqli_real_escape_string($conn, $password);
  $email = htmlspecialchars($email);

  $sql = "SELECT * FROM `user` WHERE `email` = '$email' AND `password` = '$password'";

  $result = mysqli_query($conn, $sql);

  if ($row = mysqli_num_rows($result) > 0) {

    while ($user_row = mysqli_fetch_assoc($result)) {

      $_SESSION['user_id'] = $user_row['user_id'];

      header('location:Homepage.php');

      $message = "<h6>" . "Login Success" . "</h6>";
    }
  }
}
