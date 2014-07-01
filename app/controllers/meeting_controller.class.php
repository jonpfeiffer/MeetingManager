<?php 
    class MeetingController extends AppController{
        public function __construct(){
            parent::__construct();
        }

        public function newMeeting($request){

            $meeting = MeetingManager::newMeeting();

            $meeting->setLocation($request['location']);
            $meeting->setTitle($request['title']);
            $meeting->setSched($request['sched']);
            //Fix this to look at session
            $meeting->setOwner(1);
            // $meeting->attendees => $request['attendees']
            //    die(print_r($request['sched']));
            MeetingManager::createMeeting($meeting);
        }

    }