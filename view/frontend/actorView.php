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
    <a href="index.php">Retour à la liste des partenaires</a>
</section>
<section id="comments">
    <div class='commentsTitle'>
        <h2><?= $nbComments . ' ' ?>Commentaires</h2>
        <div id="addComment">
        <?php if(!isset($_POST['comment'])){ echo $_POST['comment']; ?>
        <form id="comment" action="?action=actor&id=<?= $_GET['id'] ?>#comment" method="post"><input type="hidden" value="1" id="comment" name="comment"><input type="submit" value="Nouveau Commentaire"></form>
    
    <?php } ?>
    <?php
        if(isset($_POST['comment']) and $_POST['comment'] == 1)
        {
            ?><form id="comment" action="?action=actor&id=<?= $_GET['id'] ?>#comment" method="post"><input type="submit" value="fermer"></form><?php
            include('view/frontend/commentView.php');
        } 
    ?>
    </div>
        <p>
            <?= $nbLikesDislikes['likes'] ?> | <?= $nbLikesDislikes['dislikes'] ?><br>
            <a id="likedislike" href="?action=likedislike&vote=1&id=<?= $_GET['id'] ?>"><i class="fa<?= $userVote['thumbsup'] ?> fa-thumbs-up fa-2x" style="color:blue"></i></a> | <a id="likedislike" href="?action=likedislike&vote=2&id=<?= $_GET['id'] ?>"><i class="fa<?= $userVote['thumbsdown'] ?> fa-thumbs-down fa-2x" style="color:red"></i></a>
        </p>
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
        </div>



    </p>
</section>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>