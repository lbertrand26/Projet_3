<?php
session_start();
ob_start(); ?>
<?php $title = 'GBAF | Paramêtres du compte'; ?>


<?php if(!empty($error)){include('view/frontend/errorView.php');} ?>
<section id="settings">
    <P>
        <form action="index.php?action=profile" method="post">
            <label for="username">Nom d'utilisateur</label><input type="text" id="username" name="username" value="<?= $userData['username'] ?>" >
            
            <label for="firstname">Prénom</label><input type="text" id="prenom" readonly="true" value="<?= $userData['prenom'] ?>" >
            <label for="lastname">Nom</label><input type="text" id="nom" readonly="true" value="<?= $userData['nom'] ?>" >
            
            <label for="password">Mot de passe</label><input type="password" id="password" name="password" required>
            <label for="newPassword">Nouveau Mot de passe</label><input type="password" id="newPassword" name="newPassword" >
            <label for="question">Question secrête</label><input type="text" id="question" name="question" value="<?= $userData['question'] ?>" >
            <label for="reponse">Réponse à la question (sensible a la casse)</label><input type="text" id="reponse" name="reponse">
            <input type="hidden" name="id_user" id="id_user" value="<?= $_SESSION['id'] ?>"><br>
            <input type="submit" value="Modifier">

        </form>
    </p>
</section>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>