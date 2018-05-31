<?php
namespace models;
class Error implements \JsonSerializable
{
    private $message;   
    
    public function __construct($message) {
        $this->setMessage($message);
    }

    public function setMessage($message)
    {    
        $this->message = $message;
    }

    public function getMessage()
    {    
        return $this->message;
    }

    public function jsonSerialize() {
        return (object) get_object_vars($this);
    }
  }
?>