<?php
require_once("includes/db.php"); ?>
<?php require_once("includes/Functions.php"); ?>
<?php require_once("includes/Sessions.php"); ?>
<?php
$PostIdFromURL = $_GET["id"];
if (isset($_POST["Submit"])) {
    $CommenterName = $_POST["CommenterName"];
    $CommenterEmail = $_POST["CommenterEmail"];
    $CommenterThoughts = $_POST["CommenterThoughts"];
    $Admin = "Rijwan";
    //Date and Time fetcher
    date_default_timezone_set("Asia/Kolkata");
    $DateTime = strftime("%d %B %Y %H:%M:%S", time());
    if (empty($CommenterName) || empty($CommenterEmail) || empty($CommenterThoughts)) {
        $_SESSION["ErrorMessage"] = "All Fields Must be Filled";
        Redirect_to("FullPost.php?id=$PostIdFromURL");
    } elseif (strlen($CommenterThoughts) < 3) {
        $_SESSION["ErrorMessage"] = "Comments should be greater than 2 Characters";
        Redirect_to("FullPost.php?id=$PostIdFromURL");
    } elseif (strlen($CommenterThoughts) > 500) {
        $_SESSION["ErrorMessage"] = "Comments should be less than 500 Characters";
        Redirect_to("FullPost.php?id=$PostIdFromURL");
    } else {
        $sql = "INSERT INTO comments(datetime,name,email,comment,approvedby,status,post_id) Values(:datetimE,:namE,:emaiL,:commenT,'Pending','OFF',:postidfromUrl)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':datetimE', $DateTime);
        $stmt->bindValue(':namE', $CommenterName);
        $stmt->bindValue(':emaiL', $CommenterEmail);
        $stmt->bindValue(':commenT', $CommenterThoughts);
        $stmt->bindValue(':postidfromUrl', $PostIdFromURL);
        $Execute = $stmt->execute();

        if ($Execute) {
            $_SESSION["SuccessMessage"] = "Comment Submitted Successfully";
            Redirect_to("FullPost.php?id=$PostIdFromURL");
        } else {
            $_SESSION["ErrorMessage"] = "Something Went Wrong";
            Redirect_to("FullPost.php?id=$PostIdFromURL");
        }
    }
}
?>
<?php
if (!isset($PostIdFromURL)) {
    $_SESSION["ErrorMessage"] = "Invalid Request !";
    Redirect_to("Blog.php");
} elseif (empty($PostIdFromURL)) {
    $_SESSION["ErrorMessage"] = "Invalid Request !";
    Redirect_to("Blog.php");
} else {
    $count = 0;
    $sql = "SELECT * FROM posts";
    $stmt = $conn->query($sql);
    while ($DataRows = $stmt->fetch()) {
        $id = $DataRows['id'];
        if ($PostIdFromURL == $id) {
            $count++;
        }
    }
    if ($count == 0) {
        $_SESSION["ErrorMessage"] = "Page Not Found !";
        Redirect_to("Blog.php");
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <!-- META TAGS -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Font Awesome Code -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap Code for CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <!-- Own CSS Code file -->
    <link rel="stylesheet" href="css/styles.css">
    <title>Blog Page</title>
</head>

<body>
    <!--NAVBAR starts here-->
    <div style="height:5px; background:#27aae1"></div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a href="#" class="navbar-brand text-primary">CMS PROJECT</a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarcollapseCMS">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarcollapseCMS">
                <ul class="navbar-nav m-auto">
                    <li class="nav-item">
                        <a href="Blog.php" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a href="Blog.php" class="nav-link">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">Features</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <form class="form-inline d-none d-sm-block" action="Blog.php">
                        <div class="form-group">
                            <input class="form-control mr-2" type="text" name="Search" placeholder="Search Here" value="">
                            <button class="btn btn-primary" name="SearchButton">Go</button>
                        </div>
                    </form>
                </ul>
            </div>
        </div>
    </nav>
    <div style="height:5px; background:#27aae1"></div>
    <!-- NAVBAR Ends Here -->

    <!-- Main Area Starts Here -->
    <div class="container">
        <div class="row">
            <div class="col-sm-8 mt-4">
                <h1>The Complete Responsive CMS Blog</h1>
                <h1 class="lead">The Complete Blog by using PHP by Rijwan Ansari</h1>
                <?php
                echo ErrorMessage();
                echo SuccessMessage();
                ?>
                <?php
                $sql = "SELECT * FROM posts WHERE id='$PostIdFromURL'";
                $stmt = $conn->query($sql);
                while ($DataRows = $stmt->fetch()) {
                    $PostId = $DataRows['id'];
                    $DateTime = $DataRows['datetime'];
                    $PostTitle = $DataRows['title'];
                    $Category = $DataRows['category'];
                    $Admin = $DataRows['author'];
                    $Image = $DataRows['image'];
                    $PostDescription = $DataRows['post'];
                ?>
                    <div class='card'>
                        <img src="upload/<?php echo htmlentities($Image) ?>" style="max-height:450px;" class="img-fluid card-img-top">
                        <div class="card-body">
                            <h4 class="catd-title"><?php echo htmlentities($PostTitle); ?></h4>
                            <small class="text-muted">Written by <?php echo htmlentities($Admin); ?> On <?php echo htmlentities($DateTime); ?></small>
                            <span style="float: right;" class="badge badge-dark text-light">Comments 20</span>
                            <hr>
                            <p class="card-text">
                                <?php echo $PostDescription; ?>
                            </p>
                        </div>
                    </div>
                <?php
                } ?>
                <br>
                <!-- Comments Section Starts Here -->

                <!-- Fetch Comments from DB Starts Here -->

                <span class="FieldInfo">Comments</span>
                <br>
                <hr>
                <?php
                $sql = "SELECT * FROM comments WHERE post_id=$PostIdFromURL AND status='ON'";
                $stmt = $conn->query($sql);
                while ($DataRows = $stmt->fetch()) {
                    $CommentDatetoShow = $DataRows["datetime"];
                    $CommenterNametoShow = $DataRows["name"];
                    $CommenterThoughtstoShow = $DataRows["comment"];
                ?>

                    <div>
                        <div class="media CommentBlock">
                            <img class="d-block img-fluid alogn-self-center" src="images/pic.png" alt="" width="100px" height="100px">
                            <div class="media-body ml-2">
                                <h6 class="lead"><?php echo $CommenterNametoShow; ?></h6>
                                <p class="small"><?php echo $CommentDatetoShow; ?></p>
                                <p><?php echo $CommenterThoughtstoShow; ?></p>
                            </div>
                        </div>
                        <hr>
                    </div>
                <?php } ?>
                <!-- Fetch Comments Ends Here -->

                <div>
                    <form action="FullPost.php?id=<?php echo $PostIdFromURL; ?>" method="POST">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h5 class="FieldInfo">Share Your Thoughts About this Post</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input class="form-control" type="text" name="CommenterName" placeholder="Name" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        </div>
                                        <input class="form-control" type="email" name="CommenterEmail" placeholder="Email" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <textarea name="CommenterThoughts" class="from-control col-lg-12" rows="6"></textarea>
                                </div>
                                <div>
                                    <button type="submit" name="Submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Comments Section Ends Here -->
            </div>
            <!-- Side Area Starts Here -->
            <div class="col-sm-4" style="min-height: 40px; background:red;"></div>
            <!-- Side Area Ends Here -->
        </div>
    </div>
    <br>
    <!-- Main Area Ends Here -->


    <!--Footer Starts here -->
    <footer class="bg-dark text-white">
        <div class="container">
            <div class="row">
                <div class="col">
                    <p class="lead text-center">Theme By | Rijwan | <span id="year"></span> &copy; ----All Right Reserved.</p>
                    <p class="text-center small"><a style="color: white; text-decoration:none; cursor:pointer;" href="#">This site is copywrite protected. No one can use the content of this page.</a></p>
                </div>
            </div>
        </div>

        <div style="height:5px; background:#27aae1"></div>
    </footer>
    <!--Footer Ends Here -->

    <!-- Bootstrap Code for JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <!-- Custom Script -->
    <script>
        $('#year').text(new Date().getFullYear());
    </script>
</body>

</html>