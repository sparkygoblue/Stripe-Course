<?php
require_once('session_check.php');
require_once("../Stripe/Stripe.php");

Stripe::setApiKey("sk_test_6jbgLGl89PNJJJOjUg536nxZ");

try
{
    $customer = Stripe_Customer::retrieve($user->stripe_id);
    $subscription = $customer->subscriptions->retrieve($user->subscription_id);
    $subscription->cancel();
}
catch (Exception $e)
{
    $error = $e->message;
}

deleteUser($user->id);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Coupons</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <h1 class="text-center">Your subscription has been canceled</h1>
        </div>
    </div>
</body>
</html>
