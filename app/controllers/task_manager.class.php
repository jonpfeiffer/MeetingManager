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
            'is_complete' => false
        ];
        $results = db::insert('task', $task_sql_values);
        // die(print_r($results));
        return $results->insert_id;
    }

}