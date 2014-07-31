<?php
require_once('database.php');

session_start();

if (isset($_SESSION['username']))
{
    if (!$user = getUser($_SESSION['username']))
    {
        session_destroy();
        header("location: login.php");
    }
}
else
{
    header("location: login.php");
}
