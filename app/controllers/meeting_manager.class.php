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
                WHERE person_id = 1
                AND datetime_sched < NOW()
                AND datetime_start IS NOT NULL
                ORDER BY datetime_sched";

        $results = db::execute($sql);

        // die(print_r($results));
        $meetingResult = [];
        while($row = $results->fetch_assoc()){
            // die(print_r($row));
            $meeting = new Meeting();
            $meeting->setId($row['meeting_id']);
            $meeting->setSched($row['datetime_sched']);
            $meeting->setTitle($row['title']);
            $meeting->duration = self::getMeetingLength($row['meeting_id']);
            // die(print_r($meeting));
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

    public static function updateMeeting($meeting){ 
        // die(print_r($meeting));
        $sql_values = [
            'meeting_id' => db::in_quotes($meeting->getId()),
        ];
        if(strlen($meeting->getStart()) === 0){
            $sql_values['datetime_end'] = db::in_quotes($meeting->getEnd());
        }else{
            $sql_values['datetime_start'] = db::in_quotes($meeting->getStart());
        }
        db::insert_duplicate_key_update('meeting', $sql_values);
    }

    public static function getMeetingLength($meeting_id){
        $sql = "SELECT TIME_TO_SEC(TIMEDIFF(
                (SELECT datetime_start 
                    FROM meeting 
                    WHERE meeting_id=$meeting_id),
                (SELECT datetime_end 
                    FROM meeting 
                    WHERE meeting_id=$meeting_id)
                ))/60;";

        $length = db::execute($sql);
        $length = $length->fetch_assoc();
        $length = implode(',', $length);
        // die(print_r(abs($length)));
        return abs($length);
    }

    public static function hasEndTime($meeting_id){
        $sql = "SELECT * 
                FROM meeting
                WHERE meeting_id = $meeting_id
                LIMIT 1";
        $result = db::execute($sql);
        $result = $result->fetch_assoc();

        if ($result['datetime_end'] !== NULL){
            return true;
        }else{
            return false;
        }
    }

    public static function getMeeting($meeting_id){
        $sql = "SELECT * 
                FROM meeting
                WHERE meeting_id = $meeting_id
                LIMIT 1";

        $result = db::execute($sql);
        $result = $result->fetch_assoc();
        $meeting = new Meeting();
        $meeting->setId($result['meeting_id']);
        $meeting->setSched($result['datetime_sched']);
        $meeting->setTitle($result['title']);
        $meeting->setLocation($result['location']);
        $meeting->setStart($result['datetime_start']);
        $meeting->setEnd($result['datetime_end']);
        $meeting->duration = self::getMeetingLength($result['meeting_id']);

        return $meeting;
    }

}