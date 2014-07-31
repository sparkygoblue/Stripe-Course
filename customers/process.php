<?php
require_once("../Stripe/Stripe.php");
require_once("database.php");

Stripe::setApiKey("sk_test_6jbgLGl89PNJJJOjUg536nxZ");

$error = '';

if (isset($_POST['stripeToken']))
{
    if (isset($_POST['account']))
    {
        if($_POST['username'] && $_POST['password'])
        {
            $customer = Stripe_Customer::create(array(
              "card" => $_POST['stripeToken'],
            ));

            saveUserInfo($_POST['username'], $_POST['password'], $customer->id, $customer->cards->data[0]['last4']);
        }
        else
        {
            $error .= 'Username and password are required to store your payment info.<br>';
        }
    }
    if (!$error)
    {
        try
        {
            if (isset($customer))
            {
                Stripe_Charge::create(array(
                  "amount" => 50000,
                  "currency" => "usd",
                  "customer" => $customer->id
                ));
            }
            else
            {
                Stripe_Charge::create(array(
                  "amount" => 50000,
                  "currency" => "usd",
                  "card" => $_POST['stripeToken']
                ));
            }

            header("location: success.php");
        }
        catch (Stripe_CardError $e)
        {
            $error .= $e->message.'<br>';
        }
    }
}
