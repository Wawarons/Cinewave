<?php
include('includes/header.php');
include('includes/queries.php');

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
    $item =  current($item);
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

<div id="bg-article">
    <div id="blur"></div>
</div>
<div class="movie_art">
    <style>
        #bg-article {
            background: url(<?= $item['image'] ?>) center center;
            background-size: cover;
        }
    </style>
    <img id="poster-article" src="<?php echo $item['image'] ?? "https://placehold.co/200x300" ?>" alt="affiche de film"/>
    <div class="article">
                <div id="article-header">
                <h2><?= $item['title'] ?></h2>
                <div id="category-container">
                    <?php
                        foreach ($item['categories'] as $category) {
                            echo "<p class='category'>$category</p>";
                        }
                    ?>
                </div>
                </div>
                <p id="article-description"><?= $item['description'] ?></p>
                <div id="data-article">
                    <?php
                    if (isset($item['number_saison']) && isset($item['number_episode'])) {
                        echo
                            "<div id='count'>
                                <p> Saisons: <span class='count-value'>" . $item['number_saison'] . "</span></p>   
                                <p> Episodes: <span class='count-value'>" . $item['number_episode'] . "</span></p>                     
                            </div>";
                    } elseif (isset($item['duration'])) {
                        echo "<p>Durée: " . formatedHours($item['duration']) . "</p>";
                    }
                    ?>
                </div>
            </div>

