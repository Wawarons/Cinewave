<?php
session_start();
require_once '../includes/authQueries.php';

if(isset($_POST["email"]) && isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["confirm_password"])){
    $username = $_POST["username"];
    $email = $_POST["email"];
    $pass = $_POST["password"];
    $confirmPass = $_POST["confirm_password"];

    if($pass == $confirmPass) {
        $user = getUserByUsernameOrEmail($username, $email);

        if ($user == null) {
            $newUser = createUser(["username" => $username, "email" => $email, "password" => $pass]);
            header('Location: ../connexion.php');
        } else {
            $_SESSION["errors_inscription"][0] = "Utilisateur existants";
            header('Location: ../inscription.php');
        }
    } else {
        $_SESSION["errors_inscription"][0] = "Les mots de passe ne correspondent pas";
        header('Location: ../inscription.php');
    }
}