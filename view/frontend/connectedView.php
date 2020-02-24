<?php
session_start();
$title = 'Présentation du GBAF  |  Acteurs/Partenaires';
ob_start(); ?>

<section id="presentation">
    <h1>Présentation du GBAF</h1>
    <p>Le GBAF est le représentant de la profession bancaire et des assureurs sur tous  les axes de la réglementation financière française. Sa mission est de promouvoir  l'activité bancaire à l’échelle nationale. C’est aussi un interlocuteur privilégié des  pouvoirs publics.  </p>
</section>

<section id="partenaires">
    <h2>Acteurs/Partenaires</h2>
    <div id="bloc_acteurs">
        <?php

            while ($data = $actors->fetch())
            { ?>
                <div class="acteur">
                    <img id=actorlogo src="public/images/<?= htmlspecialchars($data['logo']) ?>" alt="<?= htmlspecialchars($data['name']) ?>" />
                    <div class="contenu_acteurs">
                        <h3><?= htmlspecialchars($data['acteur']) ?></h3>
                        <p><?= mb_strimwidth($data['description'], 0, 100) ?>...</p>
                    </div>
                    <a href="?action=actor&id=<?= $data['id_acteur'] ?>">Lire la suite</a>
                </div>
            <?php } 
        ?>
    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>