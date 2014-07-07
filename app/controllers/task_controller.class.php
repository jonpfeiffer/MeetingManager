<?php 
    class TaskController extends AppController{
        public function __construct(){
            parent::__construct();
        }

        public function newTask($request){

            $task = TaskManager::newTask();

            $task->setPerson($request['person_id']);
            $task->setMeeting($request['meeting_id']);
            $task->setDeliverable($request['task']);
            $task->setDue($request['date_due']);
            
            $out = TaskManager::createTask($task);
            // die(print_r($out));
            return $out;
        }

        public function getTasks($request){
            $tasks = TaskManager::getTasks($request['person_id'], $request['meeting_id']);

            return $tasks;
        }

        

    }