<?php
require_once('model/UsersManager.php');


function test()
{
    require('view/frontend/connectView.php');
}

function registerUser($username, $firstname, $lastname, $password, $email)
{

    $usersManager = new UsersManager();
    $data = $usersManager->userVerify($username, $firstname, $lastname, $email);

    if($data['username'] == $username)
    {
        require('view/frontend/newUserView.php');
        throw new Exception('Nom d\'utilisateur déjà utilisé');
    }

    if($data['firstname'] == $firstname && $data['lastname'] == $lastame)
    {
        require('view/frontend/newUserView.php');
        throw new Exception('Nom et Prénom déjà enregistrés !');
    }

    if ($data['email'] == $email)
    {
        require('view/frontend/newUserView.php');
        throw new Exception('email déjà utilisé');
    }

    $userdata = $usersManager->userRegister($username, $firstname, $lastname, $password, $email);

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

    $isPasswordCorrect = password_verify($password, $userdata['passwordhash']);

    if(!$userdata)
    {
        throw new Exception('mauvais identifiant ou mot de passe !');
    }

    if($isPasswordCorrect)
    {
        $usersManager->userConnect($username, $userdata['id']);
        echo 'Vous etes connecté';
    }
    else{throw new Exception('erreur de mdp');}
}