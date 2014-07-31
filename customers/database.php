<?php


function connectToDatabase()
{
    $database = 'stripe_course';
    $username = 'root';
    $password = 'root';

    $conn = new PDO("mysql:host=localhost;dbname={$database}", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $conn;
}

function saveUserInfo ($username, $password, $stripe_id, $last4)
{
    $mysql = connectToDatabase();

    $query = $mysql->prepare("INSERT INTO accounts (username, password, stripe_id, last4)
                    VALUES (:username, :password, :stripe_id, :last4)");

    $query->execute(array(
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'stripe_id' => $stripe_id,
            'last4' => $last4
        ));
}

function getUser ($username)
{
    $mysql = connectToDatabase();

    $query = $mysql->prepare("SELECT * FROM accounts  WHERE username = :username LIMIT 1");

    $query->execute(array(
            'username' => $username,
    ));

    return $query->fetch(PDO::FETCH_OBJ);
}

