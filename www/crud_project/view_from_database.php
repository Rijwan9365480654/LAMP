<?php
require_once "includes/DB.php";
?>
<!DOCTYPE html>
<html>

<head>
    <title>Insert Data into Database</title>
    <link rel="stylesheet" href="includes/style.css">
</head>

<body>
    <h3><a href="index.php">Go Back to HomePage</a></h3>
    <h2 class="success"><?php echo @$_GET["id"]; ?></h2>
    <!-- adding Search field -->
    <div class="">
        <fieldset>
            <form class="" action="view_from_database.php" method="GET">
                <input type="text" name="Search" value="" placeholder="Search by Name or SSN">
                <input type="submit" name="SearchButton" value="Search Record">
            </form>
        </fieldset>
    </div>
    <?php
    if (isset($_GET["SearchButton"])) {
        $Search = $_GET["Search"];
        $sql = "SELECT * FROM emp_record WHERE ename=:searcH OR ssn=:searcH";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':searcH', $Search);
        $stmt->execute();
        while ($DataRows = $stmt->fetch()) {
            $Id = $DataRows["id"];
            $EName = $DataRows["ename"];
            $SSN = $DataRows["ssn"];
            $Department = $DataRows["dept"];
            $Salary = $DataRows["salary"];
            $HomeAddress = $DataRows["homeaddress"];
    ?>
            <table width="1000" border="5" align="center">
                <caption>Search Results</caption>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>SSN</th>
                    <th>Department</th>
                    <th>Salary</th>
                    <th>Home Address</th>
                    <th>Search Again</th>
                </tr>
                <tr>
                    <td><?php echo $Id; ?></td>
                    <td><?php echo $EName; ?></td>
                    <td><?php echo $SSN; ?></td>
                    <td><?php echo $Department; ?></td>
                    <td><?php echo $Salary; ?></td>
                    <td><?php echo $HomeAddress; ?></td>
                    <td><a href="view_from_database.php">Search Again</a></td>
                </tr>
            </table>
    <?php }
    }
    ?>
    <!-- search Field Ends Here -->
    <table width="1000" border="5" align="center">
        <caption>
            <h1><u>View From Database</u></h1>
        </caption>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>SSN</th>
            <th>Department</th>
            <th>Salary</th>
            <th>Home Address</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>

        <?php
        $sql = "SELECT * FROM emp_record";
        $stmt = $conn->query($sql);
        while ($DataRows = $stmt->fetch()) {
            $Id = $DataRows["id"];
            $EName = $DataRows["ename"];
            $SSN = $DataRows["ssn"];
            $Department = $DataRows["dept"];
            $Salary = $DataRows["salary"];
            $HomeAddress = $DataRows["homeaddress"];
        ?>

            <tr>
                <td><?php echo $Id; ?></td>
                <td><?php echo $EName; ?></td>
                <td><?php echo $SSN; ?></td>
                <td><?php echo $Department; ?></td>
                <td><?php echo $Salary; ?></td>
                <td><?php echo $HomeAddress; ?></td>
                <td><a href="update.php?id=<?php echo $Id; ?>">Update</a></td>
                <td><a href="delete.php?id=<?php echo $Id; ?>">Delete</a></td>
            </tr>
        <?php } ?>

    </table>
    <div class="">

    </div>

</body>

</html>