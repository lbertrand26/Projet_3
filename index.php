<?php
session_start();
ob_start();
require('controller/frontend.php');
dataSecure();

try
{
    if(!empty($_SESSION))
    {
        if(isset($_GET['action']))
        {
            switch($_GET['action'])
            {
                case 'profile' :
                    setUserSettings();
                break;

                case 'disconnect' :
                    destroyCookies();
                break;

                case 'actor':
                    if(!empty($_GET['id']))
                    {
                        if(isUserConnected() == TRUE){showActor();}else{connectUser();}
                    }
                    else{throw new Exception('Aucun id d\'acteur renseigné !');}
                break;

                case 'addComment' :
                    if(isset($_POST['comment'], $_GET['id']))
                    {
                        addComment($_GET['id'], $_POST['comment']);
                    }
                    else{throw new Exception('probleme de formulaire');}
                break;

                case 'likedislike' :
                    likeDislike();
                break;

            }
        }
        else{listActors();}
    }
    else{
        switch ($_GET['action'])
        {
            case 'register' :
                registerUser();                        
            break;
            case 'connect' :
                connectUser();
            break;
            case 'resetPassword' :
                resetPassword();
            break;
            default :
                connectUser();
        }
    }
}

catch (Exception $e)
{
    echo $e->getMessage();
}