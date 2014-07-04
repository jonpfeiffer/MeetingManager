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
        $meeting_sql_values = [
            'location' => db::in_quotes($meeting->getLocation()),
            'title' => db::in_quotes($meeting->getTitle()),
            'datetime_sched' => db::in_quotes($meeting->getSched()),
            'person_id' => db::in_quotes($meeting->getOwner())
        ];
        $meeting = db::insert('meeting', $meeting_sql_values);

        // die(print_r($attendees));
        foreach ($attendees as $attendee) {
                // die(print_r($attendee));
            $attendee_sql_values = [
                'meeting_id' => db::in_quotes($meeting->insert_id),
                'person_id' => db::in_quotes($attendee),
                'speaking_duration' => db::in_quotes(0),
                'is_active' => db::in_quotes(0)
            ];

            db::insert('meeting_participant', $attendee_sql_values);
            

        }

    }
        // return $meeting_sql_values;

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
        return $meetingResult;
    } 

}