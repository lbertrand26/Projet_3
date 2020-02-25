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

    public function getComment($actorId, $userId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM post WHERE id_user = :userid AND id_acteur = :actorId');
        $req->execute(array(
            'userid' => $userId,
            'actorId' => $actorId
        ));
        $userComment = $req->fetch();

        return $userComment;
    }

    public function setComment($userId, $actorId, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO post(id_user, id_acteur, post) VALUES (:userid, :actorid, :comment)');
        $commentPosted = $comments->execute(array(
            'userid' => $userId,
            'actorid' => $actorId,
            'comment' => $comment
            ));

        return $commentPosted;
    }
    
    public function updateComment($userId, $actorId, $comment)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE post SET post = :comment WHERE id_user = :userId AND id_acteur = :actorId');
        $req->execute(array(
            'comment' => $comment,
            'userId' => $userId,
            'actorId' => $actorId
        ));

        return $req;
    }

    public function deleteComment($userId, $actorId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM post WHERE id_user = :userId AND id_acteur = :actorId');
        $req->execute(array(
            'userId' => $userId,
            'actorId' => $actorId
        ));

        return $req;
    }

}