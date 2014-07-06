<?php 
// Init
include($_SERVER['DOCUMENT_ROOT'] . '/app/core/initialize.php');

class TimerController extends BaseController{
    public function __construct(){
    }
        // die(print_r($_POST));
        $meeting = MeetingController::newMeeting();

        $meeting->setId($_POST['meeting_id']);
        $meeting->setStart($_POST['datetime_start']);
        $meeting->setEnd($_POST['datetime_end']);


        // MeetingManager::updateMeeting($meeting);
        $this->view['response'] = $meeting;

}


?>