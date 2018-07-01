<?php
namespace models;

use libs\Db;

class Comment implements \JsonSerializable
{
    private $id;
    private $user_id;
    private $comment_text;
    private $concert_id;

    private $user;

    public function __construct()
    {

    }

    public static function create($user_id, $comment_text, $concert_id)
    {
        $instance = new self();
        $instance->setCommentText($comment_text);
        $instance->setUserId($user_id);
        $instance->setConcertId($concert_id);

        return $instance;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setConcertId($concert_id)
    {
        $this->concert_id = $concert_id;
    }

    public function getConcertId()
    {
        return $this->concert_id;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function setCommentText($comment_text)
    {
        $this->comment_text = $comment_text;
    }

    public function getCommentText()
    {
        return $this->comment_text;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }
  
    public function getUser()
    {
        return $this->user;
    }

    public function insert()
    {
        $query = (new Db())->getConn()->prepare("INSERT INTO `comments` (user_id, comment_text, concert_id) VALUES (?, ?, ?)");

        return $query->execute([$this->user_id, $this->comment_text, $this->concert_id]);
    }

    public static function delete($comment_id)
    {
        $query = (new Db())->getConn()->prepare("DELETE FROM comments WHERE id=?");
        
        return $query->execute([$comment_id]);
    }

    public static function getConcertComments($concert_id)
    {
        $query = (new Db())->getConn()->prepare("SELECT u.username, c.id, c.concert_id, c.user_id, c.comment_text FROM comments c JOIN users u ON c.user_id = u.id WHERE c.concert_id = '$concert_id' ORDER BY c.id");
        
        $query->execute();
        
        $comments = [];

        while ($found_comment = $query->fetch())
        {
            $comment =  new Comment();
            $comment->setId($found_comment['id']);
            $comment->setUser($found_comment['username']);
            $comment->setConcertId($found_comment['concert_id']);
            $comment->setUserId($found_comment['user_id']);
            $comment->setCommentText($found_comment['comment_text']);

            $comments[] = $comment;
        }

        return $comments;
    } 

    public function jsonSerialize()
    {
        return (object) get_object_vars($this);
    }
}
