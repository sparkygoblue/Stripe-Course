<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Stripe Checkout Example</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div class="container text-center">
        <h1>Beats by Ray</h1>
        <p class="headphones glyphicon glyphicon-headphones text-info"></p>
        <p>$20</p>
        <form action="process.php" method="POST">
            <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                data-key="pk_5v9yf3ROeeamg0MHX0ePPMg6WlueM"
                data-amount="2000"
                data-shipping-address="true"
                data-email="test@mail.com"
                data-allow-remember-me="false">
            </script>
        </form>
    </div>
</body>
</html>
