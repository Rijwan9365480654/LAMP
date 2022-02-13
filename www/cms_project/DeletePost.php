<?php require_once("includes/db.php"); ?>
<?php require_once("includes/Functions.php"); ?>
<?php require_once("includes/Sessions.php"); ?>
<?php
$SearchQueryParamater = $_GET["id"];
$sql = "SELECT * FROM posts where id=$SearchQueryParamater";
$stmt = $conn->query($sql);
while ($DataRows = $stmt->fetch()) {
    $ImageToBeDeleted = $DataRows['image'];
}
?>
<?php
$sql = "DELETE FROM posts WHERE id=$SearchQueryParamater";
$Execute = $conn->query($sql);
if ($Execute) {
    $TargetPathToDeleteImage = 'upload/' . $ImageToBeDeleted;
    unlink($TargetPathToDeleteImage);
    $_SESSION["SuccessMessage"] = "Post Deleted Successfully";
    Redirect_to("Posts.php");
} else {
    $_SESSION["ErrorMessage"] = "Something Went Wrong";
    Redirect_to("Posts.php");
}
?>