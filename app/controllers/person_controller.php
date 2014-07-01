<?php 
    class PersonController extends AppController{
        public function __construct(){
            parent::__construct();
        }

        public function newPerson($request){

            $person = PersonManager::newPerson();

            $person->setEmail($request['email']);
            $person->setFirstName($request['first_name']);
            $person->setLastName($request['last_name']);
            $person->setPassword($request['password']);
            // $person->attendees => $request['attendees']
            //    die(print_r($request['sched']));
            PersonManager::createPerson($person);
        }

        public function getPerson($request){
            $person = PersonManager($request['email']);

            return $person;
        }

    }