<?php 
    class MeetingController extends AppController{
        public function __construct(){
            parent::__construct();
        }

        public function newMeeting($request){
                    // die(print_r($request));
            $attendees = [];
            $meeting = MeetingManager::newMeeting();
            //get standard meeting info and remove from request array
            $meeting->setLocation($request['location']);
            unset($request['location']);
            $meeting->setTitle($request['title']);
            unset($request['title']);
            $meeting->setSched($request['sched']);
            unset($request['sched']);
            $i = $request['count'];
            unset($request['count']);
            //Check each email against database, if it exists push id if not create and push id
            foreach ($request as $key => $value) {
                $person = PersonManager::personExists($value);
                // die(print_r($person));
                if (gettype($person) == 'object'){
                    $thing = [];
                    $thing['email'] = $value;
                    $person = PersonController::newPerson($thing);
                }
                // }else{
                //     $person = $person;
                // }
                array_push($attendees, $person);
            }
            //Fix this to look at session
            $meeting->setOwner(1);
               // die(print_r($attendees));
            MeetingManager::createMeeting($meeting, $attendees);
        }

        public function getActiveMeeting($request){
            //extract meeting_id from request and pass off to manager
            // $meeting_id = $request['meeting_id'];
            $participants = MeetingManager::getParticipants($request);
            // die(print_r($participants));
            return $participants;
        }

    }