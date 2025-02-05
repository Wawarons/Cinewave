<?php
require_once '../includes/authQueries.php';
session_start();

if(isset($_POST["email"]) && isset($_POST["password"])) {
    unset($_SESSION["errors_connexion"]);
    $email = $_POST["email"];
    $pass = $_POST["password"];
    $user = getUserByEmail($email);

    if ($user && password_verify($pass, password_hash($pass, PASSWORD_DEFAULT))) {

        $_SESSION["user"]["username"] = $user['username'];
        $_SESSION["user"]["email"] = $user['email'];
        $_SESSION["user"]["id"] = $user['user_id'];
        $_SESSION["user"]["role"] = $user['role'];
        header('Location: ../accueil.php');
    } else {
        $_SESSION["errors_connexion"][0] = "Mot de passe incorrecte";
        header('Location: ../connexion.php');
    };
}