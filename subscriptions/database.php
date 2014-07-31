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

function saveUserInfo ($username, $password, $plan, $subscription_id, $stripe_id, $last4)
{
    $mysql = connectToDatabase();

    $query = $mysql->prepare("INSERT INTO subscribers (username, password, plan, subscription_id, stripe_id, last4)
                    VALUES (:username, :password, :plan, :subscription_id, :stripe_id, :last4)");

    $query->execute(array(
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'plan' => $plan,
            'subscription_id' => $subscription_id,
            'stripe_id' => $stripe_id,
            'last4' => $last4
        ));
}

function getUser ($username)
{
    $mysql = connectToDatabase();

    $query = $mysql->prepare("SELECT * FROM subscribers WHERE username = :username LIMIT 1");

    $query->execute(array(
            'username' => $username,
    ));

    return $query->fetch(PDO::FETCH_OBJ);
}

function changePlan($plan, $id)
{
    $mysql = connectToDatabase();

    $query = $mysql->prepare("UPDATE subscribers SET plan = :plan WHERE id = :id");

    $query->execute(array(
        'plan' => $plan,
        'id' => $id
        ));
}

function deleteUser($id)
{
    $mysql = connectToDatabase();

    $query = $mysql->prepare("DELETE FROM subscribers WHERE id = :id");

    $query->execute(array(
        'id' => $id
        ));

}

