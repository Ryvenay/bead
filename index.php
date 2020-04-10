<?php session_start(); ?>

<?php require_once 'protected/config.php'; ?>
<?php require_once PROTECTED_DIR.'userManager.php'; ?>
<?php require_once PRODUCT_DIR.'/productManager.php';?>



<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>ketamin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href = "<?=PUBLIC_DIR.'style.css'; ?>">
</head>
<body>
    <div class = "container">
        <header><?php include_once PROTECTED_DIR.'header.php' ?></header>
        <nav><?php require_once PROTECTED_DIR.'nav.php' ?></nav>
        <content><?php require_once PROTECTED_DIR.'routing.php' ?></content>
        <footer><?php include_once PROTECTED_DIR.'footer.php' ?></footer>
    </div>
</body>
</html>