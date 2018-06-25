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
}
