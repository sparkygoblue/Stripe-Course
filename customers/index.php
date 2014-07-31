<?php require_once('process.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Customers</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div class="container">
            <div class="row">
                <div class="col-sm-5">
                    <div class="text-center">
                        <h1>Purchase A Course</h1>
                        <p>Secrets of the Universe: The Online Course - $500</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <form method="post" class="form-horizontal" id="payment-form">
                    <span class="payment-errors text-danger"></span>
                    <?php if ($error): ?>
                        <span class="payment-errors text-danger"><?php echo $error; ?></span>
                    <?php endif; ?>
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
                    <div class="form-group">
                        <div class="col-sm-offset-1 col-sm-4">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" class="account-checkbox" name="account"> Store my payment info
                            </label>
                          </div>
                        </div>
                    </div>
                    <div class="account-info hidden">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Username:</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control username" name="username">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Password:</label>
                            <div class="col-sm-3">
                                <input type="password" class="form-control password" name="password">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="text-center">
                            <button type="submit" class="btn btn-success">Unlock the Secrets Now</button>
                            <p>
                                Already have an account?
                                <a href="login.php">Click here to login.</a>
                            </p>
                        </div>
                    </div>
                </form>
            </div>
    </div>

    <script src="https://js.stripe.com/v2/"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="../js/jquery.payment.js"></script>
    <script>
        Stripe.setPublishableKey("pk_5v9yf3ROeeamg0MHX0ePPMg6WlueM");

        $('.cc-number').payment('formatCardNumber');
        $('.cc-cvc').payment('formatCardCVC');
        $('.cc-exp-date').payment('formatCardExpiry');

        $('.account-checkbox').on('change', function(event){
            $('.account-info').toggleClass('hidden');
        });


        var $form = $('#payment-form');

        $form.on('submit', function(event){

            event.preventDefault();

            var charge_card = true;

            if ($('.account-checkbox').is(':checked'))
            {

                if ($('.username').val() == '' || $('.password').val() == '')
                {
                    charge_card = false;
                    $form.find('.payment-errors').text('A username and password are required to store your payment info.');
                }
            }

            if (charge_card)
            {
                var date = $('.cc-exp-date').payment('cardExpiryVal');

                $form.find('button').prop('disabled', true);

                Stripe.card.createToken({
                    number: $('.cc-number').val(),
                    cvc: $('.cc-cvc').val(),
                    exp_month: date.month,
                    exp_year: date.year
                }, stripeHandler);
            }
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
