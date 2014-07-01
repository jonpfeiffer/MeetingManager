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
        db::insert('person', $person_sql_values);
    }

    public static function personExists($email){
        $sql = "SELECT *
                FROM person
                WHERE email = $email
                LIMIT 1";

        $results = db::execute($sql);

        if ($results->numrows > 0){
            $results = $results->fetch_assoc();
            return $results;
        }else{
            $results = $this->newPerson();
            return $results;
        }


    }

}