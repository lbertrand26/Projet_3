<?php
require_once('Manager.php');

class UsersManager extends Manager
{
    public function passwordVerify($username, $passwordHash)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, username, passwordhash FROM users WHERE username = :username');
        $req->execute(array('username' => $username));
        $user = $req->fetch();

        return $user;
    }

    public function userConnect($username, $id)
    {
        setcookie('username', $username, time() + 30*24*3600, null, null, false, true);
        $_SESSION['id'] = $id;
        $_SESSION['username'] = $username;
    }

    public function userVerify($userName, $firstName, $lastName, $email)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT username, firstname, lastname, email FROM users WHERE email = :email OR username= :username OR (firstname = :firstname AND lastname = :lastname)');
        $req->execute(array(
            'email' => $email,
            'username' => $userName,
            'firstname' => $firstName,
            'lastname' => $lastName
        ));
        $data = $req->fetch(PDO::FETCH_ASSOC);

        return $data;
    }

    public function userRegister($username, $firstname, $lastname, $password, $email)
    {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO users(username, firstname, lastname, passwordhash, email) VALUES (:username, :firstname, :lastname, :passwordhash, :email)');
        $userdata = $req->execute(array(
                            'username' => $username,
                            'firstname' => $firstname,
                            'lastname' => $lastname,
                            'passwordhash' => $passwordHash,
                            'email' => $email
                            ));
        return $userdata;

    }
}