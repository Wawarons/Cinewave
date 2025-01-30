<?php

include('../config/config.php');

// Connexion à la base de données du contenu
$connContent = getAuthConnection();


function getUserByUsernameOrEmail(string $username = null, string $email = null): ?array {
    global $connContent;
    $mySql = "
    SELECT 
        user_id,
        username,
        email,
        password
    FROM 
        authentication
    WHERE
        email = ? OR username = ?
";

    $query = $connContent->prepare($mySql);

// Check if the statement was prepared successfully
    if ($query === false) {
        die('MySQL prepare error: ' . $connContent->error);
    }
// Bind parameters (assuming $username and $email are the user inputs)
    $query->bind_param('ss', $email, $username);
// Execute the query
    $query->execute();

// Optional: Check if the query was successful
    if ($result = $query->get_result()) {
        return $result->fetch_assoc();
        // Further processing...
    } else {
        return null;
    }


}

function createUser(array $data): bool {
    global $connContent;
    echo "Create User";
    if(!isset($data['username']) || !isset($data['email']) || !isset($data['password'])) {
        return false;
    }

    $mySql = "
        INSERT INTO authentication (`username`, `email`, `password`) VALUES (?,?,?);
    ";


    $hashPassword = crypt($data['password'], 10);

    $query = $connContent->prepare($mySql);
    $query->bind_param('sss', $data['username'], $data['email'], $hashPassword);
    return $query->execute();
}

