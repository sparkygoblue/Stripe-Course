<?php
require_once("../Stripe/Stripe.php");
require_once("database.php");

Stripe::setApiKey("sk_test_6jbgLGl89PNJJJOjUg536nxZ");

$error = '';

if (isset($_POST['stripeToken']))
{
    if($_POST['username'] && $_POST['password'])
    {
        try
        {
             $customer = Stripe_Customer::create(array(
              "card" => $_POST['stripeToken'],
              "plan" => $_POST['plan'],
            ));
        }
        catch (Stripe_CardError $e)
        {
            $error .= $e->message.'<br>';
        }

        saveUserInfo($_POST['username'],
                $_POST['password'],
                $_POST['plan'],
                $customer->subscriptions['data'][0]->id,
                $customer->id,
                $customer->cards->data[0]['last4']
            );

        session_start();

        $_SESSION['username'] = $_POST['username'];

        header('location: admin.php');
    }
    else
    {
        $error .= 'Username and password are required to store your payment info.<br>';
    }
}
