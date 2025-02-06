<?php
if(empty($_GET['title'])){
    header('Location: accueil.php');
}
require_once 'includes/header.php';
require_once 'includes/contentQueries.php';

$title = $_GET['title'];

$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$results = searchFilm($title, $current_page);
$total_pages = $results['total_pages'];
$limit = 10;
$start = max(1, $current_page - floor($limit / 2));
$end = min($total_pages, $start + $limit - 1);

?>
<h1 id="search-title">Resultat: <?= $title ?></h1>
<div id="search-container">
    <?php
        if(!empty($results['results'])){
            foreach($results['results'] as $result){
                $posterPath = !empty($result['poster_path'])
                    ? "https://image.tmdb.org/t/p/w200" . $result['poster_path']
                    : "https://placehold.co/200x300?text=No+Image";
                echo "
                <div class='search-item'>
                <a href='about.php?movie_id=".$result['id']."'>
                    <img class='search-item-content' src='$posterPath' alt='".$result['title']."'>
                </a>
                </div>
                ";
            }
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
        echo '<li><a href="?title='. $title . '&page=' . $i . '">' . $i . '</a></li>';
    }
}

// Bouton Suivant
if ($current_page < $total_pages) {
    echo '<li><a href="?title='. $title . '&page=' . ($current_page + 1) . '">Suivant</a></li>';
}

echo '</ul></nav>';
?>
