<?php $title = 'page de connection'; ?>
<?php ob_start(); ?>

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

<?php $connectionSection = ob_get_clean(); ?>

<?php require_once('template.php'); ?>