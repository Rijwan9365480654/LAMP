<?php
require_once("includes/db.php"); ?>
<?php require_once("includes/Functions.php"); ?>
<?php require_once("includes/Sessions.php"); ?>
<?php
$SearchQueryParameter = $_GET['id'];
if (isset($_POST["Submit"])) {
    $PostTitle = $_POST["PostTitle"];
    $Category = $_POST['Category'];
    $Image = $_FILES["Image"]["name"];
    $Target = "/upload/" . basename($_FILES["Image"]["name"]);
    $PostText = $_POST["PostDescription"];
    $Admin = "Rijwan";
    date_default_timezone_set("Asia/Kolkata");
    $DateTime = strftime("%d %B %Y %H:%M:%S", time());
    if (empty($PostTitle)) {
        $_SESSION["ErrorMessage"] = "Title can't be Empty";
        Redirect_to("Posts.php");
    } elseif (strlen($PostTitle) < 6) {
        $_SESSION["ErrorMessage"] = "Post Title should be greater than 5 Characters";
        Redirect_to("Posts.php");
    } elseif (strlen($PostText) > 9999) {
        $_SESSION["ErrorMessage"] = "Post Description should be less than 10000 Characters";
        Redirect_to("Posts.php");
    } else {
        if (!empty($Image)) {
            $sql = "UPDATE posts SET title='$PostTitle', category='$Category', image='$Image', post='$PostText' WHERE id=$SearchQueryParameter";
            $Execute = $conn->query($sql);
            move_uploaded_file($_FILES["Image"]['tmp_name'], $Target);
        } else {
            $sql = "UPDATE posts SET title='$PostTitle', category='$Category', post='$PostText' WHERE id=$SearchQueryParameter";
            $Execute = $conn->query($sql);
        }

        //var_dump($Execute)
        if ($Execute) {
            $_SESSION["SuccessMessage"] = "Post Updated Successfully";
            Redirect_to("Posts.php");
        } else {
            $_SESSION["ErrorMessage"] = "Something Went Wrong";
            Redirect_to("Posts.php");
        }
    }
}
?>

<!-- HTML CODE Starts Here -->
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
    <title>Edit Post</title>
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
                        <a href="Dashboard.php" class="nav-link">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a href="Posts.php" class="nav-link">Posts</a>
                    </li>
                    <li class="nav-item">
                        <a href="Categories.php" class="nav-link">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a href="Admins.php" class="nav-link">Manage Admins</a>
                    </li>
                    <li class="nav-item">
                        <a href="Comments.php" class="nav-link">Comments</a>
                    </li>
                    <li class="nav-item">
                        <a href="Blog.php?page=1" class="nav-link">Live Blog</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="MyProfile.php" class="nav-link"><i class="fa-solid fa-user text-success"></i> My Profile</a>
                    </li>
                    <li class="nav-item "><a href="Logout.php" class="nav-link text-danger"><i class="fa-solid fa-arrow-right-from-bracket"></i> LogOut</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div style="height:5px; background:#27aae1"></div>
    <!-- NAVBAR Ends Here -->

    <!-- Header Starts Here -->
    <header class="bg-dark text-white py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1><i class="fa-solid fa-edit" style="color:#27aae1;"></i>Edit Post</h1>
                </div>
            </div>
        </div>
    </header>
    <!-- Header Ends Here -->

    <!-- Main Area Here -->
    <section class="container py-2 mb-4">
        <div class="row">
            <div class="offset-lg-1 col-lg-10" style="min-height: 415px;">
                <?php
                echo ErrorMessage();
                echo SuccessMessage();
                $sql = "SELECT * FROM posts WHERE id='$SearchQueryParameter'";
                $stmt = $conn->query($sql);
                while ($DataRows = $stmt->fetch()) {
                    $TitleToBeUpdated = $DataRows["title"];
                    $CategoryToBeUpdated = $DataRows["category"];
                    $ImageToBeUpdated = $DataRows['image'];
                    $PostToBeUpdated = $DataRows['post'];
                }
                ?>
                <form action="EditPost.php?id=<?php echo $SearchQueryParameter; ?>" method="POST" enctype="multipart/form-data">
                    <div class="card bg-secondary text-light mb-3">
                        <div class="card-body bg-dark">
                            <div class="form-group">
                                <label for="title"><span class="FieldInfo"> Post Title:</span></label>
                                <input class="form-control" type="text" name="PostTitle" id="title" placeholder="Type Title Here" value="<?php echo $TitleToBeUpdated; ?>">
                            </div>
                            <div class="form-group">
                                <span class="FieldInfo">Existing Category: </span>
                                <?php echo $CategoryToBeUpdated; ?>
                                <br>
                                <label for="CategoryTitle"><span class="FieldInfo"> Choose Category:</span></label>
                                <select class="form-control" id="CategoryTitle" name="Category">
                                    <?php
                                    global $conn;
                                    $sql = "SELECT id,title FROM category";
                                    $stmt = $conn->query($sql);
                                    while ($DataRows = $stmt->fetch()) {
                                        $Id = $DataRows['id'];
                                        $CategoryName = $DataRows['title'];
                                    ?>
                                        <option><?php echo $CategoryName; ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group mb-1">
                                <span class="FieldInfo">Existing Image: </span>
                                <img class="mb-1" src="upload/<?php echo $ImageToBeUpdated; ?>" width="170px" height="70px">
                                <br>
                                <div class="custom-file">
                                    <input type="file" name="Image" id="imageSelect" value="" class="custom-file-input">
                                    <label for="imageSelect" class="custom-file-label">Select Image</label>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="Post">
                                    <span class="FieldInfo">Post:</span>
                                </label>
                                <textarea class="form-control" id="Post" name="PostDescription" rows="8" cols="80"><?php echo $PostToBeUpdated; ?></textarea>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 mb-2">
                                    <a href="Dashboard.php" class="btn btn-warning btn-block"><i class="fas fa-arrow-left"></i> Back to Dashboard</i></a>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <button type="submit" name="Submit" class="btn btn-success btn-block"><i class="fas fa-check"></i> Publish </i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Area Ends Here -->

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
<!-- HTML Code Ends Here -->