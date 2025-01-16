<?php
include("includes/header.php");
include("includes/queries.php");
$dataMovies= getFilms();
?>

<div class="movie">

        <p>Film comedie</p>
        <div class="align_movie">
            <?php
            foreach ($dataMovies as $index => $film) {

                echo "
                 <div class='poster'>
                    <a href='about.php?type=film&title=" . htmlspecialchars($film['title'], ENT_QUOTES, 'UTF-8') . "'>
                        <img src='" . htmlspecialchars($film['image'], ENT_QUOTES, 'UTF-8') . "' alt='affiche de film'>
                    </a>
                 </div>
                ";
            }
            ?>
        </div>
    <p>Film action</p>
    <ul class="align_movie">
        <?php
        foreach ($dataMovies as $index => $film) {

            echo "
                 <li class='poster'>
                    <a href='about.php?type=film&title=" . htmlspecialchars($film['title'], ENT_QUOTES, 'UTF-8') . "'>
                        <img src='" . htmlspecialchars($film['image'], ENT_QUOTES, 'UTF-8') . "' alt='affiche de film'>
                    </a>
                 </li>
                ";
        }
        ?>
    </ul>
    <p>Film science-fiction</p>
    <ul class="align_movie">
        <?php
        foreach ($dataMovies as $index => $film) {

            echo "
                 <li class='poster'>
                    <a href='about.php?type=film&title=" . htmlspecialchars($film['title'], ENT_QUOTES, 'UTF-8') . "'>
                        <img src='" . htmlspecialchars($film['image'], ENT_QUOTES, 'UTF-8') . "' alt='affiche de film'>
                    </a>
                 </li>
                ";
        }
        ?>
    </ul>




</div>