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
            $out = PersonManager::createPerson($person);
            // die(print_r($out));
            return $out;
        }

        public function getPerson($request){
            $person = PersonManager($request['email']);

            return $person;
        }

    }