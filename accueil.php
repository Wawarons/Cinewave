<?php
include('includes/header.php');
include('includes/contentQueries.php');
$films = getPopularFilms(); // Récupère les 15 premiers films
$series = getPopularSeries();
?>
    <!-- En-tête de la page d'accueil -->
    <div id="trailer_accueil">
        <video autoplay muted> <!-- Intégration trailer -->
            <source src="https://bright-crimson-sloth.myfilebase.com/ipfs/QmW5a61c76h4bek76cL3RAwp7U1D39QVk27JZSqe3RuLYe">
        </video>
        <a id="bouton_regarder" href="#">Regarder</a>
    </div>

    <!-- Contenu de la page d'accueil -->
    <!-- Conteneur des films -->
    <div class="top">
        <h2>FILMS</h2>
        <div class="top_contenu">
            <?php
            foreach ($films['results'] as $index => $film) {

                echo "
                 <div class='poster'>
                    <a href='about.php?movie_id=" . htmlspecialchars($film['id'], ENT_QUOTES, 'UTF-8') . "'>
                        <img src='https://image.tmdb.org/t/p/w400" . htmlspecialchars($film['poster_path'], ENT_QUOTES, 'UTF-8') . "' alt='affiche de film' class='poster-image'>
                    </a>
                 </div>
                ";
            }
            ?>
        </div>
    </div>

    <!-- Conteneur des séries -->
 <div class="top">
        <h2>SÉRIES</h2>
        <div class="top_contenu">
           <?php 
            foreach ($series['results'] as $index => $serie) {

                echo "
                 <div class='poster'>
                    <a href='about.php?serie_id=" . htmlspecialchars($serie['id'], ENT_QUOTES, 'UTF-8') . "'>
                        <img src='https://image.tmdb.org/t/p/w400" . htmlspecialchars($serie['poster_path'], ENT_QUOTES, 'UTF-8') . "' alt='affiche de film' class='poster-image'>
                    </a>
                 </div>
                ";
            }
          ?>
        </div>
    </div>
<div class="popup" id="popup">
        <h2>Offre Spéciale !</h2>
        <p>Abonnez-vous dès maintenant et profitez de 20% de réduction !</p>
        <a  href="abonnement.php">En profiter</a>
        <button id="close" onclick="closePopup()">Fermer</button>
    </div>

    <script>
        window.onload = function() {
            document.getElementById("popup").style.display = "block";
            document.getElementById("overlay").style.display = "block";
        };
        function closePopup() {
            document.getElementById("popup").style.display = "none";
            document.getElementById("overlay").style.display = "none";
        }
    </script>
<?php include('includes/footer.php'); ?>
