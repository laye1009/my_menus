<?php


namespace App\Message;

class MessageNotification
{
    private $id;
    private $from;
    private $description;

    public function __construct($id,$from,$description)
    {
        $this->id = $id;
        $this->from = $from;
        $this->description = $description;
    }

    public function getId()
    { 
        return $this->id;
    }


    public function getFrom()
    { 
        return $this->from;
    }

    public function getDescription()
    { 
        return $this->description;
    }
}