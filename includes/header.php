<?php session_abort() ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Cinewave</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="styles/main.css">
    <link rel="icon" type="image/x-icon" href="assets/images/icons/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body>
    <header>
        <nav>
            <div id="logo_container">
                <a href="accueil.php"> <img src="assets/images/header/Logo.png" alt="logo cinewave" width="100" height="60"></a>
            </div>

            <div id="navlinks">
                <a href="accueil.php" class="navlink">Accueil</a>
                <a href="film.php" class="navlink">Films</a>
                <a href="serie.php" class="navlink">Séries</a>
                <a href="abonnement.php" class="navlink" id="abonnement_link">S'abonner</a>
            </div>
                <form action="#">
                    <input type="submit" value="chercher" id="search_button">
                    <input type="text" placeholder="From..." id="searchbar">
                </form>

            <a href="connexion.php" class="navlink">
                <img src="assets/images/header/connexion.svg" alt="logo cinewave" width="25" height="25">
            </a>
        </nav>
    </header>