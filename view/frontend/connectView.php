<?php
session_start();
ob_start(); ?>
<?php $title = 'GBAF | page de connexion'; ?>
<?php if(!empty($error)){include('view/frontend/errorView.php');} ?>
<section id="connexion">
    <P>
        <form action="index.php?action=connect" method="post">            
            <label for="username">Nom d'utilisateur</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" required>
            <label for="cookies">Rester connecté</label><input type="checkbox" name="cookies" id="cookies"><br>
            <input type="submit">
        </form>
       
        <a href="?action=resetPassword">Mot de passe oublié ?</a>
    </p>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>