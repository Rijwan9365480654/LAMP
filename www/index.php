<html>

<?php
if (isset($_POST["Submit"])) {
    //Check if Name is Empty
    if (empty($_POST["Name"])) {
        $NameError = "(Name is Required)";
    } else {
        $Name = Test_User_Input($_POST["Name"]);
        if (!preg_match("/^[A-Za-z. ]*$/", $Name)) {
            $NameError = "(Only Letters and WhiteSpaces are allowed)";
        }
    }

    if (empty($_POST["Email"])) {
        $EmailError = "(Email is Required)";
    } else {
        $Email = Test_User_Input($_POST["Email"]);
        if (!preg_match("/[A-Za-z0-9._-]{3,}@[A-Za-z0-9._-]{3,}[.]{1}[A-Za-z0-9._-]{2,}/", $Email)) {
            $EmailError = "(Invalid Email Format)";
        }
    }

    if (empty($_POST["Gender"])) {
        $GenderError = "(Gender is Required)";
    } else {
        $Gender = Test_User_Input($_POST["Gender"]);
    }

    if (empty($_POST["Website"])) {
        $WebsiteError = "(Website is Required)";
    } else {
        $Website = Test_User_Input($_POST["Website"]);
        if (!preg_match("/(https:|ftp:)\/\/+[a-zA-Z0-9.\-_\/?\$=&\#\~`!]+\.[A-Za-z0-9.\-_\/?\$=&\#\~`!]*/", $Website)) {
            $WebsiteError = "(Invalid Website Format)";
        }
    }
}
function Test_User_Input($Data)
{
    return $Data;
}

?>

<head>
    <title>Validation form in PHP</title>
</head>

<BODY>
    <?php
    echo "<h2>Form Validation with PHP</h2>";
    ?>
    <form action="" method="POST">
        <legend>* Please fill out the following fields</legend>
        <fieldset>
            <?php
            if (isset($_POST["Submit"])) {
                if (!empty($_POST["Name"]) && !empty($_POST["Email"]) && !empty($_POST["Gender"]) && !empty($_POST["Website"])) {
                    if (preg_match("/^[A-Za-z. ]*$/", $Name) == true && preg_match("/[A-Za-z0-9._-]{3,}@[A-Za-z0-9._-]{3,}[.]{1}[A-Za-z0-9._-]{2,}/", $Email) && preg_match("/(https:|ftp:)\/\/+[a-zA-Z0-9.\-_\/?\$=&\#\~`!]+\.[A-Za-z0-9.\-_\/?\$=&\#\~`!]*/", $Website)) {
                    } else {
                        echo "(Correct The Form & Submit Again)<br>";
                    }
                } else {
                    echo "(Fill all the Fields with *)<br>";
                }
            }

            ?>
            Name:*<br>
            <input class="input" type="text" name="Name" value=""><?php echo "$NameError"; ?><br>
            Email:*<br>
            <input class="input" type="email" name="Email" value=""><?php echo "$EmailError"; ?><br>
            Gender:*<br>
            <input class="radio" type="radio" name="Gender" value="Male">Male
            <input class="radio" type="radio" name="Gender" value="Female">Female <?php echo "$GenderError"; ?><br>
            Website:*<br>
            <input class="input" type="text" name="Website" value=""><?php echo "$WebsiteError"; ?><br>
            Comment:<br>
            <textarea name="Comment" rows="5" cols="25"></textarea><br>
            <input type="Submit" Name="Submit" Value="Submit">
        </fieldset>
    </form>

    <?php
    if (!empty($_POST["Name"]) && !empty($_POST["Email"]) && !empty($_POST["Gender"]) && !empty($_POST["Website"])) {
        if (preg_match("/^[A-Za-z. ]*$/", $Name) == true && preg_match("/[A-Za-z0-9._-]{3,}@[A-Za-z0-9._-]{3,}[.]{1}[A-Za-z0-9._-]{2,}/", $Email) && preg_match("/(https:|ftp:)\/\/+[a-zA-Z0-9.\-_\/?\$=&\#\~`!]+\.[A-Za-z0-9.\-_\/?\$=&\#\~`!]*/", $Website)) {
            echo "<h2><u>Your  Submitted Information</u></h2>";
            echo "Name: {$_POST["Name"]}<BR>";
            echo "Email: {$_POST["Email"]}<BR>";
            echo "Gender: {$_POST["Gender"]}<BR>";
            echo "Website: {$_POST["Website"]}<BR>";
            echo "Comment: {$_POST["Comment"]}<BR>";
        }
    }
    ?>
</BODY>

</html>