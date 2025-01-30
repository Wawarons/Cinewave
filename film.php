<?php
include("includes/header.php");
include("includes/contentQueries.php");

// Récupérer les données des films
$dataMovies = getFilms();

// Diviser les films en sections de 5
$chunks = array_chunk($dataMovies, 5);
?>
<div class="align_movie">
    <?php
    // Parcourir les sections
    foreach ($chunks as $sectionIndex => $movies) {
        echo "<div class='movie-row'>"; // Chaque section devient une ligne
        foreach ($movies as $film) {
            echo "<div class='containt_affiche'>
                     <div class='poster'>
                        <a href='about.php?type=film&title=" . htmlspecialchars($film['title'], ENT_QUOTES, 'UTF-8') . "'>
                            <img src='" . htmlspecialchars($film['image'], ENT_QUOTES, 'UTF-8') . "' alt='affiche de film' class='poster-image'>
                        </a>
                        <div class='rate-container'>
                            <span class='rating-text'>4.2/5</span>
                            <img src='assets/images/hearth.svg' alt='heart icon' width='10px' height='10px'>
                        </div>
                     </div>
                 </div>";
        }
        echo "</div>"; // Fin de la ligne
    }
    ?>
</div>