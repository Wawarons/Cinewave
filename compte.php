<?php

require_once 'includes/header.php';

if(isset($_SESSION['user'])){
    $user = $_SESSION['user'];
} else {
    header('Location: accueil.php');
}

?>


<div class="account-choice">
    <div class="bloc">
        <p class="choice">Gestion du compte</p>
        <p class="choice">Favoris</p>
    </div>
    <div class="bloc">
        <p class="choice">Abonnement</p>
        <p class="choice">Paramètre</p>
    </div>

</div>