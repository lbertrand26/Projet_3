<?php
session_start();
ob_start(); ?>
<?php $title = 'GBAF | Réinitialisation du mot de passe'; ?>

<section id="connexion">
    <P>
        <form action="?action=resetPassword" method="post">            
            <label for="username">Nom d'utilisateur</label><br>
            <input type="text" id="username" name="username" value="<?= $userData['username'] ?>" required><br>
            <?php if($userData){ ?><p>Question secrète : "<?= $userData['question'] ?>"</p><?php } ?>
            <?php if($userData){?><label for="answer">Réponse</label><br><input type="text" id="answer" name="answer" required><br><label for="password">Nouveau mot de passe</label><br><input type="password" id="password" name="password" required><br><?php } ?>
            <input type="submit">
        </form>
        <a href="?action=resetPassword">Mot de pass oublié ?</a>
    </p>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>