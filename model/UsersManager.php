<?php
require_once('Manager.php');

class UsersManager extends Manager
{
    public function passwordVerify($username, $password)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id_user, nom, prenom, username, password FROM users WHERE username = :username');
        $req->execute(array('username' => $username));
        $userdata = $req->fetch();

        return $userdata;
    }

    public function userConnect($username, $id, $hash, $firstname, $lastname)
    {
        setcookie('firstname', $firstname, time() +30*24*3600, null, null, false, true);
        setcookie('lastname', $lastname, time() + 30*24*3600, null, null, false, true);
        setcookie('username', $username, time() + 30*24*3600, null, null, false, true);
        setcookie('hash', $hash, time() + 30*24*3600, null, null, false, true);
        $_SESSION['id'] = $id;
        $_SESSION['username'] = $username;
    }

    public function userVerify($userName, $firstName, $lastName)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT nom, prenom, username FROM users WHERE username= :username OR (prenom = :firstname AND nom = :lastname)');
        $req->execute(array(
            'username' => $userName,
            'firstname' => $firstName,
            'lastname' => $lastName
        ));
        $data = $req->fetch(PDO::FETCH_ASSOC);

        return $data;
    }

    public function userRegister($lastname, $firstname, $username, $password, $question, $answer)
    {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $answer = password_hash($answer, PASSWORD_DEFAULT);

        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO users(nom, prenom, username, password, question, reponse ) VALUES ( :lastname, :firstname, :username, :passwordhash, :question, :answer)');
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

    public function masterPasswordVerify($username, $password)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT username, password FROM protection WHERE username = :username');
        $req->execute(array('username' => $username));

        $userdata = $req->fetch();

        if($userdata)
        {
            $ispasswordcorrect = password_verify($password, $userdata['password']);
            $hash = password_hash($username . time() . $password, PASSWORD_DEFAULT);

            if($ispasswordcorrect){$this->authorisation($hash);}
            else{throw new Exception('Mauvais username ou mot de passe');}

        }
        else{throw new Exception('Mauvais username ou mot de passe');}

    }

    private function authorisation($hash)
    {
        setcookie('unprotected', $hash, time() + 30*24*3600, null, null, false, true);
    }

}