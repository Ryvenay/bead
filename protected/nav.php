<hr>
<div class ="row justify-content-md-center">
    <div class = "col align-self-start">
        <div class ="menuitem"><a href="index.php">Főoldal</a></div>
        <?php if(isUserLoggedIn() && $_SESSION['permission'] >= 1) : ?>
            <div class ="menuitem"><a href = "index.php?P=addProduct">Termék hozzáadás</a></div>
        <?php endif; ?>
    </div>

    <div class = "align-self-center">
        <div class = "menuitem"><a href = "index.php?P=listProducts&category=Gitár">Gitárok</a></div>
        <div class = "menuitem"><a href = "index.php?P=listProducts&category=Effekt">Effektek</a></div>
        <div class = "menuitem"><a href = "index.php?P=listProducts&category=Erősítő">Erősítők</a></div>
        <div class = "menuitem"><a href = "index.php?P=listProducts&category=Kiegészítő">Kiegészítők</a></div>
        
    </div>

    <div class="col align-self-end text-right" id = "usermenu">
        <?php if(!IsUserLoggedIn()) : ?>
            <div class ="menuitem"><a href=<?='index.php?P=login' ?> >Belépés</a></div>
            <div class ="menuitem"><a href=<?='index.php?P=register' ?> >Regisztráció</a></div>
        <?php else: ?>
            <div class ="menuitem"><a href=<?='index.php?P=cart' ?> >Kosár</a></div>
            <div class ="menuitem"><a href=<?='index.php?P=profile' ?> >Profil</a></div>
            <div class ="menuitem"><a href=<?='index.php?P=logout' ?> >Kijelentkezés</a></div>
        <?php endif; ?>
    </div>
</div>
<hr>
