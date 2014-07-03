<?php 
class PersonManager extends AppController{
    public function __construct(){
        parent::__construct();
    }

    public static function newPerson(){
        $person = new Person;
        return $person;
    }

    public static function createPerson($person){
        
        $person_sql_values = [
            'email' => db::in_quotes($person->getEmail()),
            'first_name' => db::in_quotes($person->getFirstName()),
            'last_name' => db::in_quotes($person->getLastName()),
            'password' => db::in_quotes($person->getPassword())
        ];
        $results = db::insert('person', $person_sql_values);
        // die(print_r($results));
        return $results->insert_id;
    }

    public static function personExists($email){
        $email = db::in_quotes($email);
        $sql = "SELECT *
                FROM person
                WHERE email = $email
                LIMIT 1";

        $results = db::execute($sql);
        if ($results->num_rows > 0){
            $results = $results->fetch_assoc();
            // $person = PersonController::newPerson($results);
            $person = $results['person_id'];
            return $person;
        }else{
            $results = self::newPerson();
        // die(print_r($results));
            return $results;
        }


    }

}