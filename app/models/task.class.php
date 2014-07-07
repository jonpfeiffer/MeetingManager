<?php

/**
 * Task
 */
class Task extends Model {

    public function __construct(){
    }

    private $person_id = 0;
    private $meeting_id = 0;
    private $deliverable_text = "";
    private $datetime_due = "";
    
    public $is_completed = false;


    public function getPerson(){
        return $this->person_id;
    }

    public function setPerson($person_id){
        return $this->person_id = $person_id;
    }

    public function getMeeting(){
        return $this->meeting_id;
    }

    public function setMeeting($meeting_id){
        return $this->meeting_id = $meeting_id;
    }

    public function getDeliverable(){
        return $this->deliverable_text;
    }

    public function setDeliverable($deliverable_text){
        return $this->deliverable_text = $deliverable_text;
    }

    public function getDue(){
        return $this->datetime_due;
    }

    public function setDue($datetime_due){
        return $this->datetime_due = $datetime_due;
    }

    public function getPrettyDate(){

      $date = preg_split( "/(-| )/", $this->datetime_due);
      $dateout = $date[1] . "/" . $date[2];

      return $dateout;

  }
}