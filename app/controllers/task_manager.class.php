<?php 
class TaskManager extends AppController{
    public function __construct(){
        parent::__construct();
    }

    public static function newtask(){
        $task = new Task;
        return $task;
    }

    public static function createTask($task){
        
        $task_sql_values = [
            'person_id' => db::in_quotes($task->getPerson()),
            'meeting_id' => db::in_quotes($task->getMeeting()),
            'deliverable_text' => db::in_quotes($task->getDeliverable()),
            'datetime_due' => db::in_quotes($task->getDue()),
            'is_complete' => 0
        ];
        $results = db::insert('deliverable', $task_sql_values);
        // die(print_r($results));
        return $results->insert_id;
    }

    public static function getTasks($meeting, $person){
        $sql = "SELECT *
                FROM deliverable
                WHERE person_id = $person
                AND meeting_id = $meeting";
        $results = db::execute($sql);
        $tasks = [];
        while ($row = $results->fetch_assoc()){
            $task = self::newTask();
            $task->setPerson($row['person_id']);
            $task->setMeeting($row['meeting_id']);
            $task->setDeliverable($row['deliverable_text']);
            $task->setDue($row['datetime_due']);
            array_push($tasks, $task);
        }
        return $tasks;
    }

}