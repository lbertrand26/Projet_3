<?php
session_start();
require('controller/frontend.php');

try
{
    if (isset($_COOKIE['username']) && isset($_COOKIE['hash']))
    {
        require('view/frontend/connectedView.php');
    }

    if(isset($_GET['action']))
    {
        if($_GET['action'] == 'test')
        {
            if (!empty($_POST['username']) && !empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['password']) && !empty($_POST['email']))
            {
                foreach ($_POST as $post => $data)
                {
                    $_POST[$post] = htmlspecialchars($_POST[$post]);
                }
                registerUser($_POST['username'], $_POST['firstname'], $_POST['lastname'],$_POST['password'], $_POST['email']);
            }
            else{
                require('view/frontend/newUserView.php');
                
            }
        }

        elseif($_GET['action'] == 'connect')
        {
            if (!empty($_POST['username']) && !empty($_POST['password']))
            {
                require('view/frontend/connectView.php');
                connectUser($_POST['username'], $_POST['password']);
            }
            else
            {
                require('view/frontend/connectView.php');
            }
        }
        
        elseif($_GET['action'] == 'deconnect')
        {
            session_destroy();
            setcookie('username', "", time() - 3600);
            header('Location: index.php');
            echo 'Vous êtes maintenant déconnecté';
        }

    }
    else
    {
        require('view/frontend/connectView.php');
    }
}

catch (Exception $e)
{
    echo 'Erreur : ' . $e->getMessage();
}