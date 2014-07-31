<?php

require_once("../Stripe/Stripe.php");

Stripe::setApiKey("sk_test_6jbgLGl89PNJJJOjUg536nxZ");

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $event = json_encode(file_get_contents("php://input"));

    if ($event->type == 'charge.failed')
    {
        try
        {
            $id = $event->data->object->customer;
            $customer = Stripe_Customer::retrieve($id);
            $last_4 = $customer->cards->data[0]['last4'];

            $email_to = $customer->email;
            $email_body = "Hello,\r\nWe have attempted to charge your credit card ending in {$last4}
            for your monthly fee, but the charge was denied.  Please log in and update your credit
            card info as a soon as possible.\r\n\r\n Thank you";

            mail($email_to, "Credit card denied", $email_body, "From: support@mail.com\r\n");
        }
        catch (Exception $e)
        {}
    }
}
