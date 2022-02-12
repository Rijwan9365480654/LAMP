<?php
session_start();
function ErrorMessage()
{
    if (isset($_SESSION["ErrorMessage"])) {
        $Output = '<div class="alert alert-danger">' . htmlentities($_SESSION["ErrorMessage"]) . '</div>';
        $_SESSION["ErrorMessage"] = null;
        return $Output;
    }
}

function SuccessMessage()
{
    if (isset($_SESSION["SuccessMessage"])) {
        $Output = '<div class="alert alert-success">' . htmlentities($_SESSION["SuccessMessage"]) . '</div>';
        $_SESSION["SuccessMessage"] = null;
        return $Output;
    }
}
