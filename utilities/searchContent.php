<?php
if(empty($_POST['title'])){
    header('Location: ../accueil.php');
}

require_once '../includes/contentQueries.php';

$title = $_POST['title'];
$results = searchFilm($title);
var_dump($results);