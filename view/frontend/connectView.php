<?php
session_start();
ob_start(); ?>
<?php $title = 'page de connexion'; ?>

<section id=connexion>
    <P>
        <form action="index.php?action=connect" method="post">            
            <label for="username">Nom d'utilisateur</label><br>
            <input type="text" id="username" name="username"required><br>
            <label for="password">Mot de passe</label><br>
            <input type="password" id="password" name="password" required><br><br>
            <input type="submit">
        </form>
    </p>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>