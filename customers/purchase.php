<?php require_once('process_logged_in.php'); ?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Purchase</title>
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/styles.css">
    </head>

    <body>
        <div class="container">
            <div class="row">
                <div>
                    <div class="pull-left">Logged in user: <?php echo $user->username ?></div>
                    <div class="pull-right"><a href="logout.php">logout</a></div>
                </div>
            </div>
            <div class="row">
                <div class="text-center">
                    <h1>Purchase a Course</h1>
                    <p>Secrets of the Universe: The Online Course Part II Electric Boogaloo - $500</p>
                    <form action="" method="post">
                        <input type="hidden" name="purchase" value="1">
                        <button type="submit" class="btn btn-primary">Purchase With Card Ending With - <?php echo $user->last4; ?></button>
                    </form>
                </div>
            </div>
        </div>

    </body>
</html>
