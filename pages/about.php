<?php
include('header.php');
include('../config/queries.php');

if (isset($_GET['type']) && isset($_GET['title'])) {
    $type = $_GET['type'];
    $title = $_GET['title'];
} else {
    header("Location: accueil.php");
}

if ($type != null && $title != null) {
    $title = stripslashes($title);
    switch ($type) {
        case 'serie':
            $item = getSerieByTitle($title);
            break;
        case 'film':
            $item = getFilmByTitle($title);
            break;
        case 'anime':
            $item = getAnimeByTitle($title);
            break;
        default:
            header("Location: accueil.php");
            break;
    }
}

function formatedHours(int $time)
{
    $hours = floor($time / 3600);
    $minutes = floor($time / 60 % 60);

    return $hours . "h" . $minutes . "m";
}

//if (!$item)
//    header("Location: accueil.php");
?>

<div class="movie_art">

    <img src="<?php echo $item['image'] ?? "https://placehold.co/200x300" ?>" alt="affiche de film"/>
    <div class="desc_art">
        <div class="try_art">
            <div class="art">
                <h2><?php echo $item['title'] ?></h2>
                <p>Genre: Comedie</p>
                <?php
                if (isset($item['number_saison']) && isset($item['number_episode'])) {
                    echo "<p>Nombre d'épisodes: " . $item['number_episode'] . "</p>
                             <p>Nombre de saisons: " . $item['number_saison'] . "</p>";
                } elseif (isset($item['duree'])) {
                    echo "<p>Durée: " . formatedHours($item['duree']) . "</p>";
                }
                ?>
            </div>
            <p class="desc"><?php echo "<strong>Résumé:  </strong><br></br>", $item['description'] ?></p>
        </div>
    </div>
