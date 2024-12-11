<?php
include ('header.php');
include ('../config/config.php');
$dbContent = getContentConnection();

if(isset($_GET['type'])) {
    $type = $_GET['type'];
} else {
    header("Location: accueil.php");
}

if(isset($_GET[$type . '_id'])) {
    $itemId = $_GET[$type . '_id'];
} else {
    header("Location: accueil.php");
}

$item = mysqli_query($dbContent, 'select title,description,image, age_limite from  ' . $type  .' where id = ' . $itemId)->fetch_all(MYSQLI_ASSOC);
$item = $item[0];
?>

<div class="movie_art">

        <img src="<?php echo $item['image'] ?? "https://placehold.co/200x300" ?>" alt="affiche de film"/>
    <div class="desc_art">
        <div class="try_art">
         <div class="art">
        <h2><?php echo $item['title'] ?></h2>
        <p>Genre: Comedie</p>
        <p>Durée: 1h50</p>
    </div>
    <p class="desc"><?php echo "<strong>Résumé:  </strong><br></br>",$item['description'] ?></p>
    </div>
</div>
