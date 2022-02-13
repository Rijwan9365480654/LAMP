<?php require_once("includes/db.php"); ?>
<?php require_once("includes/Functions.php"); ?>
<?php require_once("includes/Sessions.php"); ?>

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
    <title>Posts</title>
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
                <div class="col-md-12 pb-2">
                    <h1><i class="fa-solid fa-blog" style="color:#27aae1;"></i>Blog Posts</h1>
                </div>
                <div class="col-lg-3 mb-2">
                    <a class="btn btn-primary btn-block" href="AddNewPost.php">
                        <i class="fas fa-edit"></i> Add New Post
                    </a>
                </div>
                <div class="col-lg-3 mb-2">
                    <a class="btn btn-info btn-block" href="Categories.php">
                        <i class="fas fa-folder-plus"></i> Add New Category
                    </a>
                </div>
                <div class="col-lg-3 mb-2">
                    <a class="btn btn-warning btn-block" href="Admins.php">
                        <i class="fas fa-user-plus"></i> Add New Admin
                    </a>
                </div>
                <div class="col-lg-3 mb-2">
                    <a class="btn btn-success btn-block" href="Comments.php">
                        <i class="fas fa-check"></i> Approve Comments
                    </a>
                </div>
            </div>
        </div>
    </header>
    <!-- Header Ends Here -->

    <!-- Main Area Starts Here-->
    <section class="container py-2 mb-4">
        <div class="row">
            <div class="col-lg-12">
                <?php
                echo ErrorMessage();
                echo SuccessMessage();
                ?>
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Date & Time</th>
                            <th>Author</th>
                            <th>Banner</th>
                            <th>Comments</th>
                            <th>Action</th>
                            <th>Live Preview</th>
                        </tr>
                    </thead>
                    <?php
                    $sql = "SELECT * FROM posts";
                    $stmt = $conn->query($sql);
                    $sr = 0;
                    while ($DataRows = $stmt->fetch()) {
                        $Id = $DataRows['id'];
                        $DateTime = $DataRows['datetime'];
                        $PostTitle = $DataRows['title'];
                        $Category = $DataRows['category'];
                        $Admin = $DataRows['author'];
                        $Image = $DataRows['image'];
                        $PostText = $DataRows['post'];
                        $sr++;
                    ?>
                        <tbody>
                            <tr>
                                <td><?php echo $sr; ?></td>
                                <td>
                                    <?php if (strlen($PostTitle) > 15) {
                                        $PostTitle = substr($PostTitle, 0, 10) . "...";
                                    } ?>
                                    <?php echo $PostTitle ?>
                                </td>
                                <td>
                                    <?php if (strlen($Category) > 8) {
                                        $Category = substr($Category, 0, 8) . "...";
                                    } ?>
                                    <?php echo $Category ?></td>
                                <td>
                                    <?php if (strlen($DateTime) > 11) {
                                        $DateTime = substr($DateTime, 0, 10) . "...";
                                    } ?>
                                    <?php echo $DateTime ?></td>
                                <td>
                                    <?php if (strlen($Admin) > 6) {
                                        $Admin = substr($Admin, 0, 5) . "...";
                                    } ?>
                                    <?php echo $Admin ?></td>
                                <td><img src="upload/<?php echo $Image ?>" width="170px" height="50px"></td>
                                <td>Comments</td>
                                <td>
                                    <a href="EditPost.php?id=<?php echo $Id; ?>"><span class=" btn btn-warning">Edit</span></a>
                                    <a onClick="javascript: return confirm('Are You Sure of Deleting the Post? This cannot be undone. ');" href="DeletePost.php?id=<?php echo $Id; ?>"><span class=" btn btn-danger">Delete</span></a>
                                </td>
                                <td><a href="FullPost.php?id=<?php echo $Id; ?>" target="_blank"><span class=" btn btn-primary">Live Preview</span></a></td>
                            </tr>
                        </tbody>
                    <?php } ?>
                </table>
            </div>
        </div>
    </section>
    <!-- Main Area Ends Here-->

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