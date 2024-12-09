<?php

/**
 * Permet d'établir une connexion avec la base de données d'authentification des utilisateurs.
 * @return mysqli une connexion à la base de données
 * */
function getAuthConnection(): mysqli
{

    $server = "localhost";
    $username = "root";

    $conn = new  mysqli($server, $username, "", "authentification");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

/**
 * Permet d'établir une connexion avec la base de données contenant les films et séries.
 * @return mysqli une connexion à la base de données
 * */
function getContentConnection(): mysqli {
    $server = "localhost";
    $username = "root";

    $conn = new  mysqli($server, $username, "", "cinewave");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

/**
 * Permet d'établir une connexion avec la base de données contenant les films et séries.
 * @return mysqli une connexion à la base de données
 * */
function getTransactionsConnection(): mysqli {
    $server = "localhost";
    $username = "root";

    $conn = new  mysqli($server, $username, "", "transactions");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        echo "Connected successfully";
    }

    return $conn;
}
