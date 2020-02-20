<?php
require_once('model/UsersManager.php');


function unprotect($username, $password)
{
    $usersManager = new UsersManager();
    $userdata = $usersManager->masterPasswordVerify($username, $password);

    if($userdata)
    {
        throw new Exception('Problème de connexion');
    }
    else
    {
        header('Location: index.php');
    }

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
        header('Location:index.php');
    }
    else{throw new Exception('Mauvais identifiant ou mot de passe !');}
}