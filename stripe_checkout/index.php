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
        <h1>Secrets of the Universe: An Ebook</h1>
        <p class="book glyphicon glyphicon-book text-success"></p>
        <p>$50 - PDF</p>
        <p>"The last book you'll ever need to read..."</p>
        <p>- Joe Smith</p>
        <form action="process.php" method="POST">
            <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                data-key="pk_5v9yf3ROeeamg0MHX0ePPMg6WlueM"
                data-amount="5000">
            </script>
        </form>
    </div>
</body>
</html>
