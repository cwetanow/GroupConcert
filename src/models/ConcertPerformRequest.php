<?php
namespace models;

use libs\Db;

class ConcertPerformRequest implements \JsonSerializable
{
    private $user_id;
    private $concert_id;
    private $accepted;

    const STATUS_PENDING = 0;
    const STATUS_ACCEPTED = 1;
    const STATUS_REJECTED = 2;

    public function __construct()
    {

    }

    public static function create($user_id, $concert_id)
    {
        $instance = new self();
        $instance->setUserId($user_id);
        $instance->setConcertId($concert_id);
        $instance->setStatus(self::STATUS_PENDING);

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

    public function setStatus($status)
    {
        $this->$status = $status;
    }

    public function getStatus()
    {
        return $this->$status;
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
        $query = (new Db())->getConn()->prepare("INSERT INTO `concert_perform_requests` (user_id, concert_id, status) VALUES (?, ?, ?) ");

        return $query->execute([$this->user_id, $this->concert_id]);
    }

    public static function getConcertPerformRequests($concert_id)
    {
        $query = (new Db())->getConn()->prepare("SELECT u.full_name, u.id, u.username FROM concert_perform_requests p JOIN users u ON p.user_id = u.id WHERE p.concert_id = '$concert_id'");
        $query->execute();
        
        $perform_requests = [];

        while ($found_perform_request = $query->fetch())
        {
            $user = new User();            
            $user->setFullName($found_participant["full_name"]);
            $user->setUsername($found_participant["username"]);
            $user->setId($found_participant["id"]);            
            
            $perform_requests[] = $user;
        }

        return $perform_requests;
    } 

    public static function hasUserSentPerformRequest($concert_id, $user_id)
    {      
        $query = (new Db())->getConn()->prepare("SELECT u.full_name, u.id, u.username FROM concert_perform_requests p JOIN users u ON p.user_id = u.id WHERE p.concert_id = '$concert_id' AND p.user_id = '$user_id'");

        $query->execute();
        $user = new User();            
        while ($found_perform_request = $query->fetch())
        {
            $user->setId($found_perform_request["id"]);            
        }
        
        return $user;
    }
}
