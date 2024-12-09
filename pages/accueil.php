<?php
include('header.php');
include('../config/config.php');
$dbContent = getContentConnection();
$topFilms = mysqli_query($dbContent, "SELECT * FROM `film` LIMIT 5")->fetch_all(MYSQLI_ASSOC);
$topSeries = mysqli_query($dbContent, "SELECT * FROM `serie` LIMIT 5")->fetch_all(MYSQLI_ASSOC);
?>

    <div id="trailer_accueil">
        <video autoplay muted> <!-- Intégration trailer -->
            <source src="https://bright-crimson-sloth.myfilebase.com/ipfs/QmWV4GrNchNZPSfxvbHzb5brCxC6KvRGW6tUmmMUnsufg8">
        </video>
    </div>
    <div class="top">
        <h2>Top films</h2>
        <div class="top_contenu">
            <?php
            foreach ($topFilms as $index => $film) {

                echo "
             <div class='top-film'>
             <a href='about.php?type=film&film_id=" . $film['id'] . "'>
                <img src='" . $film['image'] . "' alt='affiche de film'>
                </a>
             </div>
            ";

            }
            ?>
        </div>
    </div>

    <div class="top">
        <h2>Top Séries</h2>
        <div class="top_contenu">
            <?php
            foreach ($topSeries as $index => $serie) {

                echo "
             <div class='top-film'>
                   <a href='about.php?type=serie&serie_id=" . $serie['id'] . "'>
                    <img src='" . $serie['image'] . "' alt='affiche de film'>
                </a>
             </div>
            ";

            }
            ?>
        </div>
    </div>
<?php
include('footer.php');
?>