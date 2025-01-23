<?php
include("includes/header.php");
include("includes/queries.php");
$dataSeries = getSeries();
?>

<div class="top">
    <h2>SÉRIES</h2>
    <p>Séries comedie</p>
    <div class="top_contenu">
        <?php
        foreach ($dataSeries as $index => $serie) {

            echo "
                 <div class='poster'>
                    <a href='about.php?type=serie&title=" . htmlspecialchars($serie['title'], ENT_QUOTES, 'UTF-8') . "'>
                        <img src='" . htmlspecialchars($serie['image'], ENT_QUOTES, 'UTF-8') . "' alt='affiche de film'>
                    </a>
                 </div>
                ";
        }
        ?>
    </div>
</div>




</div>