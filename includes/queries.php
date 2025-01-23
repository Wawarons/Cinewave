<?php

/**
 * Cette page contient les fonctionnalités nécessaires pour récupérer ou
 * mettre à jour la base de données contenant les données sur les films,séries et animés.
 * @since 1.0.0 Création de la page
 */


include('config/config.php');

// Connexion à la base de données du contenu
$connContent = getContentConnection();


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

/**
 * Obtenir des informations sur un animé grâce à son titre.
 * Le tableau retournée contient les informations suivantes:
 *    - title: Titre de l'animé
 *    - description: Description de l'animé
 *    - image: Affiche de l'animé
 *    - duree: Durée de l'animé
 *    - age_limite: Âge de visionnage conseillé
 * @param string $title Titre de l'anime
 * @Return array|null Les informations de l'animé sous forme de tableau ou null en cas d'erreur.
 */
function getAnimeByTitle(string $title): ?array
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
    //Effectu une première recherche sur les films
    $query = $connContent->prepare($mySql);
    $query->bind_param('s', $title);
    $query->execute();
    $result = $query->get_result()->fetch_assoc();

    //Si l'animé n'a pas été trouvé dans les films.
    if(!$result) {
        $mySql = "
            select 
                title,
                description,
                number_saison,
                number_episode,
                image,
                age_limite 
            from serie 
            where serie.title=?";

        //Effectu une recherche de l'animé dans les séries.
        $query = $connContent->prepare($mySql);
        $query->bind_param('s', $title);
        $query->execute();
        $result = $query->get_result()->fetch_assoc();
    }

    return $result;
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
    SELECT film.id, film.description, film.title, film.image, category.id, category.name 
    FROM
        film
    JOIN film_categories ON film.id=film_categories.film_id
    JOIN category ON film_categories.category_id=category.id GROUP BY film.id
    ";

    if ($limit !== null) {
        $mySql .= " LIMIT " . $limit;
    }

    $result = mysqli_query($connContent, $mySql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
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
    SELECT serie.id, serie.description, serie.title, serie.image, category.id, category.name 
    FROM
        serie
    JOIN serie_categories ON serie.id=serie_categories.serie_id
    JOIN category ON serie_categories.category_id=category.id GROUP BY serie.id
    ";

    if ($limit !== null) {
        $mySql .= " LIMIT " . $limit;
    }

    $result = mysqli_query($connContent, $mySql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

/**
 * Obtenir la liste des animés.
 * @param int|null $limit Limite le nombre d'animés retournés.
 * @return array|null Retourne la liste des animés sous forme de tableau ou null en cas d'erreur.
 */
function getAnimes(int $limit = null): ?array
{
    global $connContent;

    //Recherche les animés dans la partie des films et séries.
    $mySql = "
        SELECT serie.id, serie.description, serie.title, serie.image, category.id, category.name 
        FROM
            serie
        JOIN serie_categories ON serie.id=serie_categories.serie_id
        JOIN category ON serie_categories.category_id=category.id WHERE category.name='Anime' GROUP BY serie.id
        UNION
        SELECT film.id, film.description, film.title, film.image, category.id, category.name 
        FROM
            film
        JOIN film_categories ON film.id=film_categories.film_id
        JOIN category ON film_categories.category_id=category.id WHERE category.name='Anime' GROUP BY film.id
        ";

    $result = mysqli_query($connContent, $mySql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}
