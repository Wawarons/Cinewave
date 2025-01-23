<?php
include("includes/header.php");
include("includes/queries.php");
$dataManga = getAnimes();
?>

<div class="movie">
    <div class="align_movie">
    <?php
    foreach ($dataManga as $index => $manga) {

        echo "
                 <div class='poster'>
                    <a href='about.php?type=serie&title=" . htmlspecialchars($manga['title'], ENT_QUOTES, 'UTF-8') . "'>
                        <img src='" . htmlspecialchars($manga['image'], ENT_QUOTES, 'UTF-8') . "' alt='affiche de film'>
                    </a>
                 </div>
                ";
    }
    ?>
    </div>





</div>