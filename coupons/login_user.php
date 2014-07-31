<?php
require_once('database.php');

$error = '';

if (!empty($_POST))
{
    if ($_POST['username'] && $_POST['password'])
    {
        $user = getUser($_POST['username']);

        if ($user)
        {
            if (password_verify($_POST['password'], $user->password))
            {
                session_start();

                $_SESSION['username'] = $user->username;

                header("location: admin.php");
            }
            else
            {
                $error .= "Your username and/or password are incorrect.";
            }
        }
        else
        {
            $error .= "Your username and/or password are incorrect.";
        }

    }
    else
    {
        $error .= "A username and password are required to login.";
    }
}

