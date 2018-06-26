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
}
