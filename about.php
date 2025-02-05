<?php
include('includes/header.php');
include('includes/contentQueries.php');

$movieId = null;
$seriesId = null;
$item = [];
$credits = [];

if (isset($_GET['movie_id'])) {
    $movieId = $_GET['movie_id'];
    $item = getFilmById($movieId);
    $credits = getFilmCredits($movieId);
    $similarItems = getFilmSimilaire($movieId);
} else if (isset($_GET['serie_id'])) {
    $serieId = $_GET['serie_id'];
    $item = getSerieByID($serieId);
    $credits = getSerieCredits($serieId);
    $similarItems = getSerieSimilaire($serieId);
} else {
    header("Location: accueil.php");
}

if(!empty($_GET['saison'])) {
    $saison = (int) $_GET['saison'];
    $episodes = getEpisodesSerie($serieId, $saison);
}

function formatedHours(float $time)
{
    $hours = floor($time / 60);
    $minutes = $time % 60;

    return $hours . "h" . $minutes . "m";
}

$title = $item['title'] ?? $item['name'];
$release_date = $item['release_date'] ?? $item['first_air_date'];
?>

<div id="about-container">
    <div id="about-header">
        <img id="poster" src="https://image.tmdb.org/t/p/w400<?= $item['poster_path'] ?>" alt="<?= $title ?>"/>

        <div id="data">
            <div>
                <h1><?= $title ?></h1>
                <div id="about-genres">
                    <?php
                    foreach ($item['genres'] as $genre) {

                        echo "<p class='genre'>" . $genre['name'] . "</p>";
                    }
                    ?>
                </div>
            </div>
            <div id="about-description">
                <p>
                    <?= $item['overview'] ?>
                </p>
            </div>
            <div id="about-details">
                <p><span class="details">Réalisation:</span> <?= $release_date ?></p>
                <p><span class="details">Pays de réalisation:</span> <?= $item['production_countries'][0]['name'] ?></p>
                <?php
                if ($movieId) {
                    echo "<p><span class='details'>Durée:</span> " . formatedHours($item['runtime']) . "</p>";
                } else {
                    echo "
                            <p><span class='details'>Nombre d'épisodes:</span> " . $item['number_of_episodes'] . "</p>
                            <p><span class='details'>Nombre de saisons:</span> " . $item['number_of_seasons'] . "</p>";
                }
                ?>

                <p><span class="details">Note:</span>
                    <?= round($item['vote_average'], 1) ?>
                </p>
            </div>
        </div>
    </div>
</div>
<div id="saison-container">
    <?php
    if (isset($_GET['serie_id']) && isset($item['number_of_seasons'])) {
        echo "<select class='saison-section' onchange='toggleSaison(event)'>";
        var_dump($item);
        for ($i = 1; $i < $item['number_of_seasons']; $i++) {
            $selected = !empty($_GET['saison']) && $_GET['saison'] == $i ? "selected" : "";
            echo "<option class='saison' value='$i' $selected>Saison $i</option>";
        }
            echo "</select>";
                echo "<div class='episode-container'>";
            if(isset($episodes['episodes'])) {
                foreach ($episodes['episodes'] as $episode) {
                    $episodeImage = !empty($episode['still_path'])
                        ? "https://image.tmdb.org/t/p/w200" . $episode['still_path']
                        : "https://placehold.co/400x300?text=No+Image";
                    echo "
                    <div class='episode-content'>
                            <img class='episode-poster' src='$episodeImage' alt='" . $episode['name'] . "'>
                            <div class='episode-description'>
                                <h3 class='episode-title'>" . $episode['name'] . "</h3>
                                <p class='episode-description'>" . $episode['overview'] . "</p>
                            </div>
                     </div>";
                }
            }
            echo "</div></div>";
    }
    ?>
</div>
<div id="section-casting">
    <h2 id="cast-title">Casting</h2>
    <div id="casting-container">
        <?php
        foreach ($credits['cast'] as $people) {
            $profileImage = !empty($people['profile_path'])
                ? "https://image.tmdb.org/t/p/w200" . $people['profile_path']
                : "https://placehold.co/200x300?text=No+Image";

            echo "<img class='cast-people' title='" . htmlspecialchars($people['name'], ENT_QUOTES) . "' 
                        src='" . $profileImage . "' 
                        alt='" . htmlspecialchars($people['name'], ENT_QUOTES) . "'>";

        }
        ?>
    </div>
</div>
<div class="suggestion">
        <h2>Similaire</h2>
    <div class="suggestion-container">
        <?php
        foreach ($similarItems['results'] as $item) {
            $itemImage = !empty($item['poster_path'])
                ? "https://image.tmdb.org/t/p/w200" . $item['poster_path']
                : "https://placehold.co/200x300?text=No+Image";
            $link = isset($_GET['serie_id']) ? "about.php?serie_id=" : "about.php?movie_id=";
            $link .= htmlspecialchars($item['id'], ENT_QUOTES, 'UTF-8');
            echo "
                 <div class='poster'>
                    <a href='$link'>
                        <img src='$itemImage' alt='affiche de film' class='poster-image'>
                    </a>
                 </div>
                ";
        }
        ?>
    </div>
</div>
<script>
    toggleSaison = (event) => {
        window.location.href = `about.php?serie_id=<?= $serieId ?>&saison=${event.target.value}`;
    };
</script>