<?php session_start(); $title = $actor['acteur'] . '  |  GBAF  |  Acteurs / Partenaires'; ob_start(); ?>
<section id="partenaires">
    <div id="bloc_acteurs">
        <div id="acteur">
            <img class="actorlogo" src="public/images/<?= $actor['logo'] ?>" alt="<?= $actor['name'] ?>" />
            <div id="contenu_acteurs">
                <h1><?= $actor['acteur'] ?></h1>
                <p><?= $actor['description'] ?></p>
            </div>
        </div>
    </div>
    <a id="backbuton" href="index.php">Retour</a>
</section>
<section id="comments">
    <div class='commentsTitle'>
        <h2><?= $nbComments . ' ' ?>Commentaires</h2>
        <?php
            if($_GET['comment'] == 1)
            {
            include('view/frontend/commentView.php');
            } 
        ?>
        <div id="commentRight">
            <div id="addComment">
                <?php if(!$_GET['comment']){?>
                    <a id="comment" href="?action=actor&amp;id=<?= $_GET['id'] ?>&amp;comment=1#comment"><?= $butonValue ?></a>
                <?php }else{ ?><a id="comment" href="?action=actor&id=<?= $_GET['id'] ?>#comment">Fermer</a><?php } ?>
            </div>
            <p>
                <?= $nbLikesDislikes['likes'] ?> | <?= $nbLikesDislikes['dislikes'] ?><br>
                <a id="likedislike" href="?action=likedislike&vote=1&amp;id=<?= $_GET['id'] ?>&amp;comment=<?= $_GET['comment'] ?>"><i class="fa<?= $userVote['thumbsup'] ?> fa-thumbs-up fa-2x" style="color:blue"></i></a> <a id="likedislike" href="?action=likedislike&vote=2&id=<?= $_GET['id'] ?>&comment=<?= $_GET['comment'] ?>"><i class="fa<?= $userVote['thumbsdown'] ?> fa-thumbs-down fa-2x" style="color:red"></i></a>
            </p>
        </div>
    </div>
    <?php
        $nbComments = 0;
        while ($comment = $comments->fetch())
        { ?>
            <div class="comment">
                <h3><?= $comment['prenom'] ?><br><?= $comment['datetimefr'] ?></h3>
                <p><?= $comment['post'] ?></p>
            </div>
        <?php } ?>
</section>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>