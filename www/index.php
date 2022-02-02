<html>

<head>
    <title>Validation form in PHP</title>
</head>

<BODY>
    <?php
    echo "It is a test page";
    ?>
    <form action="" method="POST">
        <legend>* Please fill out the following fields</legend>
        <fieldset>
            Name:<br>
            <input class="input" type="text" name="Name" value=""><br>
            Email:<br>
            <input class="input" type="email" name="Email" value=""><br>
            Gender:<br>
            <input class="radio" type="radio" name="Gender" value="Male">Male
            <input class="radio" type="radio" name="Gender" value="Female">Female<br>
            Website:<br>
            <input class="input" type="text" name="Website" value=""><br>
            Comment:<br>
            <textarea name="Comment" rows="5" cols="25"></textarea><br>
            <input type="Submit" Name="Submit" Value="Submit">
        </fieldset>
    </form>
</BODY>

</html>