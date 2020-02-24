<?php
session_start();
ob_start(); ?>
<?php $title = 'GBAF | page de connexion'; ?>

<section id="connexion">
    <P>
        <form class="connectForm" action="index.php?action=connect" method="post">            
            <label for="username">Nom d'utilisateur</label><br>
            <input type="text" id="username" name="username" required><br>
            <label for="password">Mot de passe</label><br>
            <input type="password" id="password" name="password" required><br>
            <label for="cookies">Rester connecté<input type="checkbox" name="cookies" id="cookies"></label>
            <input type="submit">
        </form>
       
        <a href="?action=resetPassword">Mot de passe oublié ?</a>

        <?= $error ?>
    </p>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>