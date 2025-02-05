<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin'){
    header('location: ../accueil.php');
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Cinewave</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../styles/main.css">
    <link rel="icon" type="image/x-icon" href="../assets/images/icons/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body>
<header>
    <nav>
        <div id="logo_container">
            <a href="accueil.php"> <img src="../assets/images/header/Logo.png" alt="logo cinewave" width="100" height="60"></a>
        </div>

        <div id="navlinks">
            <a href="../accueil.php" class="navlink">Accueil</a>
            <a href="../film.php" class="navlink">Films</a>
            <a href="../serie.php" class="navlink">Séries</a>
            <a href="../abonnement.php" class="navlink" id="abonnement_link">S'abonner</a>
        </div>
        <form action="#">
            <input type="submit" value="chercher" id="search_button">
            <input type="text" placeholder="From..." id="searchbar">
        </form>

        <a href="<?= empty($user) ? "connexion.php":"profile.php" ?>" class="navlink">
            <img src="../assets/images/header/connexion.svg" alt="logo cinewave" width="25" height="25">
        </a>
    </nav>
</header>
    <div class="admin_menu">
        <p class="menu_text">Menu</p>
        <button class="button_menu">Tableau de Bord </button>
        <button class="button_menu">Gestion des Utilisateurs</button>
        <button class="button_menu">Gestion du Contenu</button>
        <button class="button_menu">Gestion des Médias</button>
        <button class="button_menu">Configuration du Site</button>
        <button class="button_menu">Statistiques et Rapports</button>
        <button class="button_menu">Gestion des Commentaires et Avis</button>
        <button class="button_menu">Sécurité et Permissions</button>
        <button class="button_menu">Extensions et Modules</button>
        <button class="button_menu" onclick="showGraph()">Afficher la Carte Graphique</button>
    </div>
    <div id="graph" class="hidden">
        <canvas id="myChart"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function showGraph() {
            document.getElementById('graph').classList.toggle('hidden');
            const ctx = document.getElementById('myChart').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin'],
                    datasets: [{
                        label: 'Visites',
                        data: [12, 19, 3, 5, 2, 3],
                        backgroundColor: 'rgba(0, 0, 0, 0)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 2
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    </script>
</body>

