<?php require_once 'protected/config.php'; ?>



<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href = "<?=PUBLIC_DIR.'style.css'; ?>">
</head>
<body>
    <div id = "page">
        <header><?php include_once PROTECTED_DIR.'header.php' ?></header>
        <nav><?php require_once PROTECTED_DIR.'nav.php' ?></nav>
        <content><?php require_once PROTECTED_DIR.'routing.php' ?></content>
        <footer><?php include_once PROTECTED_DIR.'footer.php' ?></footer>
    </div>
</body>
</html>