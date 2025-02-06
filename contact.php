<?php

require_once ('includes/header.php');
?>

<div class="container">
    <h2>Contactez-nous</h2>

    <?php
    // Affichage des messages de confirmation ou d'erreur
    if (isset($_SESSION["message"])) {
        echo "<div class='message " . $_SESSION["message_type"] . "'>" . $_SESSION["message"] . "</div>";
        unset($_SESSION["message"]);
        unset($_SESSION["message_type"]);
    }
    ?>

    <form action="traitement.php" method="POST">
        <label for="name">Nom :</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>

        <label for="message">Message :</label>
        <textarea id="message" name="message" rows="5" required></textarea>

        <button type="submit" class="submit">Envoyer</button>
    </form>
</div>