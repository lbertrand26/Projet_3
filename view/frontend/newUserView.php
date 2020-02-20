<?php ob_start(); ?>

<P>
    <form action="index.php?action=test" method="post">
        <label for="username">Nom d'utilisateur</label><input type="text" id="username" name="username" value="<?php if(isset($_POST['username'])){echo $_POST['username'];}?>" required><br>
        <label for="firstname">Prénom</label><input type="text" id="fisrtname" name="firstname" value="<?php if(isset($_POST['firstname'])){echo $_POST['firstname'];}?>" required><br>
        <label for="lastname">Nom</label><input type="text" id="lastname" name="lastname" value="<?php if(isset($_POST['lastname'])){echo $_POST['lastname'];}?>" required><br>
        <label for="password">Mot de passe</label><input type="password" id="password" name="password" required><br>
        <label for="email">Email</label><input type="email" id="email" name="email" value="<?php if(isset($_POST['email'])){echo $_POST['email'];}?>" required><br>

        <input type="submit">

    </form>
</p>

<?php $content = ob_get_clean(); ?>

<?php require_once('template.php'); ?>