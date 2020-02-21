<?php

class LikesManager extends Manager
 {
     public function getLikes($actorId)
     {
         $db = $this->dbConnect();
         $likes = $db->prepare('SELECT COUNT(*) FROM likes WHERE id_actor = ?')
         $nbLikes = $likes->execute([$actorId]);

         return $nbLikes
     }
 }