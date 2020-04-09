<hr>

<a href="index.php">Főoldal</a>

<?php if(!IsUserLoggedIn()) : ?>
    <a href=<?='index.php?P=login' ?> >Belépés</a>
    <a href=<?='index.php?P=register' ?> >Regisztráció</a>
<?php else: ?>
    <a href=<?='index.php?P=logout' ?> >Kijelentkezés</a>

<?php endif; ?>