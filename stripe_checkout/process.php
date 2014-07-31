<?php

//var_dump($_POST);

require_once("../Stripe/Stripe.php");

Stripe::setApiKey("sk_test_6jbgLGl89PNJJJOjUg536nxZ");

if (isset($_POST['stripeToken']))
{
  try
  {
    Stripe_Charge::create(array(
      "amount" => 5000,
      "currency" => "usd",
      "card" => $_POST['stripeToken']
    ));

    header("location: success.php");
  }
  catch (Stripe_CardError $e)
  {
    header("location: card_error.php");
  }

}
else
{
  header("location: index.php");
}





