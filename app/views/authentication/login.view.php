<html lang="en">
<head>
    <title>Dymamic Tree</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/main.css">
</head>
<body>
<div class="container">
    <div class="login-form">
        <div class="login form">
            <header>Login</header>
            <form method="POST">
                <?php if(isset($errors)):?>
                <div class="error">
                    <?= implode("<br>", $errors) ?>
                </div>
                <?php endif;?>
                <input name="username" type="text" placeholder="Enter your username">
                <input name="password" type="password" placeholder="Enter your password">
                <button type="submit"  class="submit-button">Login</button>
            </form>
            <div class="signup">
        <span class="signup">Don't have account yet?
         <a href="home/register">Signup</a>
        </span>
            </div>
        </div>
    </div>
</div>
</body>
</html>
