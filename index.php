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
                case 'register' :
                    if (!empty($_POST['username']) && !empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['password']) && !empty($_POST['question']) && !empty($_POST['answer']))
                    {
                        registerUser($_POST['username'], $_POST['firstname'], $_POST['lastname'],$_POST['password'], $_POST['question'], $_POST['answer']);
                    break;
                    }
                    else
                    {
                        register();                        
                    }
                break;

                case 'profile' :
                    setUserSettings();
                break;

                case 'connect' :
                    connectUser();
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
                        addComment($_SESSION['id'], $_GET['id'], $_POST['comment']);
                    }
                    else{throw new Exception('probleme de formulaire');}
                break;

                case 'likedislike' :
                    likeDislike();
                break;

                case 'resetPassword' :
                    resetPassword();
                break;

                default:
                    throw new Exception('action non éxistante envoyée !!');
                break;
            }
        }
        else { listActors(); }
        
    }
        else
        {
            connectUser();
        }
}

catch (Exception $e)
{
    echo $e->getMessage();
}