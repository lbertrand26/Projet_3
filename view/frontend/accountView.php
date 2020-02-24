<?php
session_start();
ob_start(); ?>
<?php $title = 'GBAF | Paramêtres du compte'; ?>

<section id="settings">
    <P>
        <form action="index.php?action=settings" method="post">
            <label for="username">Nom d'utilisateur</label><input type="text" id="username" name="username" value="<?= $userData['username'] ?>" ><br>
            
            <label for="firstname">Prénom</label><input type="text" id="prenom" readonly="true" value="<?= $userData['prenom'] ?>" ><br>
            <label for="lastname">Nom</label><input type="text" id="nom" readonly="true" value="<?= $userData['nom'] ?>" ><br>
            
            <label for="password">Ancien Mot de passe</label><input type="password" id="password" name="password" required><br>
            <label for="newPassword">Nouveau Mot de passe</label><input type="password" id="newPassword" name="newPassword" ><br>
            <label for="question">Question secrête</label><input type="text" id="question" name="question" value="<?= $userData['question'] ?>" ><br>
            <label for="reponse">Réponse à la question (sensible a la case)</label><input type="text" id="reponse" name="reponse"><br>
            <input type="hidden" name="id_user" id="id_user" value="<?= $_SESSION['id'] ?>">
            <input type="submit" value="Modifier">

        </form>
    </p>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>