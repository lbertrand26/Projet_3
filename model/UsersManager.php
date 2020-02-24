<?php
require_once('Manager.php');

class UsersManager extends Manager
{
    public function getUser($username)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM account WHERE username = :username');
        $req->execute(array('username' => $username));
        $userData = $req->fetch(PDO::FETCH_ASSOC);


        return $userData;
    }

    public function userConnect($username, $hash, $firstname, $lastname, $id, $cookies)
    {
        $_SESSION['firstname'] = $firstname;
        $_SESSION['lastname'] = $lastname;
        $_SESSION['username'] = $username;
        $_SESSION['id'] = $id;

        if($cookies){
            setcookie('username', $username, time() + 30*24*3600, null, null, false, true);
            setcookie('hash', $hash, time() + 30*24*3600, null, null, false, true);
        }

    }

    public function userVerify($username, $firstname, $lastname)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT nom, prenom, username FROM account WHERE username= :username OR (prenom = :firstname AND nom = :lastname)');
        $req->execute(array(
            'username' => $username,
            'firstname' => $firstname,
            'lastname' => $lastname
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

    public function setPassword()
    {
        $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE account SET password = :password WHERE username = :username');
        $req->execute(array(
            'password' => $hash,
            'username' => $_POST['username']
        ));

        return $req;
    }

    public function setNewSettings($new)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE account SET username = :username, question = :question, reponse = :reponse, password = :password WHERE id_user = :id_user');
        $req->execute($new);

        return $req;
    }

}