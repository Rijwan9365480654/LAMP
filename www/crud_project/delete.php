<?php
require_once("includes/DB.php");
$SearchQueryParamater = $_GET["id"];
$sql = "DELETE FROM emp_record WHERE id=$SearchQueryParamater";
$stmt = $conn->query($sql);
if ($stmt) {
    echo '<script>window.open("view_from_database.php?id=Record Deleted Successfully","_self")</script>';
} else {
    echo '<script>window.open("view_from_database.php?id=Something Went Wrong","_self")</script>';
}
?>