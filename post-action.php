<?php

if (isset($_POST['submit'])) {

    $caption = $_POST['caption'];

    $filename = $_FILES['post-img']['name'];
    $target_dir = "imgPost/" . basename($filename);
    $img_post = 'http://localhost/socialMedia/imgPost/' . $filename;

    move_uploaded_file($_FILES['post-img']['tmp_name'], $target_dir);


    $query = "INSERT INTO `user_post`( `user_id`, `caption`, `img_post`,`date`) VALUES ('$userId','$caption','$img_post','" . date("Y-m-d") . "')";

    $query_result = mysqli_query($conn, $query);
}