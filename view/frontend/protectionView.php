<?php $title = 'page de protection'; ?>
<?php ob_start(); ?>

<section id=protection>
    <P>
        L'accès est protégé, veuillez vous connectez avec les identifiants fournis.
        <form action="index.php?action=unprotect" method="post">            
            <label for="username">Nom d'utilisateur</label><br>
            <input type="text" id="username" name="username"required><br>
            <label for="password">Mot de passe</label><br>
            <input type="password" id="password" name="password" required><br><br>
            <input type="submit">
        </form>
    </p>
</section>

<?php $protectionSection = ob_get_clean(); ?>

<?php require_once('template.php'); ?>