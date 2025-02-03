<?php

/**
 * Cette page contient les fonctionnalités nécessaires pour récupérer ou
 * mettre à jour la base de données contenant les données sur les films,séries et animés.
 * @since 1.0.0 Création de la page
 */


include('config/config.php');

function getFilmByID(int $id): ?array
{

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://api.themoviedb.org/3/movie/$id?api_key=7ae5b548b2b7688fe71f95dadd7b7b1d&language=fr-FR",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "accept: application/json"
        ],
    ]);

    $response = curl_exec($curl);

    if ($response === false) {
        $err = curl_error($curl);
        curl_close($curl);
        
        return null;
    }


    $response = json_decode($response, true);

    curl_close($curl);
    
    return $response;
}

function getSerieByID(int $id): ?array
{

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://api.themoviedb.org/3/tv/$id?api_key=7ae5b548b2b7688fe71f95dadd7b7b1d&language=fr-FR",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "accept: application/json"
        ],
    ]);

    $response = curl_exec($curl);

    if ($response === false) {
        $err = curl_error($curl);
        curl_close($curl);

        return null;
    }


    $response = json_decode($response, true);

    curl_close($curl);

    return $response;
}



/**
 * Obtenir la liste des films.
 * @param int|null $limit Limite le nombre de films retournés.
 * @Return array|null Retourne la liste des films sous forme de tableau ou null en cas d'erreur.
 */
function getPopularFilms(int $page = 1) {

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://api.themoviedb.org/3/discover/movie?api_key=7ae5b548b2b7688fe71f95dadd7b7b1d&include_adult=false&include_video=false&language=fr-FR&page=$page&sort_by=popularity.desc",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "accept: application/json"
        ],
    ]);

    $response = curl_exec($curl);

    if ($response === false) {
        $err = curl_error($curl);
        curl_close($curl);
        
        return null;
    }


    $response = json_decode($response, true);

    curl_close($curl);
    
    return $response;

}

/**
 * Obtenir la liste des séries.
 * @param int|null $limit Limite le nombre de séries retournés.
 * @Return array|null Retourne la liste des séries sous forme de tableau ou null en cas d'erreur.
 */
function getPopularSeries(int $page = 1) : ?array
{

   $curl = curl_init();
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://api.themoviedb.org/3/tv/popular?api_key=7ae5b548b2b7688fe71f95dadd7b7b1d&language=fr-FR&page=$page",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "accept: application/json"
        ],
    ]);

    $response = curl_exec($curl);

    if ($response === false) {
        $err = curl_error($curl);
        curl_close($curl);
        
        return null;
    }


    $response = json_decode($response, true);

    curl_close($curl);
    
    return $response;

}

function getFilmCredits(int $id) : ?array
{

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://api.themoviedb.org/3/movie/$id/credits?api_key=7ae5b548b2b7688fe71f95dadd7b7b1d&language=fr-FR",
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "accept: application/json"
        ],
        CURLOPT_RETURNTRANSFER => true
    ]);

    $response = curl_exec($curl);

    if ($response === false) {
        $err = curl_error($curl);
        curl_close($curl);

        return null;
    }


    $response = json_decode($response, true);

    curl_close($curl);

    return $response;

}

function getSerieCredits(int $id) : ?array
{

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://api.themoviedb.org/3/tv/$id/credits?api_key=7ae5b548b2b7688fe71f95dadd7b7b1d&language=fr-FR",
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "accept: application/json"
        ],
        CURLOPT_RETURNTRANSFER => true
    ]);

    $response = curl_exec($curl);

    if ($response === false) {
        $err = curl_error($curl);
        curl_close($curl);

        return null;
    }


    $response = json_decode($response, true);

    curl_close($curl);

    return $response;

}


