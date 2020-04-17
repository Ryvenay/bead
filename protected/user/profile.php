<?php if (!isUserLoggedIn()) : ?>
    <?php header('Location: index.php?P=login'); ?>

<?php else: ?>
    <?php 
        $query= "SELECT `first_name`, `last_name`, `email`, `address`, `zip`, `city`, `country` FROM `users` WHERE id = :id";
        $params = [
            ':id' => $_SESSION['uid']
        ];
        require_once DATABASE_CONTROLLER;
        $userData = getRecord($query, $params);
    ?>
    <h2>Profil</h2>
    <div class = "row">
        <div class = "col">
            <h3>Fiók adatok</h3>
            <p class ="profile">Név: <?=$userData['first_name'].' '.$userData['last_name'] ?></p>
            <p class ="profile">Email: <?=$userData['email']; ?> </p>
        </div>
        <div class = "col">
            <h3>Szállítási adatok</h3>
            <p class ="profile">Szállítási név: <?=$userData['first_name'].' '.$userData['last_name'] ?></p>
            <p class ="profile">Cím:</p>
            <address><?=$userData['address'].'<br>'.$userData['zip'].' '.$userData['city'].'<br>'.$userData['country'] ?></address>

        </div>

    </div>

<?php endif; ?>