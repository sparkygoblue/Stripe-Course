<?php
require_once("../Stripe/Stripe.php");
require_once('database.php');

Stripe::setApiKey("sk_test_6jbgLGl89PNJJJOjUg536nxZ");

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

if (isset($_POST['purchase']))
{
    try
    {
        Stripe_Charge::create(array(
          "amount" => 50000,
          "currency" => "usd",
          "customer" => $user->stripe_id
        ));

        header("location: success.php");
    }
    catch (Stripe_CardError $e)
    {
        $error .= $e->message.'<br>';
    }
}
