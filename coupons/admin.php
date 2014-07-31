<?php require_once('session_check.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Subscriptions</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div>
                <div class="pull-left">Logged in user: <?php echo $user->username; ?></div>
                <div class="pull-right"><a href="logout.php">logout</a></div>
            </div>
        </div>
        <div class="row">
            <h1 class="text-center">User Admin</h1>
        </div>
        <div class="row">
            <div class="col-md-offset-3 col-md-6">
                <p>Current Plan: <?php echo $user->plan; ?></p>
                <ul>
                    <?php if ($user->plan == 'basic'): ?>
                        <li><a href="change_plan.php?plan=premium">Upgrade to the Premium Plan ($100 / Month)</a></li>
                    <?php else: ?>
                        <li><a href="change_plan.php?plan=basic">Downgrade to the Basic Plan ($50 / Month)</a></li>
                    <?php endif; ?>
                    <li><a href="cancel.php">Cancel my subscripion</a></li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
