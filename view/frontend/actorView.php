<?php session_start();ob_start(); ?>
<section id="partenaires">
    <h2>Acteurs/Partenaires</h2>
    <p>Texte acteurs et partenaires</p>
    <div id="bloc_acteurs">
        <div id="acteur">
            <img id=actorlogo src="public/images/<?= htmlspecialchars($actor['logo']) ?>" alt="<?= htmlspecialchars($actor['name']) ?>" />
            <div id="contenu_acteurs">
                <h1><?= htmlspecialchars($actor['name']) ?></h1>
                <p><?= nl2br($actor['description']) ?></p>
            </div>
        </div>
    </div>
</section>
<section id="comments">
    <h2>Commentaires</h2>
    <?php if(!isset($_GET['comment'])){ ?><a href="?action=actor&id=<?= $_GET['id'] ?>&comment=1#comment">ajouter un commentaire</a><?php } ?>
    <?php if(isset($_GET['comment']) and $_GET['comment'] == 1){include('view/frontend/commentView.php');} ?>
    <?php
        while ($comment = $comments->fetch())
        { ?>
            <h3><?= $comment['prenom'] ?> Le <?= $comment['datetimefr'] ?></h3>
            <p><?= $comment['post'] ?></p>
        <?php } ?>



    </p>
</section>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>