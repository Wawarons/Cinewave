<?php

require_once 'includes/header.php';

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
} else {
    header('Location: accueil.php');
}

?>


<div class="account-choice">
    <div class="bloc">
        <a href="user/account.php" class="choice">
                <img src="assets/images/icons/account.svg" alt="account" width="80" height="80"/>
                <p>Compte</p>
        </a>

        <a href="user/favoris.php" class="choice">
            <img  src="assets/images/icons/favorite.svg" alt="favorite" width="80" height="80"/>
            <p>Favorite</p>
        </a>
    </div>
    <div class="bloc">
        <a href="user/abonnement.php" class="choice">
            <img  src="assets/images/icons/subscribe.svg" alt="subscribe" width="80" height="80"/>
            <p>Abonnement</p>
        </a>
        <a href="user/parametre.php" class="choice">
            <img  src="assets/images/icons/settings.svg" alt="settings" width="80" height="100"/>
            <p>Paramètres</p>
        </a>
    </div>

</div>