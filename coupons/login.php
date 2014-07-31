<?php require_once('login_user.php'); ?>
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
            <div class="col-md-12">
                <h1 class="text-center">Login</h1>
                <?php if ($error): ?>
                    <p class="text-center text-danger"><?php echo $error; ?></p>
                <?php endif; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-offset-4 col-md-4">
                <form action="" method="post">
                    <div class="form-group">
                        <label class="control-label">Username:</label>
                        <input type="text" class="form-control" name="username">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Password:</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
