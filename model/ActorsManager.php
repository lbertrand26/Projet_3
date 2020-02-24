<?php
require_once('Manager.php');

class ActorsManager extends Manager
{
    public function getActors()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT * FROM acteur');

        return $req;
    }

    public function getActor($actorId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM acteur WHERE id_acteur = ?');
        $req->execute([$actorId]);

        $actor = $req->fetch();
        $actor['description'] = nl2br($actor['description']);

        if($actor == NULL){throw new Exception('Id acteur non existant');}else{return $actor;}
    }
}