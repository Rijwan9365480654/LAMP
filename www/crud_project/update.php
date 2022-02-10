<?php
require_once("includes/DB.php");
$SearchQueryParamater = $_GET["id"];
if (isset($_POST['submit'])) {
    if (!empty($_POST['EName']) && !empty($_POST['SSN'])) {
        $EName = $_POST["EName"];
        $SSN = $_POST["SSN"];
        $Dept = $_POST["Dept"];
        $Salary = $_POST["Salary"];
        $HomeAddress = $_POST["HomeAddress"];
        global $conn;
        $sql = "UPDATE emp_record SET ename='$EName',ssn='$SSN',dept='$Dept',salary='$Salary',homeaddress='$HomeAddress' WHERE id='$SearchQueryParamater'";
        $stmt = $conn->query($sql);

        if ($stmt) {
            echo '<script>window.open("view_from_database.php?id=Record Updated Successfully","_self")</script>';
        } else {
            echo "something Went Wrong";
        }
    } else {
        echo '<span class="FieldInfoHeading">Please add atleast Name and SSN Filled</span>';
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Update Data into Database</title>
    <link rel="stylesheet" href="includes/style.css">
</head>

<body>
    <?php
    $sql = "SELECT * FROM emp_record WHERE id=$SearchQueryParamater";
    $stmt = $conn->query($sql);
    while ($DataRows = $stmt->fetch()) {
        $Id = $DataRows["id"];
        $EName = $DataRows["ename"];
        $SSN = $DataRows["ssn"];
        $Department = $DataRows["dept"];
        $Salary = $DataRows["salary"];
        $HomeAddress = $DataRows["homeaddress"];
    }
    ?>

    <div class="">
        <form class="" action="update.php?id=<?php echo $SearchQueryParamater; ?>" method="post">
            <fieldset>
                <span class="FieldInfo">Employee Name</span><br>
                <input type="text" name="EName" value="<?php echo $EName; ?>"><br>
                <span class="FieldInfo">Social Security Number</span><br>
                <input type="text" name="SSN" value="<?php echo $SSN; ?>"><br>
                <span class="FieldInfo">Department</span><br>
                <input type="text" name="Dept" value="<?php echo $Department; ?>"><br>
                <span class="FieldInfo">Salary</span><br>
                <input type="text" name="Salary" value="<?php echo $Salary; ?>"><br>
                <span class="FieldInfo">Home Address</span><br>
                <textarea name="HomeAddress" rows="8" cols="80"><?php echo $HomeAddress; ?></textarea><br>
                <input type="submit" name="submit" value="Updata Data">
            </fieldset>
        </form>
    </div>

</body>

</html>