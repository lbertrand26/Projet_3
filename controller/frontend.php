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
            $error[] = 'Nom d\'utilisateur ou mot de passe incorrect';
        }

        elseif(!$isPasswordCorrect)
        {
            $error[] = 'Nom d\'utilisateur ou mot de passe incorrect';
        }

        if(empty($error))
        {
            $usersManager->userConnect($_POST['username'], $userData['password'], $userData['prenom'], $userData['nom'], $userData['id_user'],  $_POST['cookies']);
            header('Location: index.php');
        }

    }
    
    require('view/frontend/connectView.php');
    
}

function registerUser()
{
    if(!empty($_POST))
    {
        $usersManager = new UsersManager();
        $data = $usersManager->userVerify($_POST['username'], $_POST['firstname'], $_POST['lastname']);

        if($data['username'] == $_POST['username'])
        {
            $error[] = 'Le nom d\'utilisateur est déja utilisé';
        }

        if($data['prenom'] == $_POST['firstname'] && $data['nom'] == $_POST['lastname'])
        {
            $error[] = 'Nom et Prénom déja enregistrés';
        }

        if(empty($error))
        {
            $userdata = $usersManager->userRegister($_POST['lastname'], $_POST['firstname'], $_POST['username'], $_POST['password'], $_POST['question'], $_POST['answer']);
        }
    }
    require('view/frontend/newUserView.php');
}

function destroyCookies()
{
    session_destroy();
    setcookie('username');
    setcookie('hash');

    connectUser();
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
    $userComment = $commentsManager->getComment($_GET['id'], $_SESSION['id']);
    $nbComments = $commentsManager->getNbComments($_GET['id']);
    
    $nbLikesDislikes = $likesManager->getLikesDislikes($_GET['id']);
    $userVote = $likesManager->getUserVote($_GET['id'], $_SESSION['id']);
    
    if(empty($userComment)){$butonValue = 'Commenter';}else{$butonValue = 'Editer';}

    require('view/frontend/actorView.php');
}

function addComment($actorId, $comment)
{
    $commentsManager = new CommentsManager();
    $userComment = $commentsManager->getComment($actorId, $_SESSION['id'] );

    if(!empty($userComment))
    {
        if(empty($comment)){$commentsManager->deleteComment($_SESSION['id'], $actorId);}
        else{$commentsManager->updateComment($_SESSION['id'], $actorId, $comment);}
    }

    elseif(empty($userComment))
    {
        $commentPosted = $commentsManager->setComment($_SESSION['id'], $actorId, $comment);
    }

    header('Location: index.php?action=actor&id=' . $actorId);
    
}

function likeDislike()
{
    $likesManager = new LikesManager();
    $likedislike = $likesManager->setlikeDislike($_GET['id'], $_SESSION['id'], $_GET['vote']);

    header('Location: ?action=actor&id=' . $_GET['id'] . '&comment=' . $_GET['comment'] . '#likedislike');
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
    $usersManager = new UsersManager();
    $userData = $usersManager->getUser($_SESSION['username']);

    if(!empty($_POST))
    {

        $isPasswordCorrect = password_verify($_POST['password'], $userData['password']);
        if($isPasswordCorrect)
        {
            $password = $_POST['password'];
            $_POST['password'] = $_POST['newPassword']; 
            
            foreach($userData as $key => $value)
            {
                if(empty($_POST[$key]))
                {
                    $newValues[$key] = $value;
                }
                else{$newValues[$key] = $_POST[$key];}

            }

            if(!empty($_POST['reponse'])){$newValues['reponse'] = password_hash($_POST['reponse'], PASSWORD_DEFAULT);}
            if(!empty($_POST['newPassword'])){$password = $_POST['newPassword'];$newValues['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);}   
            unset($newValues['nom'], $newValues['prenom']);
            
            $usersManager->setNewSettings($newValues);

            if(isset($_COOKIE)){$_POST['cookies'] = 1;}

            $usersManager->userConnect($newValues['username'], $userData['password'], $userData['prenom'], $userData['nom'], $userData['id_user'],  $_POST['cookies']);
            
            $error = 'Profil modifié avec succès !';
        }

        $error[] = 'Mot de passe incorrect';
                
    }
    require('view/frontend/accountView.php');

}