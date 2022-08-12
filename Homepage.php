<?php

include('Homepage-action.php');

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Bootstrap 5 css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!--font-awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--style-->
    <link rel="stylesheet" href="css/style.css">
    <title>Social Media</title>
</head>



<body>

    <!--start nav bar-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand brand">
                Social Media
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText" style="flex-grow: 0;">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link asignUp" href="log-out.php">LOG OUT </a>
                    </li>
                </ul>






                <?php
                $sql = "SELECT * FROM `user` WHERE `user_id` = '$userId'";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    $Name = $row['name'];
                    $imguser = $row['img_user'];
                    $date = $row['date'];
                ?>
                    <div class="flexPostForm">
                        <div class="imgPostForm imgHead">
                            <img style="margin-left: 5px;" src=" <?= $imguser ?>" alt="">
                        </div>
                        <div class="namePostCard">
                            <p class="name"> <?php echo $Name; ?></p>
                        </div>
                    </div>
                <?php } ?>





            </div>
        </div>
    </nav>

    <div class="container">
        <div class="postForm">
            <div class="flexPostForm">
                <div class="imgPostForm">
                    <img src=" <?= $imguser ?>" alt="">
                </div>
                <input data-bs-toggle="modal" data-bs-target="#exampleModal" class="form-control" type="text" placeholder="Type Your Post Here" aria-label=".form-control-lg example">
                <form action="Homepage.php" method="POST" >
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Create Post</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <textarea class="form-control txtPostModal" name="caption" id="exampleFormControlTextarea1" rows="3">
                        Type your post here...
                    </textarea>
                            
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" name="submit" class="btn btn-primary">Post</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>



        <?php
        include('post-action.php');

        $sqlpost = "SELECT * FROM `user_post` INNER JOIN  `user` ON user_post.user_id = user.user_id 
				
		GROUP BY user_post.post_id
		
		ORDER BY `post_id` DESC";

        $resultpost = mysqli_query($conn, $sqlpost);

        while ($rowpost = mysqli_fetch_assoc($resultpost)) {

            $postId = $rowpost['post_id'];
            $nameuserpost = $rowpost['name'];
            $imguserpost = $rowpost['img_user'];
            $postcaption = $rowpost['caption'];
            $datepost = $rowpost['date'];
            $postimg = $rowpost['img_post'];

        ?>
            <div class="postCard">
                <div class="postForm">
                    <div class='flexPostForm'>
                        <div class='imgPostForm'>
                            <img src='<?= $imguserpost ?> ' alt=''>
                        </div>
                        <div class='namePostCard'>
                            <p class='name'><?php echo $nameuserpost; ?> </p>
                            <div class='divTime'>
                                <i class='fa-solid fa-clock'></i>
                                <p><?php echo $datepost; ?></p>
                            </div>
                            <p style='margin: 5px;'><?php echo $postcaption; ?> </p>
                        </div>
                    </div>
                    <div class='imgPost'>
                        <img src='<?= $postimg ?>' class='img-fluid rounded' alt='...'>
                    </div>
                    <div>
                        <div>
                            <form action="Homepage.php" method="POST" class="flexPostForm">
                                <div class="imgPostForm">
                                    <img src="<?= $imguser ?>" alt="">
                                </div>
                                <input class="form-control" type="text" name="comment" placeholder="Type your comment" aria-label=".form-control-lg example">
                                <button type="submit" class="btn btn-primary" name="sub_coment">send</button>
                            </form>
                        </div>
                    </div>
                    <hr class="hr">




                    <?php

                    $sqlcomment = "SELECT * FROM `user_comments` INNER JOIN  `user` ON user_comments.user_id = user.user_id 
                                    WHERE user_comments.post_id = '$postId'
                                    ORDER BY `comments_id` DESC";

                    $resultcomment = mysqli_query($conn, $sqlcomment);

                    while ($rowcomment = mysqli_fetch_assoc($resultcomment)) {

                        $nameusercomment = $rowcomment['name'];
                        $imgusercomment = $rowcomment['img_user'];
                        $postcomment = $rowcomment['comments'];
                        $datecoment = $rowcomment['date'];

                    ?>
                        <div class="comment">
                            <div class="flexPostForm">
                                <div class="imgPostForm">
                                    <img src="<?= $imgusercomment ?>" alt="">
                                </div>
                                <div class="boxComment">
                                    <p class="nameBoxComment"><?php echo $nameusercomment; ?></p>
                                    <p class="contentBoxComment"><?php echo $postcomment; ?></p>
                                    <div class="divTime">
                                        <i class="fa-solid fa-clock"></i>
                                        <p><?php echo $datecoment; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>

        <?php } ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>

<?php
include('comment-action.php');
