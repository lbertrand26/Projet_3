<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <link href="public/css/style.css" rel="stylesheet"> 
        <link href="public/css/profile.css" rel="stylesheet">
    </head>
        
    <body>

        <div id="main_wrapper">
            <header>
                
                <img src="public/images/logo_gbaf.png" alt="logo" id="logo_gbaf" />
                <?php if(!isset($_COOKIE['username'])){?><a href="?action=connect">Connection</a><?php } ?>
                <?php if(!isset($_COOKIE['username'])){?><a href="?action=test">Inscription</a><?php } ?>
                <?php if(isset($_COOKIE['username'])){?><a href="?action=deconnect">deconnexion</a><?php } ?>
                <p><?php if(isset($_COOKIE['username'])){?><i class="gg-profile"></i>&nbsp;<?php echo $_COOKIE['username']; }?></p>
            </header>
            <?php if(isset($connectionSection)){echo $connectionSection;} ?>
            <?php if(isset($connectedSections)){echo $connectedSections;} ?>
            <footer>
                <p>| <a href="">Mentions légales</a> | <a href="">Contact</a> |</p>
            </footer>
        </div>
    </body>
</html>