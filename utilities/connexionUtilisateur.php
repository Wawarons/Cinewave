<?php
session_start();

require_once '../includes/authQueries.php';

if(isset($_POST["email"]) && isset($_POST["password"])) {
    unset($_SESSION["errors_connexion"]);
    $email = $_POST["email"];
    $pass = $_POST["password"];
    $user = getUserByEmail($email);
    echo $email;
    var_dump($user);
    if ($user && checkPassword($user['email'], $pass)) {

        echo "BIIIEN !";
        $_SESSION["user"]["username"] = $user['username'];
        $_SESSION["user"]["email"] = $user['email'];
        $_SESSION["user"]["id"] = $user['user_id'];
        //header('Location: ../accueil.php');
    } else {
        echo "PAS BIIIEN !";

        $_SESSION["errors_connexion"][0] = "Mot de passe incorrecte";
        //header('Location: ../connexion.php');
    };
}