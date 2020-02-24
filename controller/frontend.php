<?php
require_once('model/UsersManager.php');
require_once('model/ActorsManager.php');
require_once('model/CommentsManager.php');
require_once('model/LikesManager.php');

/*Secure inputs from user*/
function dataSecure()
{
    foreach($_POST as $key => $value){$_POST[$key] = htmlspecialchars($_POST[$key]);}
    foreach($_GET as $key => $value){$_GET[$key] = htmlspecialchars($_GET[$key]);}
    foreach($_COOKIE as $key => $value){$_COOKIE[$key] = htmlspecialchars($_COOKIE[$key]);}
    $_GET['id'] = (int) $_GET['id'];
}

/*Show connection page, Connect user and show if he is connected */

function isUserConnected()
{
    if (!empty($_SESSION['username']))
    {
        return TRUE;
    }
    else{return FALSE;}
}

function connectUser()
{
    
    if(!empty($_POST['username']) && !empty($_POST['password']))
    {
        $usersManager = new UsersManager();
        $userData = $usersManager->getUser($_POST['username']);

        $isPasswordCorrect = password_verify($_POST['password'], $userData['password']);

        if(!$userData)
        {
            header('Location: index.php?action=connect&error=1');
        }

        if($isPasswordCorrect)
        {
            $usersManager->userConnect($_POST['username'], $userData['password'], $userData['prenom'], $userData['nom'], $userData['id_user'],  $_POST['cookies']);
            header('Location: index.php');
        }
        else{header('Location: index.php?action=connect&error=1');}
    }
    
    require('view/frontend/connectView.php');
    
}

function register()
{
    require('view/frontend/newUserView.php');
}

function registerUser($username, $firstname, $lastname, $password, $question, $answer)
{
    $usersManager = new UsersManager();
    $data = $usersManager->userVerify($username, $firstname, $lastname);

    if($data['username'] == $username)
    {
        $error = 'Le nom d\'utilisateur est déja utilisé';
    }

    if($data['firstname'] == $firstname && $data['lastname'] == $lastname)
    {
        $error = 'Nom et prénom déja enregistrés';
        /*throw new Exception('Nom et Prénom déjà enregistrés !');*/
    }

    $userdata = $usersManager->userRegister($lastname, $firstname, $username, $password, $question, $answer);

    if(!$userdata)
    {
        throw new Exception('L \'utilisateur n\'a pas pu être enregistré');
    }

    require('view/frontend/newUserView.php');
}

function destroyCookies()
{
    session_destroy();
    setcookie('username');
    setcookie('hash');
    setcookie('unprotected');
    header('Location: index.php');
}


function listActors()
{
    $actorsManager = new ActorsManager();
    $actors = $actorsManager->getActors();

    require('view/frontend/connectedView.php');
}

function showActor()
{
    $actorsManager = new ActorsManager();
    $commentsManager = new CommentsManager();
    $likesManager = new LikesManager();

    $actor = $actorsManager->getActor($_GET['id']);
    $comments = $commentsManager->getComments($_GET['id']);
    $nbComments = $commentsManager->getNbComments($_GET['id']);
    $nbLikesDislikes = $likesManager->getLikesDislikes($_GET['id']);
    $userVote = $likesManager->getUserVote($_GET['id'], $_SESSION['id']);
    

    require('view/frontend/actorView.php');
}

function addComment($userId, $actorId, $com)
{
    $commentsManager = new CommentsManager();

    $commentPosted = $commentsManager->setComment($userId, $actorId, $_POST['comment']);

    if ($commentPosted === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=actor&id=' . $actorId);
    }
}

function likeDislike()
{
    $likesManager = new LikesManager();
    $test = $likesManager->setlikeDislike($_GET['id'], $_SESSION['id'], $_GET['vote']);

    header('Location: ?action=actor&id=' . $_GET['id'] . '#likedislike');
}

function resetPassword()
{

    $usersManager = new UsersManager();
    $userData = $usersManager->getUser($_POST['username']);

    $isAnswerCorrect = password_verify($_POST['answer'], $userData['reponse']);

    if($isAnswerCorrect)
    {
        $req = $usersManager->setPassword($_POST['username'], $_POST['password']);
        if($req){connectUser($_POST['username'], $_POST['password']); }else{throw new Exception('erreur bdd');}
    }

    require('view/frontend/resetPasswordView.php');

}

function setUserSettings()
{
    unset($new);
    $usersManager = new UsersManager();
    $userData = $usersManager->getUser($_SESSION['username']);

    if(!empty($_POST))
    {
        $isPasswordCorrect = password_verify($_POST['password'], $userData['password']);

        if($isPasswordCorrect)
        {                
            $_POST['password'] = $_POST['newPassword']; 
            
            foreach($userData as $key => $value)
            {
                if(empty($_POST[$key]))
                {
                    $newValues[$key] = $value;
                }
            }

            if(!empty($_POST['reponse'])){$newValues['reponse'] = password_hash($_POST['reponse'], PASSWORD_DEFAULT);} 
            if(!empty($_POST['newPassword'])){$newValues['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);}      

            unset($newValues['nom'], $newValues['prenom']);

            $req = $usersManager->setNewSettings($newValues);

        }
        else{setUserSettings();}
                
    }
    require('view/frontend/accountView.php');
}