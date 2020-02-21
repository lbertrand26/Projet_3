<?php
require_once('Manager.php');

class UsersManager extends Manager
{
    public function passwordVerify($username, $password)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id_user, nom, prenom, username, password FROM account WHERE username = :username');
        $req->execute(array('username' => $username));
        $userdata = $req->fetch();

        return $userdata;
    }

    public function userConnect($username, $id, $hash, $firstname, $lastname)
    {
        $_SESSION['firstname'] = $firstname;
        $_SESSION['lastname'] = $lastname;
        $_SESSION['username'] = $username;
        $_SESSION['hash'] = $hash;
        $_SESSION['id'] = $id;
    }

    public function userVerify($userName, $firstName, $lastName)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT nom, prenom, username FROM account WHERE username= :username OR (prenom = :firstname AND nom = :lastname)');
        $req->execute(array(
            'username' => $userName,
            'firstname' => $firstName,
            'lastname' => $lastName
        ));
        $data = $req->fetch();

        return $data;
    }

    public function userRegister($lastname, $firstname, $username, $password, $question, $answer)
    {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $answer = password_hash($answer, PASSWORD_DEFAULT);

        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO account(nom, prenom, username, password, question, reponse ) VALUES ( :lastname, :firstname, :username, :passwordhash, :question, :answer)');
        $userdata = $req->execute(array(
                            'username' => $username,
                            'firstname' => $firstname,
                            'lastname' => $lastname,
                            'passwordhash' => $passwordHash,
                            'question' => $question,
                            'answer' => $answer
                            ));
        return $userdata;

    }

}