<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Custom Forms</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div class="container">
        <h1 class="text-center">Cool T-Shirts Inc.</h1>
        <p class="text-center">Shirt of the day - $20</p>
        <form action="process.php" method="post" class="form-horizontal" id="payment-form">
            <span class="payment-errors"></span>

            <h3>Shirt Options:</h2>

            <div class="form-group">
                <label for="color" class="col-sm-2 control-label">Color: </label>
                <div class="col-sm-4">
                    <select name="color" class="form-control">
                        <option value="blue">Blue</option>
                        <option value="maize">Maize</option>
                        <option value="lightgreen">Light Green</option>
                        <option value="peach">Peach</option>
                        <option value="maroon">Maroon</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="size" class="col-sm-2 control-label">Size: </label>
                <div class="col-sm-4">
                    <select name="size" class="form-control">
                        <option value="small">Small</option>
                        <option value="medium">Medium</option>
                        <option value="large">Large</option>
                        <option value="xl">Xtra Large</option>
                    </select>
                </div>
            </div>

            <h3>Shipping Address:</h2>

            <div class="form-group">
                <label for="street" class="col-sm-2 control-label">Address:</label>
                <div class="col-sm-4">
                    <input type="text" name="street" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="unit" class="col-sm-2 control-label">Apt/Unit/PO Box:</label>
                <div class="col-sm-4">
                    <input type="text" name="unit" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="city" class="col-sm-2 control-label">City:</label>
                <div class="col-sm-4">
                    <input type="text" name="city" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="state" class="col-sm-2 control-label">State:</label>
                <div class="col-sm-1">
                    <input type="text" name="state" class="form-control">
                </div>
                <label for="zip" class="col-sm-1 control-label">Zipcode:</label>
                <div class="col-sm-2">
                    <input type="text" name="zip" class="form-control">
                </div>
            </div>

            <h3>Payment Info:</h2>

            <div class="form-group">
                <label class="col-sm-2 control-label">Card Number:</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control cc-number" size="20">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">CVC:</label>
                <div class="col-sm-1">
                    <input type="text" class="form-control cc-cvc" size="4">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Expiration:</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control cc-exp-date" placeholder="MM/YYYY">
                </div>
            </div>
            <div class="col-sm-offset-2 col-sm-4">
                <button type="submit" class="btn btn-success btn-block">Send Me My Cool T-Shirt</button>
            </div>
        </form>
    </div>
    <script src="https://js.stripe.com/v2/"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="../js/jquery.payment.js"></script>
    <script>
        Stripe.setPublishableKey("pk_5v9yf3ROeeamg0MHX0ePPMg6WlueM");

        $('.cc-number').payment('formatCardNumber');
        $('.cc-cvc').payment('formatCardCVC');
        $('.cc-exp-date').payment('formatCardExpiry');

        var $form = $('#payment-form');

        $form.on('submit', function(event){

            event.preventDefault();

            var date = $('.cc-exp-date').payment('cardExpiryVal');

            $form.find('button').prop('disabled', true);

            Stripe.card.createToken({
                number: $('.cc-number').val(),
                cvc: $('.cc-cvc').val(),
                exp_month: date.month,
                exp_year: date.year
            }, stripeHandler);

        });

        var stripeHandler = function(status, response)
        {
            if (response.error)
            {
                $form.find('.payment-errors').text(response.error.message);
                $form.find('button').prop('disabled', false);
            }
            else
            {
                $form.append($('<input type="hidden" name="stripeToken">').val(response.id));
                $form[0].submit();
            }
        };

    </script>
</body>
</html>
