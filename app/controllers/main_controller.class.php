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

        include('meetingDetailView.php');
    }

    public function startMeetingAction(){
        $meeting = MeetingManager::newMeeting();

        $meeting->setId($_POST['meeting_id']);
        $meeting->setStart($_POST['datetime_start']);

        MeetingManager::updateMeeting($meeting);

        header('Content-Type: application/json');
        http_response_code('200');
        echo json_encode($meeting);

    }

    public function endMeetingAction(){
        $meeting = MeetingManager::newMeeting();

        $meeting->setId($_POST['meeting_id']);
        $meeting->setEnd($_POST['datetime_end']);

        MeetingManager::updateMeeting($meeting);

        header('Content-Type: application/json');
        http_response_code('200');
        echo json_encode($meeting);

    }

    public function addTaskAction($request){
        TaskController::newTask($request);

        header('Content-Type: application/json');
        http_response_code('200');
        echo json_encode($meeting);
    }

    public function oldMeetingAction($person_id){
        $meetings = MeetingManager::getOldMeetings($person_id);
        // die(print_r($meetings));
        $this->view->meetings = $meetings;

        include('oldMeetingView.php');
    }
}