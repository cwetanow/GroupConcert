<?php
namespace models;

use libs\Db;
use ConcertParticipant;

class Concert implements \JsonSerializable
{
    private $id;
    private $address;
    private $city;
    private $date;
    private $host_id;
    private $host;
    private $title;
    private $spots;
    private $joinedSpots;
    private $performer_id;
    private $performer;

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

    public function setHost($host)
    {
        $this->host = $host;
    }

    public function getHost()
    {
        return $this->host;
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

    public function setJoinedSpots($joinedSpots)
    {
        $this->joinedSpots = $joinedSpots;
    }

    public function getJoinedSpots()
    {
        return $this->joinedSpots;
    }

    public function setPerformer($performer)
    {
        $this->performer = $performer;
    }

    public function getPerformer()
    {
        return $this->performer;
    }

    public function setPerformerId($performer_id)
    {
        $this->performer_id = $performer_id;
    }

    public function getPerformerId()
    {
        return $this->performer_id;
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
            $concert->setJoinedSpots($foundConcert['joined_spots']);
        }

        return $concert;
    }

    public function getAllConcerts()
    {
        $query = (new Db())->getConn()->prepare("SELECT * FROM concerts");
        $query->execute();

        $active_concerts = [];
        while ($current_concert = $query->fetch())
        {
          $current_date = date("Y-m-d h:i:sa");

              $concert =  new Concert();
              $concert->setId($current_concert['id']);
              $concert->setDate($current_concert['start_date']);
              $concert->setAddress($current_concert['address']);
              $concert->setTitle($current_concert['title']);
              $concert->setCity($current_concert['city']);
              $concert->setSpots($current_concert['spots']);
              $concert->setJoinedSpots($current_concert['joined_spots']);

          if($concert->getIsActive()){
              $active_concerts[] = $concert;
          }           
        }

        return $active_concerts;  
    }

    public function hasEmptySlots(){
      return ($this->getSpots() > $this->getJoinedSpots());
    }

    public function getIsActive()
    {
      $current_date = date("Y-m-d h:i:sa");
      $concert_date = $this->getDate();

      return (date_create($current_date) < date_create($concert_date));
    }

    public function insert()
    {
        $query = (new Db())->getConn()->prepare("INSERT INTO `concerts` (start_date, host_id, address, title, city, spots) VALUES (?, ?, ?, ?, ?, ?) ");

        return $query->execute([$this->date, $this->host_id, $this->address, $this->title, $this->city, $this->spots]);
    }

    public static function delete($concert_id)
    {
        $query = (new Db())->getConn()->prepare("DELETE FROM concerts WHERE id=?");
        
        return $query->execute([$concert_id]);
    }

    public static function edit($id, $address, $city, $date, $title, $spots)
    {
        $query = (new Db())->getConn()->prepare("UPDATE concerts SET title=?, start_date=?, address=?, city=?, spots=? WHERE id=?");
        return $query->execute([$title, $date, $address, $city, $spots, $id]);
    }

    public function joinPerson(){
        $query = (new Db())->getConn()->prepare("UPDATE concerts SET joined_spots=? WHERE id=?");
        return $query->execute([$this->getJoinedSpots() + 1, $this->id]);
    }

    public function selectPerformer($performer_id){
        $query = (new Db())->getConn()->prepare("UPDATE concerts SET performer_id=? WHERE id=?");
        return $query->execute([$performer_id, $id]);
    }

    public function populateHost()
    {
        $concert_id = $this->getId(); 

        $query = (new Db())->getConn()->prepare("SELECT c.*, u.username FROM concerts c JOIN users u ON c.host_id = u.id WHERE c.id = '$concert_id'");
        $query->execute();

        $current_concert = $query->fetch();
        $this->setHost($current_concert['username']);
    }

    public function populatePerformer()
    {
        $concert_id = $this->getId(); 

        $query = (new Db())->getConn()->prepare("SELECT c.*, u.username FROM concerts c JOIN users u ON c.performer_id = u.id WHERE c.id = '$concert_id'");
        $query->execute();

        $current_concert = $query->fetch();
        $this->setPerformer($current_concert['username']);
    }

    public function jsonSerialize()
    {
        return (object) get_object_vars($this);
    }
}
