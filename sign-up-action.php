<?php
$conn = mysqli_connect("localhost", "root", "", "socialmedia") or die(mysqli_error($conn));
session_start();
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $filename = $_FILES['imges-user']['name'];
    $target_dir = "imgUser/" . basename($filename);
    $img_user = 'http://localhost/socialMedia/imgUser/' . $filename;

    move_uploaded_file($_FILES['imges-user']['tmp_name'], $target_dir);

    $sql = "SELECT * FROM `user` WHERE `name` = '$name'";

    $result = mysqli_query($conn, $sql);


    if ($row = mysqli_num_rows($result) > 0) {
        $message = "<h6>" . "Name already excist" . "</h6>";
    } else {
        if (empty($name) || empty($email) || empty($password) || empty($filename)) {
            $message = "<h6>" . "Plss fill all fields" . "</h6>";
        } else {
            $query = "INSERT INTO `user`( `name`,`email`, `password`,`img_user`,`date`) VALUES ('$name','$email','$password','$img_user','" . date("Y-m-d") . "')";
            $query_result = mysqli_query($conn, $query);

            if ($query_result) {

                $user_sql = "SELECT * FROM `user` WHERE `name` = '$name'";

                $user_result = mysqli_query($conn, $user_sql);

                while ($user_row = mysqli_fetch_assoc($user_result)) {

                    $_SESSION['user_id'] = $user_row['user_id'];

                    header('location:Homepage.php');

                }
            }
        }
    }
}
