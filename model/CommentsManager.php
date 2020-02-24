<?php
require_once('Manager.php');

class CommentsManager extends Manager
{
    public function getNbComments()
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT COUNT(*) AS nbComments FROM post WHERE id_acteur = ?');
        $req->execute([$_GET['id']]);

        $nbComments = $req->fetch(PDO::FETCH_ASSOC)['nbComments'];

        return $nbComments;

    }
    public function getComments($actorId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT p.id_post id_post, p.id_user id_user, p.post post, p.id_acteur id_acteur, a.prenom prenom, DATE_FORMAT(date_add, \'%d/%m/%Y à %H:%i\') datetimefr FROM post p INNER JOIN account a ON a.id_user = p.id_user WHERE p.id_acteur = ? ');
        $comments->execute([$actorId]);

        return $comments;
    }

    public function setComment($userId, $actorId, $com)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM post WHERE id_user = :userid AND id_acteur = :actorId');
        $req->execute(array(
            'userid' => $userId,
            'actorId' => $actorId
        ));
        $isNotPossible = $req->fetch();

        if ($isNotPossible)
        {
            throw new Exception('Vous avez déja commenté cet acteur/partenaire');
        }
        else
        {
            $comments = $db->prepare('INSERT INTO post(id_user, id_acteur, post) VALUES (:userid, :actorid, :comment)');
            $commentPosted = $comments->execute(array(
            'userid' => $userId,
            'actorid' => $actorId,
            'comment' => $com
            ));

            return $commentPosted;
        }
    }


}