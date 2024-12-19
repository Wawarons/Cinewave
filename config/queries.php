<?php
include('config.php');

$connContent = getContentConnection();
function getSerieByTitle(string $title)
{
    global $connContent;
    $mySql = "
select 
    title,
    description,
    image,
     number_saison,
    number_episode,
    age_limite 
from 
    serie 
where 
    serie.title=?
";
    $query = $connContent->prepare($mySql);
    $query->bind_param('s', $title);
    $query->execute();
    return $query->get_result()->fetch_assoc();
}

function getFilmByTitle(string $title)
{
    global $connContent;
    $mySql = "
select 
    title,
    duree,
    description,
    image,
    age_limite      
from 
    film 
where 
    film.title=?
";
    $query = $connContent->prepare($mySql);
    $query->bind_param('s', $title);
    $query->execute();
    return $query->get_result()->fetch_assoc();
}

function getAnimeByTitle(string $title)
{
    global $connContent;
    $mySql = "
select 
    title,
    description,
    duree,
    image,
    age_limite 
from 
    film 
where 
    film.title=?
";

$query = $connContent->prepare($mySql);
$query->bind_param('s', $title);
$query->execute();
$result = $query->get_result()->fetch_assoc();

if(!$result) {
    $mySql = "select 
    title,
    description,
    number_saison,
    number_episode,
    image,
    age_limite 
from serie 
where serie.title=?";
    $query = $connContent->prepare($mySql);
    $query->bind_param('s', $title);
    $query->execute();
    $result = $query->get_result()->fetch_assoc();
}


    return $result;
}


function getFilms(int $limit = null)
{
    global $connContent;

    $mySql = "
    SELECT 
        id, 
        title, 
        description, 
        duree,
        image, 
        media_id, 
        available 
    FROM 
        `film`
    WHERE film.media_id = 1
    ";

    if ($limit !== null) {
        $mySql .= " LIMIT " . $limit;
    }

    $result = mysqli_query($connContent, $mySql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function getSeries(int $limit = null)
{
    global $connContent;

    $mySql = "
    SELECT 
        id, 
        title, 
        description, 
         number_saison,
    number_episode,
        image, 
        media_id, 
        available 
    FROM 
        `serie`
    WHERE serie.media_id = 2
    ";

    if ($limit !== null) {
        $mySql .= " LIMIT " . $limit;
    }

    $result = mysqli_query($connContent, $mySql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function getAnimes(int $limit = null)
{
    global $connContent;

    $mySql = "
    SELECT 
        id, 
        title, 
        description, 
        image, 
        media_id, 
        available 
    FROM 
        `film`
    WHERE film.media_id = 3
    UNION ALL 
    SELECT 
        id, 
        title, 
        description, 
        image, 
        media_id, 
        available 
    FROM 
        `serie`
    WHERE serie.media_id = 3
    ";

    if ($limit !== null) {
        $mySql .= " LIMIT " . $limit;
    }

    $result = mysqli_query($connContent, $mySql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}
