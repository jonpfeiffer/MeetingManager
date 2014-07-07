<?php

class MainController extends AppController {
    public function __construct() {
        parent::__construct();

        Payload::js('/MVC/bower_components/moment/min/moment.min.js');
        Payload::js('/MVC/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js');
        Payload::js('/MVC/js/date.js');
        Payload::js('/MVC/js/addparticipants.js');
        Payload::css('/MVC/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.css');
    }

    public function defaultAction(){

        $currMeetings = MeetingManager::getCurrentMeetings(1);

        // Prepare ViewData
        $this->view->currMeetings = $currMeetings;

        include('defaultView.php');

    }

    public function newMeetingAction(){

        include('newMeetingView.php');
    }

    public function createMeetingAction($request){
        // die(print_r($request));
        MeetingController::newMeeting($request);
        //Fix hard coded user id
        $currMeetings = MeetingManager::getCurrentMeetings(1);
        $this->view->currMeetings = $currMeetings;
        include('defaultView.php');
    }

    public function liveMeetingAction($query){
        $participants = MeetingController::getActiveMeeting($query);
        $this->view->participants = $participants;
        include('meeting.php');
    }

    public function detailMeetingAction($query){
        // die(print_r($query));
        $meeting = MeetingManager::getMeeting($query);
        $participants = MeetingManager::getParticipants($query);


        $this->view->meetings = $meetings;
        $this->view->participants = $participants;
    }

    public function oldMeetingAction($person_id){
        $meetings = MeetingManager::getOldMeetings($person_id);
        // die(print_r($meetings));
        $this->view->meetings = $meetings;

        include('oldMeetingView.php');
    }
}