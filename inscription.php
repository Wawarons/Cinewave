<?php
include("includes/header.php");
?>
<h1 class="subpage">Inscription</h1>
<form id="inscription">
    <div class="form_input">
        <label for="email" "> Mail:</label>
        <input type="email" name="email" class="text" ">
    </div>
    <br>
    <div class="form_input">
        <label for="pseudo">Pseudo:</label>
        <input type="text" name="pseudo" class="text">
    </div>
    <br>
    <div class="form_input">
        <label for="mot de passe">Mot de passe:</label>
        <input type="password" name="password" class="text">
    </div>
    <br>
    <div class="form_input">
        <label for="confirm mot passe">Confirmation de mot de passe:</label>
        <input type="password" class="text">
    </div>
    <input type="submit" class="submit">
</form>
