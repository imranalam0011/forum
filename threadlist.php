<!-- lecture done till 56 -->
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
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `categories` WHERE category_id=$id";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
        $catname = $row['category_name'];
        $catdesc =$row['category_description'];
    }


    ?>

    <?php
    $showalert = false;


    $method = $_SERVER['REQUEST_METHOD'];
    if($method=='POST'){
        // Insert into thread into db
        $th_title = $_POST['title'];
        $th_desc = $_POST['desc'];
        $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$th_title', '$th_desc', '$id', '0', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        $showalert = true;
        if($showalert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
             <strong>Success!</strong> Your thread has been added! Please wait for community to respond.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
        

    }

    ?>


    <!-- Categoty container start here -->

    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to <?php echo $catname; ?> Forums</h1>
            <p class="lead"> <?php echo $catdesc; ?> </p>
            <hr class="my-4">
            <p>This is a perr to perr forum for sharing knowledge with each other No Spam / Advertising / Self-promote
                in the forums. ...
                Do not post copyright-infringing material. ...
                Do not post “offensive” posts, links or images. ...
                Do not cross post questions. ...
                Do not PM users asking for help. ...</p>
            <!-- <p class="lead"> -->
            <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
            </p>
        </div>
    </div>

    <div class="container">
        <h1 class="py2">Start a Discussions</h1>
        <form action="<?php echo $_SERVER['REQUEST_URI']  ?>" method="POST">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Problem Title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">Keep your title as crisp and crisp as possible</div>
            </div>

            <div class="form-group">
                <label for="exampleFormControlTextarea1">Ellaborate Your Concern</label>
                <textarea name="desc" id="desc" rows="3" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-success my-4">Submit</button>
        </form>

    </div>

    <div class="container" id="ques">
        <h1 class="py2">Browse Qusetions</h1>
        <?php
        $id = $_GET['catid'];
        $sql = "SELECT * FROM `threads` WHERE thread_cat_id=$id";
        $result = mysqli_query($conn, $sql);
        $noResult = true;
        while($row = mysqli_fetch_assoc($result)){
        $noResult = false;
        $id = $row['thread_id'];
        $title = $row['thread_title'];
        $desc =$row['thread_desc'];
        $thread_time =$row['timestamp'];
       

        echo '<div class="media my-3">
            <img class="mr-3" src="img/user.jpg" width="54px" class="mr-3" alt="...">
            <div class="media-body">
            <p class="fw-bold my-0">Anonymous User at '. $thread_time .' </p>
                <h5 class="mt-0"> <a class="text-dark" href="thread.php?threadid='. $id .'">'. $title.' </a></h5>
                '. $desc.'                                           
        </div>';

                
       }
    //    echo var_dump($noResult);
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