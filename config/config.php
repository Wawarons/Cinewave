<?php

/**
 * Permet d'établir une connexion avec la base de données d'authentification des utilisateurs.
 * @return mysqli une connexion à la base de données
 * */
function getAuthConnection(): mysqli
{

    $server = "localhost";
    $username = "root";

    $conn = new  mysqli($server, $username, "FGiggle5678.", "cinewave");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}


