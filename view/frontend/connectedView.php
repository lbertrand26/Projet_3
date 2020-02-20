<?php ob_start(); ?>

<section id="presentation">
    <h1>Présentation du GBAF</h1>
    <p><img src="" alt="illustration" /></p>
</section>

<section id="partenaires">
    <h2>Acteurs/Partenaires</h2>
    <p>Texte acteurs et partenaires</p>
    <div id="bloc_acteurs">
        <div class="acteur">
            <img src="acteur1.png" alt="acteur_1" />
            <div class="contenu_acteurs">
                <h3>acteur 1</h3>
                <p>bfegejhgfbfdjivfjfvdsgjfgdsjfgsdgfgsdgf</p>
            </div>
            <a href="">lire la suite</a>
        </div>
        <div class="acteur">
            <p>
                <h3>acteur 2</h3>
            </p>
        </div>
    </div>
</section>

<?php $connectedSections = ob_get_clean(); ?>

<?php require_once('template.php'); ?>