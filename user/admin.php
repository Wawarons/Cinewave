<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Vérifier si l'utilisateur est connecté et admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    header('location: ../accueil.php');
    exit;
}


?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Cinewave - Tableau de Bord</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../styles/main.css">
    <link rel="icon" type="image/x-icon" href="../assets/images/icons/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body>
<header>
    <nav>
        <div id="logo_container">
            <a href="../accueil.php">
                <img src="../assets/images/header/Logo.png" alt="logo cinewave" width="100" height="60">
            </a>
        </div>

        <div id="navlinks">
            <a href="../accueil.php" class="navlink">Accueil</a>
            <a href="../film.php" class="navlink">Films</a>
            <a href="../serie.php" class="navlink">Séries</a>
            <a href="../abonnement.php" class="navlink" id="abonnement_link">S'abonner</a>
        </div>
        <form action="#">
            <input type="submit" value="chercher" id="search_button">
            <input type="text" placeholder="Rechercher..." id="searchbar">
        </form>

        <a href="<?= empty($_SESSION['user']) ? 'connexion.php' : 'profile.php' ?>" class="navlink">
            <img src="../assets/images/header/connexion.svg" alt="connexion" width="25" height="25">
        </a>
    </nav>
</header>

<div class="admin_menu">
    <p class="menu_text">Menu</p>
    <button class="button_menu" onclick="showGraph()">Tableau de Bord</button>
    <button class="button_menu">Gestion des Utilisateurs</button>
    <button class="button_menu">Gestion du Contenu</button>
    <button class="button_menu">Gestion des Médias</button>
    <button class="button_menu">Configuration du Site</button>
    <button class="button_menu">Statistiques et Rapports</button>
    <button class="button_menu">Gestion des Commentaires et Avis</button>
    <button class="button_menu">Sécurité et Permissions</button>
    <button class="button_menu">Extensions et Modules</button>
</div>

<div id="graph" class="hidden">
    <canvas id="myChart"></canvas>


</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    function showGraph() {
        // Afficher ou masquer la section des graphiques
        document.getElementById('graph').classList.toggle('hidden');

        // Configuration du graphique avec Chart.js
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin'],
                datasets: [
                    {
                        label: 'Visites',
                        data: [12, 19, 3, 5, 2, 3],
                        borderColor: 'rgba(255, 99, 132, 1)',
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderWidth: 2
                    },
                    {
                        label: 'Abonnement',
                        data: [5, 15, 8, 10, 20, 25],
                        borderColor: 'rgba(54, 162, 235, 1)',
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderWidth: 2
                    },
                    {
                        label: 'Revenue Crypto',
                        data: [10, 50, 20, 30, 40, 75],
                        borderColor: 'rgba(178, 197, 27, 0.8)',
                        backgroundColor: 'rgba(178, 197, 27, 0.8)',
                        borderWidth: 2
                    }
                ]
            },
            options: {
                responsive: true,
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
</html>
