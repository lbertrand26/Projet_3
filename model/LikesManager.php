<?php
require_once('Manager.php');

class LikesManager extends Manager
{
    public function getLikesDislikes($actorId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT COUNT(vote) AS nbvote FROM vote WHERE id_acteur = ? AND vote = ?');

        $nbLikesDislikes = array('likes' => 1, 'dislikes' => 2 );

        foreach($nbLikesDislikes as $key => $value)
        {
            $req->execute(array($actorId, $value));
            $nbLikesDislikes[$key] = $req->fetch(PDO::FETCH_ASSOC)['nbvote'];
        }
        
    return $nbLikesDislikes;
    }

    public function getUserVote()
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT vote, id_user FROM vote WHERE id_acteur = :actorId AND id_user = :userId ');
        $req->execute(array(
            'actorId' => $_GET['id'],
            'userId' => $_SESSION['id']
        ));

        $userVote = $req->fetch(PDO::FETCH_ASSOC);

        switch($userVote['vote'])
        {
            case 0:
                $userVote = array('thumbsup' => 'r', 'thumbsdown' => 'r');
            break;
            case 1:
                $userVote = array('thumbsup' => 's', 'thumbsdown' => 'r');
            break;
            case 2:
                $userVote = array('thumbsup' => 'r', 'thumbsdown' => 's');
            break;
        }
        

        return $userVote;
    }

    public function setLikeDislike($actorId, $userId, $vote)
    {
        $db = $this->dbConnect();
        $like = $db->prepare('SELECT id_acteur, id_user, vote FROM vote WHERE id_acteur = ? AND id_user = ?');
        $like->execute(array($actorId, $userId));

        $isLikedDisliked = $like->fetch();

        $values = array('vote' => $vote,'actorId' => $actorId,'userId' => $userId);

            if(!empty($isLikedDisliked))
            {
                if ($isLikedDisliked['vote'] == $vote )
                {
                    $req = $db->prepare('DELETE FROM vote WHERE id_acteur = :actorId AND id_user = :userId AND vote = :vote');
                    $req->execute($values);
                }
                else{
                $req = $db->prepare('UPDATE vote set vote = :vote WHERE id_acteur = :actorId AND id_user = :userId ');
                $req->execute($values);
                }
            }
            elseif(empty($isLikedDisliked))
            {
                $req = $db->prepare('INSERT INTO vote(id_acteur, id_user, vote) VALUES (:actorId, :userId, :vote)');
                $req->execute($values);
                echo 'test';

            }


    }
 }