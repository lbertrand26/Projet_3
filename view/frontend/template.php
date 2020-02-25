<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?php if(isset($title)){echo $title;} ?></title>
        <link href="public/css/style.css" rel="stylesheet"> 
        <link href="public/fontawesome/css/all.min.css" rel="stylesheet">
        <link rel="apple-touch-icon" sizes="57x57" href="public/images/favicons/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="public/images/favicons/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="public/images/favicons/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="public/images/favicons/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="public/images/favicons/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="public/images/favicons/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="public/images/favicons/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="public/images/favicons/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="public/images/favicons/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="public/images/favicons/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="public/images/favicons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="public/images/favicons/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="public/images/favicons/favicon-16x16.png">
        <link rel="manifest" href="public/images/favicons/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
    </head>
        
    <body>

        <div id="main_wrapper">
            <header>
                <a href=index.php><img src="public/images/logo_gbaf.png" alt="logo" id="logo_gbaf" /></a>
                <nav id="connect">
                    <p><?php if(!empty($_SESSION)){?><i class="far fa-user-circle" style="color:red"></i>&nbsp;<?= $_SESSION['lastname'] . ' ' . $_SESSION['firstname'] ?><?php } ?></p>
                    <?php if(!empty($_SESSION)){?><a id="disconnect" href="?action=disconnect">Déconnexion </a><br><?php } ?>
                    <?php if(!empty($_SESSION)){?><a href="?action=profile">Modifier le profil</a><?php } ?>
                    <?php if(empty($_SESSION)){?><a href="?action=connect">Connection</a><?php } ?>
                    <?php if(empty($_SESSION)){?><a href="?action=register">Inscription</a><?php } ?>
                </nav>
            </header>
                <?= $content ?>
            <footer>
                <p>| <a href="">Mentions légales</a> | <a href="">Contact</a> |</p>
            </footer>
        </div>
    </body>
</html>