<?php 

class Meeting extends Model {

  public function __construct(){
  }

  private $title = "";
  private $location = "";
  private $sched = "";
  private $start = "";
  private $end = "";
  private $meeting_id = 0;
  private $person_id = 0;
  private $attendees = [];


  public function getTitle(){
    return $this->title;
  }

  public function setTitle($title){
    return $this->title = $title;
  } 

  public function getLocation(){
    return $this->location;
  }

  public function setLocation($location){
    return $this->location = $location;
  } 

  public function getSched(){
    return $this->sched;
  }

  public function setSched($sched){
    return $this->sched = $sched;
  } 

  public function getStart(){
    return $this->start;
  }

  public function setStart($start){
    return $this->start = $start;
  } 

  public function getEnd(){
    return $this->end;
  }

  public function setEnd($end){
    return $this->end = $end;
  } 

  public function getOwner(){
    return $this->person_id;
  }

  public function setOwner($person_id){
    return $this->person_id = $person_id;
  }

  public function setId($meeting_id){
    return $this->meeting_id = $meeting_id;
  }
  
  public function getId(){
    return $this->meeting_id;
  }

  public function getAttendees(){
    return $this->attendees;
  }

  public function getPrettyDate(){

      $date = preg_split( "/(-| )/", $this->sched);
      $dateout = $date[1] . "/" . $date[2];

      return $dateout;

  }

}
