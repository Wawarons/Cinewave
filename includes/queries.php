<?php

/**
 * Cette page contient les fonctionnalités nécessaires pour récupérer ou
 * mettre à jour la base de données contenant les données sur les films,séries et animés.
 * @since 1.0.0 Création de la page
 */


include('config/config.php');

// Connexion à la base de données du contenu
$connContent = getContentConnection();


function formatSeriesCategories($result): array
{
    $seriesWithCategories = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $serie_id = $row['id'];
        if (!isset($seriesWithCategories[$serie_id])) {
            $seriesWithCategories[$serie_id] = [
                'serie_id' => $row['id'],
                'title' => $row['title'],
                'description' => $row['description'],
                'number_saison' => $row['number_saison'],
                'number_episode' => $row['number_episode'],
                'image' => $row['image'],
                'categories' => []
            ];
        }

        $seriesWithCategories[$serie_id]['categories'][] =  $row['name'];
    }

    return $seriesWithCategories;
}

function formatFilmsCategories($result): array
{
    if(!$result->num_rows > 0){
        return [];
    }
    $filmsWithCategories = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $film_id = $row['id'];
        if (!isset($filmsWithCategories[$film_id])) {
            $filmsWithCategories[$film_id] = [
                'film_id' => $row['id'],
                'title' => $row['title'],
                'description' => $row['description'],
                'duration' => $row['duree'],
                'image' => $row['image'],
                'categories' => []
            ];
        }

        $filmsWithCategories[$film_id]['categories'][] =  $row['name'];
    }

    return $filmsWithCategories;
}

/**
 * Obtenir des informations sur une série grâce à son titre.
 * Le tableau retournée contient les informations suivantes:
 *  - title: Titre de la série
 *  - description: Description de la série
 *  - image: Affiche de la série
 *  - number_saison: Nombre de saisons
 *  - number_episode: Nombre d'épisodes
 *  - age_limite: Âge de visionnage conseillé
 * @param string $title Titre de la série
 * @return array|null Les informations de la série sous forme de tableau ou null en cas d'erreur.
 */
function getSerieByTitle(string $title): ?array
{
    global $connContent;
    $mySql = "
    select 
        serie.id,
        title,
        description,
        image,
         number_saison,
        number_episode,
        age_limite,
        category.name
    from 
        serie 
    JOIN serie_categories ON serie.id=serie_categories.serie_id
    JOIN category ON serie_categories.category_id=category.id
    where 
        serie.title=?
    ";

    $query = $connContent->prepare($mySql);
    $query->bind_param('s', $title);
    $query->execute();
    $result = $query->get_result();
    return formatSeriesCategories($result);
}

/**
 * Obtenir des informations sur un film grâce à son titre.
 * Le tableau retournée contient les informations suivantes:
 *   - title: Titre du film
 *   - description: Description du film
 *   - image: Affiche du film
 *   - duree: Durée du film
 *   - age_limite: Âge de visionnage conseillé
 * @param string $title Titre du film
 * @return array|null Les informations du film sous forme de tableau ou null en cas d'erreur.
 */
function getFilmByTitle(string $title): ?array
{
    global $connContent;
    $mySql = "
    select 
        film.id,
        title,
        duree,
        description,
        duree,
        image,
        age_limite,
        category.name
    from 
        film 
    JOIN film_categories ON film.id=film_categories.film_id
    JOIN category ON film_categories.category_id=category.id
    where 
        film.title=?;
    ";

    $query = $connContent->prepare($mySql);
    $query->bind_param('s', $title);
    $query->execute();
    $result = $query->get_result();
    return formatFilmsCategories($result);
}


/**
 * Obtenir la liste des films.
 * @param int|null $limit Limite le nombre de films retournés.
 * @Return array|null Retourne la liste des films sous forme de tableau ou null en cas d'erreur.
 */
function getFilms(int $limit = null): ?array
{
    global $connContent;

    $mySql = "
    SELECT film.id, film.description, film.title, film.image, film.duree, category.name 
    FROM
        film
    JOIN film_categories ON film.id=film_categories.film_id
    JOIN category ON film_categories.category_id=category.id
    ";

    if ($limit !== null) {
        $mySql .= " LIMIT " . $limit . ";";
    }

    $result = mysqli_query($connContent, $mySql);
    return formatFilmsCategories($result);
}

/**
 * Obtenir la liste des séries.
 * @param int|null $limit Limite le nombre de séries retournés.
 * @Return array|null Retourne la liste des séries sous forme de tableau ou null en cas d'erreur.
 */
function getSeries(int $limit = null) : ?array
{
    global $connContent;

    $mySql = "
    SELECT serie.id, serie.description, serie.title, serie.image,  serie.number_saison,
        serie.number_episode, category.name 
    FROM
        serie
    JOIN serie_categories ON serie.id=serie_categories.serie_id
    JOIN category ON serie_categories.category_id=category.id GROUP BY serie.id
    ";

    if ($limit !== null) {
        $mySql .= " LIMIT " . $limit . ";";
    }

    $result = mysqli_query($connContent, $mySql);
    return formatSeriesCategories($result);
}

function getSeriesByCategory(string $categoryName): ?array {
    $mySQL = "
        SELECT s.id, s.title, s.description, s.image, s.duree, category.name
        FROM serie s
        JOIN serie_categories sc ON s.id = sc.serie_id
        JOIN category c ON sc.category_id = c.id
        WHERE c.name = $categoryName;";

        return null;
}

function getFilmsByCategory(string $categoryName): ?array {
    $mySQL = "
        SELECT f.id, f.title, f.description, f.image, f.duree, category.name
        FROM film f
        JOIN film_categories fc ON f.id = fc.film_id
        JOIN category c ON fc.category_id = c.id
        WHERE c.name = $categoryName;";

    return null;
}