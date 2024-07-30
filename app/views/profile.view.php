<?php

?>

<html lang="en">
<head>
    <title>Dymamic Tree</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/main.css">
    <script src="<?=ROOT?>/assets/js/main.js"></script>
</head>
<body>
<div class="header" style="align-items: center">
    <h1 class="hi-text">Hi, <?php echo $_SESSION['username']?>!</h1>
    <?php if (!empty($_SESSION['username'])) :?>
    <a class='logout-button' href="<?=ROOT?>/home/logout">
        <img src='<?=ROOT?>/assets/images/logout-icon.svg' alt='edit'>
    </a>
    <?php endif;?>
</div>
<div class="container">

</div>
</body>
</html>
