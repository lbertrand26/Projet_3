<?php
session_start();
ob_start(); ?>

<section id="presentation">
    <h1>Présentation du GBAF</h1>
    <p><img src="" alt="illustration" /></p>
</section>

<section id="partenaires">
    <h2>Acteurs/Partenaires</h2>
    <p>Texte acteurs et partenaires</p>
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
                    <a href="?action=actor&id=<?= $data['id_acteur'] ?>">lire la suite</a>
                </div>
            <?php } 
        ?>
    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>