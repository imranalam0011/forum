<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <style>
    #ques {
        min-height: 433px;
    }
    </style>


    <title>Welcome to iDiscuss - Coding Forums</title>
</head>

<body>
    <?php include "partials/_header.php"; ?>
    <?php include "partials/_dbconnect.php"; ?>
    <?php
    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `threads` WHERE thread_id=$id";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
        $title = $row['thread_title'];
        $desc =$row['thread_desc'];
    }


    ?>

    <?php
    $showalert = false;


    $method = $_SERVER['REQUEST_METHOD'];
    if($method=='POST'){

        // Insert into comment db
        $comment = $_POST['comment'];
      
        $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$comment', '$id', '0', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        $showalert = true;
        if($showalert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
             <strong>Success!</strong> Your comment has been added!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
        

    }

    ?>


    <!-- Categoty container start here -->

    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4"><?php echo $title; ?></h1>
            <p class="lead"> <?php echo $desc; ?> </p>
            <hr class="my-4">
            <p>This is a perr to perr forum. No Spam / Advertising / Self-promote
                in the forums. ...
                Do not post copyright-infringing material. ...
                Do not post “offensive” posts, links or images. ...
                Do not cross post questions. ...
                Do not PM users asking for help. ...</p>
            <!-- <p class="lead"> -->
            <p>Posted by: <b>Imran</b></p>
            </p>
        </div>
    </div>


    <div class="container">
        <h1 class="py2">Post a Comment</h1>
        <form action="<?php echo $_SERVER['REQUEST_URI']  ?>" method="POST">

            <div class="form-group">
                <label for="exampleFormControlTextarea1">Type Your Comment</label>
                <textarea name="comment" id="comment" rows="3" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-success my-4">Post Comment</button>
        </form>

    </div>


    <div class="container" id="ques">
        <h1 class="py2">Discussions</h1>
        <?php
        $id = $_GET['threadid'];
        $sql = "SELECT * FROM `comments` WHERE thread_id=$id";
        $result = mysqli_query($conn, $sql);
        $noResult = true;
        while($row = mysqli_fetch_assoc($result)){
            $noResult = false;
            $id = $row['comment_id'];
            $content = $row['comment_content'];
            $comment_time = $row['comment_time'];
           
       

        echo '<div class="media my-3">
            <img class="mr-3" src="img/user.jpg" width="54px" class="mr-3" alt="...">
            <div class="media-body">
                <p class="fw-bold my-0">Anonymous User at '. $comment_time .' </p>
                '. $content.'
        </div>';

                
       }
       if($noResult){
        echo "<h2> No Threads Found </h2>";
        echo "<b> Be the first person to ask a question</b>";
       }


       ?>


    </div>
    </div>

    <?php include "partials/_footer.php"; ?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
</body>

</html>