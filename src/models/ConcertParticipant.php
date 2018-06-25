<?php
namespace models;

use libs\Db;

class Concert implements \JsonSerializable
{
    private $user_id;
    private $concert_id;

    public function __construct()
    {

    }

    public static function create($user_id, $concert_id)
    {
        $instance = new self();
        $instance->setUserId($user_id);
        $instance->setConcertId($concert_id);

        return $instance;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function setConcertId($concert_id)
    {
        $this->concert_id = $concert_id;
    }

    public function getConcertId()
    {
        return $this->concert_id;
    }

    public function insert()
    {
        $query = (new Db())->getConn()->prepare("INSERT INTO `concert_paticipants` (user_id, concert_id) VALUES (?, ?) ");

        return $query->execute([$this->user_id, $this->concert_id]);
    }

    public static function getConcertParticipants($concert_id)
    {
        $query = (new Db())->getConn()->prepare("SELECT u.full_name, u.id, u.username FROM concert_participants p JOIN users u ON p.user_id = u.id WHERE p.concert_id = '$concert_id'");
        $query->execute();
        
        $participants = [];

        while ($found_participant = $query->fetch())
        {
            $user = new User();            
            $user->setFullName($found_participant["full_name"]);
            $user->setUsername($found_participant["username"]);
            $user->setId($found_participant["id"]);            
            
            $participants[] = $user;
        }
        return $participants;
    } 

    public static function isUserParticipant($concert_id, $user_id)
    {      
        $query = (new Db())->getConn()->prepare("SELECT u.full_name, u.id, u.username FROM concert_participants p JOIN users u ON p.user_id = u.id WHERE p.concert_id = '$concert_id' AND p.user_id = '$user_id'");

        $query->execute();
        $user = new User();            
        while ($found_participant = $query->fetch())
        {
            $user->setId($found_participant["id"]);            
        }
        
        return $user;
    }
}
