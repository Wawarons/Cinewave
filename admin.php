<?php
include('./includes/header.php')
?>
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
