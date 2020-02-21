<?php
require_once('model/UsersManager.php');
require_once('model/ActorsManager.php');
require_once('model/CommentsManager.php');



function connect()
{
    require('view/frontend/connectView.php');
}

function register()
{
    require('view/frontend/newUserView.php');
}

function destroyCookies()
{
    setcookie('firstname');
    setcookie('lastname');
    setcookie('username');
    setcookie('hash');
    header('Location: index.php');
}

function registerUser($username, $firstname, $lastname, $password, $question, $answer)
{

    $usersManager = new UsersManager();
    $data = $usersManager->userVerify($username, $firstname, $lastname);

    if($data['username'] == $username)
    {
        require('view/frontend/newUserView.php');
        throw new Exception('Nom d\'utilisateur déjà utilisé');
    }

    if($data['firstname'] == $firstname && $data['lastname'] == $lastname)
    {
        require('view/frontend/newUserView.php');
        throw new Exception('Nom et Prénom déjà enregistrés !');
    }

    $userdata = $usersManager->userRegister($lastname, $firstname, $username, $password, $question, $answer);

    if(!$userdata)
    {
        throw new Exception('L \'utilisateur n\'a pas pu être enregistré');
    }

    require('view/frontend/newUserView.php');
    echo 'Utilisateur enregistré avec succès !!';
}

function connectUser($username, $password)
{
    $usersManager = new UsersManager();
    $userdata = $usersManager->passwordVerify($username, $password);

    $isPasswordCorrect = password_verify($password, $userdata['password']);

    if(!$userdata)
    {
        throw new Exception('mauvais identifiant ou mot de passe !');
    }

    if($isPasswordCorrect)
    {
        $usersManager->userConnect($username, $userdata['id_user'], $userdata['password'], $userdata['prenom'], $userdata['nom']);
        header('Location: index.php');
    }
    else{throw new Exception('Mauvais identifiant ou mot de passe !');}
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

    $actor = $actorsManager->getActor($_GET['id']);
    $comments = $commentsManager->getComments($_GET['id']);

    require('view/frontend/actorView.php');
}

function addComment($userId, $actorId, $com)
{

    $com = htmlspecialchars($_POST['comment']);
    $commentsManager = new CommentsManager();

    $comment = $commentsManager->setComment($userId, $actorId, $com);

    if ($commentPosted === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=actor&id=' . $actorId);
    }
}