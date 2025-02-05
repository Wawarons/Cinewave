<?php
include("includes/header.php");
include("includes/contentQueries.php");

// Récupérer les données des films
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$dataMovies = getPopularSeries($current_page);
$total_pages = $dataMovies['total_pages'];
$limit = 10;
$start = max(1, $current_page - floor($limit / 2));
$end = min($total_pages, $start + $limit - 1);
$start = max(1, $end - $limit + 1);


// Diviser les films en sections de 5
$chunks = array_chunk($dataMovies['results'], 5);
?>
<div id="content-container">
    <?php
    // Parcourir les sections
    foreach ($chunks as $sectionIndex => $series) {
        echo "<div class='movie-row'>"; // Chaque section devient une ligne
        foreach ($series as $serie) {
            $posterPath = !empty($serie['poster_path'])
                ? "https://image.tmdb.org/t/p/w200" . $serie['poster_path']
                : "https://placehold.co/200x300?text=No+Image";
            echo "<div class='content'>
                     <div class='poster'>
                        <a href='about.php?serie_id=" . htmlspecialchars($serie['id'], ENT_QUOTES, 'UTF-8') . "&saison=1'>
                            <img src='". $posterPath ."' alt='affiche de film' class='poster-image'>
                        </a>
                        <div class='rate-container'>
                            <span class='rating-text'>
                            " .round($serie['vote_average'], 1) . "
</span>
                            <img src='assets/images/icons/hearth.svg' alt='heart icon' width='10px' height='10px'>
                        </div>
                        </div>
                        
                 </div>";
        }
        echo "</div>";
    }
    ?>
</div>

<?php
echo '<nav><ul class="pagination">';

// Bouton Précédent
if ($current_page > 1) {
    echo '<li><a href="?page=' . ($current_page - 1) . '">Précédent</a></li>';
}

// Liens de pages
for ($i = $start; $i <= $end; $i++) {
    if ($i == $current_page) {
        echo '<li class="active"><span>' . $i . '</span></li>';
    } else {
        echo '<li><a href="?page=' . $i . '">' . $i . '</a></li>';
    }
}

// Bouton Suivant
if ($current_page < $total_pages) {
    echo '<li><a href="?page=' . ($current_page + 1) . '">Suivant</a></li>';
}

echo '</ul></nav>';
?>
