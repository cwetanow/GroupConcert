<?php
namespace models;

use libs\Db;

class Concert implements \JsonSerializable
{
    private $id;
    private $address;
    private $city;
    private $date;
    private $host_id;
    private $title;
    private $spots;

    public function __construct()
    {

    }

    public static function create($address, $city, $date, $host_id, $title, $spots)
    {
        $instance = new self();
        $instance->setAddress($address);
        $instance->setCity($city);
        $instance->setDate($date);
        $instance->setHostId($host_id);
        $instance->setTitle($title);
        $instance->setSpots($spots);

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

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setCity($city)
    {
        $this->city = $city;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setHostId($host_id)
    {
        $this->host_id = $host_id;
    }

    public function getHostId()
    {
        return $this->host_id;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setSpots($spots)
    {
        $this->spots = $spots;
    }

    public function getSpots()
    {
        return $this->spots;
    }

    public function getById($id)
    {
        $query = (new Db())->getConn()->prepare("SELECT * FROM concerts WHERE id = '$id'");
        $query->execute();

        $concert = new Concert();

        while ($foundConcert = $query->fetch()) {
            $concert->setAddress($foundConcert['address']);
            $concert->setDate($foundConcert['start_date']);
            $concert->setHostId($foundConcert['host_id']);
            $concert->setCity($foundConcert['city']);
            $concert->setTitle($foundConcert['title']);
            $concert->setSpots($foundConcert['spots']);
            $concert->setId($foundConcert['id']);
        }

        return $concert;
    }

    public function getAllConcerts()
    {
        $query = (new Db())->getConn()->prepare("");
        $query->execute();

        $active_concerts = [];
        while ($current_concert = $query->fetch())
        {
          $current_date = date();

          if(date_create($current_date) < date_create($current_concert['start_date'])){
              $concert =  new Concert();
              $concert->setId($current_concert['id']);
              $concert->setDate($current_concert['start_date']);
              $concert->setAddress($current_concert['address']);
              $concert->setTitle($current_concert['title']);
              $concert->setCity($current_concert['city']);
              $concert->setSpots($current_concert['spots']);

              $active_concerts[] = $sprint;
          }           
        }

        return $active_concerts;  
    }

    public function insert()
    {
        $query = (new Db())->getConn()->prepare("INSERT INTO `concerts` (start_date, host_id, address, title, city, spots) VALUES (?, ?, ?, ?, ?, ?) ");

        return $query->execute([$this->date, $this->host_id, $this->address, $this->title, $this->city, $this->spots]);
    }

    public function jsonSerialize()
    {
        return (object) get_object_vars($this);
    }
}
