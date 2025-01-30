<?php
include("includes/header.php");
session_start();


?>
<h1 class="subpage">Inscription</h1>
<?php
if(isset($_SESSION["errors_inscription"])){
    echo "<div class='form_error'><p>".$_SESSION["errors_inscription"][0]."</p></div>";
}
?>
<form action="utilities/inscriptionUtilisateur.php" method="POST" id="inscription">
    <div class="form_input">
        <label for="email"> Mail:</label>
        <input id="email" type="email" name="email" class="text" required/>
    </div>
    <br>
    <div class="form_input">
        <label for="username">Pseudo:</label>
        <input id="username" type="text" name="username" class="text" required>
    </div>
    <br>
    <div class="form_input">
        <label for="password">Mot de passe:</label>
        <input id="password" type="password" name="password" class="text" required>
    </div>
    <br>
    <div class="form_input">
        <label for="confirm_password">Confirmation de mot de passe:</label>
        <input id="confirm_password" name="confirm_password" type="password" class="text" required>
    </div>
    <input type="submit" class="submit">
</form>
