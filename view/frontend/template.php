<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <link href="style.css" rel="stylesheet" /> 
    </head>
        
    <body>
        <?php if(!isset($_COOKIE['username'])){?><a href="?action=connect">Connection</a><?php } ?>
        <?php if(!isset($_COOKIE['username'])){?><a href="?action=test">Inscription</a><?php } ?>
        <?php if(isset($_COOKIE['username'])){?><a href="?action=deconnect">deconnexion</a><?php } ?>
        <?php if(isset($_COOKIE['username'])){?><p>Bienvenue <?php echo $_COOKIE['username']; }?> </p>
        <?= $content ?>
    </body>
</html>