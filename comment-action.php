
<?php

if (isset($_POST['sub_coment'])) {

    $comment = $_POST['comment'];

    if ($comment == "") {
        header('location:Homepage.php');
        die;
    } else {

        $querycomment = "INSERT INTO `user_comments`( `user_id`, `comments`, `post_id`,`date`) VALUES ('$userId','$comment','$postId','" . date("Y-m-d") . "')";

        $query_result_comment = mysqli_query($conn, $querycomment);
    }
} ?>