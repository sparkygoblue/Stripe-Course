<?php

//var_dump($_POST);

require_once("../Stripe/Stripe.php");

Stripe::setApiKey("sk_test_6jbgLGl89PNJJJOjUg536nxZ");

if (isset($_POST['stripeToken']))
{
  try
  {
    Stripe_Charge::create(array(
      "amount" => 2000,
      "currency" => "usd",
      "card" => $_POST['stripeToken']
    ));

    echo "<h1>Thanks for purchasing our headphones</h1>";
    echo "<p>Your order will be shipped to:</p>";
    echo $_POST['stripeShippingName'].'<br>';
    echo $_POST['stripeShippingAddressLine1'].'<br>';
    echo $_POST['stripeShippingAddressCity'].', ';
    echo $_POST['stripeShippingAddressState'].'  ';
    echo $_POST['stripeShippingAddressZip'];

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





