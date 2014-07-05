<?php 
class MeetingManager extends AppController{
    public function __construct(){
        parent::__construct();
    }

    public static function newMeeting(){
        $meeting = new Meeting;
        return $meeting;
    }

    public static function createMeeting($meeting, $attendees){
        
        //Build insert statement for meeting table
        $meeting_sql_values = [
            'location' => db::in_quotes($meeting->getLocation()),
            'title' => db::in_quotes($meeting->getTitle()),
            'datetime_sched' => db::in_quotes($meeting->getSched()),
            'person_id' => db::in_quotes($meeting->getOwner())
        ];
        $meeting = db::insert('meeting', $meeting_sql_values);

        //Build insert statement for meeting_participant table
        foreach ($attendees as $attendee) {
            $attendee_sql_values = [
                'meeting_id' => db::in_quotes($meeting->insert_id),
                'person_id' => db::in_quotes($attendee),
                'speaking_duration' => db::in_quotes(0),
                'is_active' => db::in_quotes(0)
            ];

            db::insert('meeting_participant', $attendee_sql_values);
        }
    }

    public static function getCurrentMeetings($person_id){
        $sql = "SELECT *
                FROM meeting
                WHERE person_id = $person_id
                AND datetime_sched > NOW() - INTERVAL 4 HOUR
                ORDER BY datetime_sched";

        $results = db::execute($sql);

        // die(print_r($results));
        $meetingResult = [];
        while($row = $results->fetch_assoc()){

            $meeting = new Meeting();
            $meeting->setId($row['meeting_id']);
            $meeting->setSched($row['datetime_sched']);

            array_push($meetingResult, $meeting);

        }
        // die(print_r($meetingResult));
        return $meetingResult;
    } 

    public static function getOldMeetings($person_id){
        $sql = "SELECT *
                FROM meeting
                WHERE person_id = $person_id
                AND datetime_sched < NOW() + INTERVAL 4 HOUR
                AND datetime_start != NULL
                ORDER BY datetime_sched";

        $results = db::execute($sql);

        // die(print_r($results));
        $meetingResult = [];
        while($row = $results->fetch_assoc()){

            $meeting = new Meeting();
            $meeting->setId($row['meeting_id']);
            $meeting->setSched($row['datetime_sched']);

            array_push($meetingResult, $meeting);

        }
        return $meetingResult;
    } 

    public static function getParticipants($meeting_id){
        $meeting_id = db::in_quotes($meeting_id);
        $sql = "SELECT p.person_id, m.meeting_participant_id, p.email, p.first_name, p.last_name 
                FROM person p 
                JOIN meeting_participant m 
                ON p.person_id = m.person_id 
                WHERE m.meeting_id = $meeting_id";
        $results = db::execute($sql);

        $participants = [];

        while ($row = $results->fetch_assoc()){
            //die(print_r($row));
            $person = new Person();
            $person->setId($row['person_id']);
            $person->participant_id = $row['meeting_participant_id'];
            $person->setFirstName($row['first_name']);
            $person->setLastName($row['last_name']);
            $person->setEmail($row['email']);

            array_push($participants, $person);
        }
        return $participants;
    }

}