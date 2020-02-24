<?php
session_start();
ob_start(); ?>

<section id="inscription">
    <P>
        <form action="index.php?action=register" method="post">
            <label for="username">Nom d'utilisateur</label><input type="text" id="username" name="username" value="<?php if(isset($_POST['username'])){echo $_POST['username'];}?>" required><br>
            <label for="firstname">Prénom</label><input type="text" id="fisrtname" name="firstname" value="<?php if(isset($_POST['firstname'])){echo $_POST['firstname'];}?>" required><br>
            <label for="lastname">Nom</label><input type="text" id="lastname" name="lastname" value="<?php if(isset($_POST['lastname'])){echo $_POST['lastname'];}?>" required><br>
            <label for="password">Mot de passe</label><input type="password" id="password" name="password" required><br>
            <label for="question">Question secrête</label><input type="text" id="question" name="question" value="<?php if(isset($_POST['question'])){echo $_POST['question'];}?>" required><br>
            <label for="answer">Réponse à la question (sensible a la case)</label><input type="text" id="answer" name="answer"><br>
            <?= $error ?>
            <input type="submit">

        </form>
    </p>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>