<?php
session_start();
ob_start();
require('controller/frontend.php');

try
{
    if(isset($_GET['action']))
    {
        switch($_GET['action'])
        {
            case "register" :
                if (!empty($_POST['username']) && !empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['password']) && !empty($_POST['question']) && !empty($_POST['answer']))
                {
                    foreach ($_POST as $post)
                    {
                        $_POST[$post] = htmlspecialchars($_POST[$post]);
                    }

                    registerUser($_POST['username'], $_POST['firstname'], $_POST['lastname'],$_POST['password'], $_POST['question'], $_POST['answer']);
                break;
                }
                else
                {
                    register();                        
                }
            break;

            case 'connect' :
                if (!empty($_POST['username']) && !empty($_POST['password']))
                {
                    foreach ($_POST as $post)
                    {
                        $_POST[$post] = htmlspecialchars($_POST[$post]);
                    }
                    connectUser($_POST['username'], $_POST['password']);
                }
                else
                {
                    connect();
                }
            break;

            case 'disconnect' :
                destroyCookies();
            break;

            case 'actor':
                if(isset($_GET['id']))
                {
                    $_GET['id'] = (int) $_GET['id'];
                    showActor();
                }
                else{throw new Exception('Aucun id d\'acteur renseigné !');}
            break;

            case 'addComment' :
                if(isset($_POST['comment'], $_GET['id']))
                {
                    $_GET['id'] = (int) $_GET['id'];
                    $_SESSION['id'] = (int) $_SESSION['id'];
                    $_POST['comment'] = htmlspecialchars($_POST['comment']);

                    addComment($_SESSION['id'], $_GET['id'], $_POST['comment']);
                }
                else{throw new Exception('probleme de formulaire');}
            break;
        }
    }
    else {

        if(!empty($_SESSION['username']))
        {
            listActors();
        }
        else
        {
            connect();
        }
    }
}

catch (Exception $e)
{
    echo 'Erreur : ' . $e->getMessage();
}