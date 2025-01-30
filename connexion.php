<?php
session_start();
var_dump($_SESSION);
include("includes/header.php");
?>
<div id="auth_container">
<h1 class="subpage">Connexion</h1>
    <?php
    if(isset($_SESSION["errors_connexion"])){
        echo "<div class='form_error'><p>".$_SESSION["errors_connexion"][0]."</p></div>";
    }
    ?>
<form id="connexion" method="POST" action="utilities/connexionUtilisateur.php">
    <div class="form_input">
        <label for="email"> Mail:</label>
        <input id="email" type="email" name="email" class="text" required/>
    </div>

    <div class="form_input">
        <label for="password">Mot de passe:</label>
        <input id="password" type="password" name="password" class="text" required>
    </div>

    <div id="form_links">
        <a href="#" class="bouton">Mot de passe oublier</a>
        <a href="inscription.php" class="bouton">Inscription</a>
    </div>    
    <input class="form_submit" type="submit" value="Connexion">
</form>
</div>