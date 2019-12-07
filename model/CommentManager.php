<?php

require_once('Manager.php');

class CommentManager  extends Manager{
    public function getComments($postId){
        $db =  $this->dbConnect();
        $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin\') AS comment_date_fr FROM comments WHERE post_id=? ORDER BY comment_date DESC');
        $comments->execute(array($postId));

        return $comments;
    }

    public function postComment($postId, $author, $comment){
        $db = $this->dbConnect();

        $comments = $db->prepare('INSERT INTO comments (post_id, author, comment, warning, comment_date) VALUES(?, ?, ?, warning, Now())');
        $addComment = $comments->execute(array($postId, $author, $comment));

        return $addComment;
    }

    public function modifyComment($postId, $author, $comment){
        $db = $this->dbConnect();

        $modify = $db->prepare('UPDATE comments SET author=?, comment=? WHERE id=?');
        $moderateComment = $modify->execute(array($author, $comment, $postId));

        return $moderateComment;
    }

    public function signalComment($warning){
        $db = $this->dbConnect();

        $signal = $db->prepare('UPDATE comments SET warning=warning+1 WHERE id=?');
        $warningComment = $signal->execute(array($warning));

        return $warningComment;
    }
}
