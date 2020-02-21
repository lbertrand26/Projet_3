<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?php if(isset($title)){echo $title;} ?></title>
        <link href="public/css/style.css" rel="stylesheet"> 
        <link href="public/css/profile.css" rel="stylesheet">
    </head>
        
    <body>

        <div id="main_wrapper">
            <header>
                <a href=index.php><img src="public/images/logo_gbaf.png" alt="logo" id="logo_gbaf" /></a>
                <?php if(empty($_SESSION['username'])){?><a href="?action=connect">Connection</a><?php } ?>
                <?php if(empty($_SESSION['username'])){?><a href="?action=register">Inscription</a><?php } ?>
                <?php if(!empty($_SESSION['username'])){?><a href="?action=disconnect">deconnexion</a><?php } ?>
                <p><?php if(!empty($_SESSION['firstname']) && !empty($_SESSION['lastname'])){?><i class="gg-profile"></i>&nbsp;<?= $_SESSION['lastname'] . ' ' . $_SESSION['firstname']?><?php } ?></p>
            </header>
                <?= $content ?>
            <footer>
                <p>| <a href="">Mentions légales</a> | <a href="">Contact</a> |</p>
            </footer>
        </div>
    </body>
</html>