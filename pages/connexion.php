<?php
include("header.php");
?>
<div id="auth_container">
<h1 class="subpage">Connexion</h1>
<form id="inscription">
    <div class="form_input">
        <label for="email" "> Mail:</label>
        <input type=" email" name="email" class="text">
    </div>

    <div class="form_input">
        <label for="mot de passe">Mot de passe:</label>
        <input type="password" name="password" class="text">
    </div>

    <div id="form_links">
        <a href="#" class="bouton">Mot de passe oublier</a>
        <a href="#" class="bouton">Inscription</a>
    </div>    
    <input class="form_submit" type="submit" value="Connexion">
</form>
</div>