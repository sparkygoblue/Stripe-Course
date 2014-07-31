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
              "coupon" => $_POST['code'] ? $_POST['code'] : NULL
            ));

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
        catch (Exception $e)
        {
            $error .= "There was a problem with your signup.  Make sure your coupon code is correct.";
        }




    }
    else
    {
        $error .= 'Username and password are required to store your payment info.<br>';
    }
}
