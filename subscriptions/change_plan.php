<?php
require_once('session_check.php');
require_once("../Stripe/Stripe.php");

Stripe::setApiKey("sk_test_6jbgLGl89PNJJJOjUg536nxZ");

if (isset($_GET['plan']))
{
   try
   {
        $customer = Stripe_Customer::retrieve($user->stripe_id);
        $subscription = $customer->subscriptions->retrieve($user->subscription_id);
        $subscription->plan = $_GET['plan'];
        $subscription->save();
   }
   catch (Stripe_CardError $e)
   {
        $error = $e->message;
   }


    changePlan($_GET['plan'], $user->id);
}

header('location: admin.php');
