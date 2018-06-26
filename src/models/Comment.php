<?php
namespace models;

use libs\Db;

class Comment implements \JsonSerializable
{
    private $id;
    private $comment_date;
    private $user_id;
    private $comment_text;
    private $concert_id;

    private $user;

    public function __construct()
    {

    }

    public static function create($comment_date, $user_id, $comment_text, $concert_id)
    {
        $instance = new self();
        $instance->setCommentDate($comment_date);
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

    public function setCommentDate($comment_date)
    {
        $this->comment_date = $comment_date;
    }

    public function getCommentDate()
    {
        return $this->comment_date;
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
        $query = (new Db())->getConn()->prepare("INSERT INTO `comments` (comment_date, user_id, comment_text, concert_id) VALUES (?, ?, ?, ?)");

        return $query->execute([$this->comment_date, $this->user_id, $this->comment_text, $this->concert_id]);
    }

    public static function delete($comment_id)
    {
        $query = (new Db())->getConn()->prepare("DELETE FROM comments WHERE id=?");
        
        return $query->execute([$comment_id]);
    }

    public static function getConcertComments($concert_id)
    {
        $query = (new Db())->getConn()->prepare("SELECT u.username, c.id, c.concert_id, c.comment_date, c.user_id, c.comment_text FROM comments c JOIN users u ON c.user_id = u.id WHERE c.concert_id = '$concert_id' ORDER BY c.comment_date");
        
        $query->execute();
        
        $comments = [];

        while ($found_comment = $query->fetch())
        {
            $comment =  new Comment();
            $concert->setId($current_concert['id']);
            $concert->setUser($current_concert['username']);
            $concert->setConcertId($current_concert['concert_id']);
            $concert->setCommentDate($current_concert['comment_date']);
            $concert->setUserId($current_concert['user_id']);
            $concert->setCommentText($current_concert['comment_text']);

            $comments[] = $comment;
        }

        return $comments;
    } 
}
