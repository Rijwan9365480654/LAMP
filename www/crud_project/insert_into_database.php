<?php
require_once("includes/DB.php");
if (isset($_POST['submit'])) {
    if (!empty($_POST['EName']) && !empty($_POST['SSN'])) {
        $EName = $_POST["EName"];
        $SSN = $_POST["SSN"];
        $Dept = $_POST["Dept"];
        $Salary = $_POST["Salary"];
        $HomeAddress = $_POST["HomeAddress"];
        global $conn;
        //preparing sql for entry in database using pdo with dummy values
        $sql = "INSERT INTO emp_record(ename,ssn,dept,salary,homeaddress) VALUES(:enamE,:ssN,:depT,:salarY,:homeaddresS)";
        $stmt = $conn->prepare($sql);
        //binding real values with the dummy values for preventing sql injection
        $stmt->bindValue(':enamE', $EName);
        $stmt->bindValue(':ssN', $SSN);
        $stmt->bindValue(':depT', $Dept);
        $stmt->bindValue(':salarY', $Salary);
        $stmt->bindValue(':homeaddresS', $HomeAddress);
        $Execute = $stmt->execute();
        if ($Execute) {
            echo '<span class="success">Record has been added Successfully</span>';
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
    <title>Insert Data into Database</title>
    <link rel="stylesheet" href="includes/style.css">
</head>

<body>
    <?php
    //php code
    ?>
    <h3><a href="index.php">Go Back to HomePage</a></h3>
    <div class="">
        <form class="" action="insert_into_database.php" method="post">
            <fieldset>
                <span class="FieldInfo">Employee Name</span><br>
                <input type="text" name="EName" value=""><br>
                <span class="FieldInfo">Social Security Number</span><br>
                <input type="text" name="SSN" value=""><br>
                <span class="FieldInfo">Department</span><br>
                <input type="text" name="Dept" value=""><br>
                <span class="FieldInfo">Salary</span><br>
                <input type="text" name="Salary" value=""><br>
                <span class="FieldInfo">Home Address</span><br>
                <textarea name="HomeAddress" rows="8" cols="80"></textarea><br>
                <input type="submit" name="submit" value="Submit Data">
            </fieldset>
        </form>
    </div>

</body>

</html>