<?php

/**
 * Person
 */
class Person extends Model {

	public function __construct(){
    }

    private $email = "";
    private $first_name = "";
    private $last_name = "";
    private $password = "";
    private $id = 0;
    
    public $registered = false;
    public $loggedIn = false;

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        return $this->email = $email;
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        return $this->id = $id;
    }

    public function getPassword(){
        return $this->password;
    }

    public function setPassword($password){
        return $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    public function getFirstName(){
        return $this->first_name;
    }

    public function setFirstName($first_name){
        return $this->first_name = $first_name;
    }

    public function getLastName(){
        return $this->last_name;
    }

    public function setLastName($last_name){
        return $this->last_name = $last_name;
    }

    public function getRegistered(){
        return $this->registered;
    }

    public function setRegistered($registered){
        return $this->registered = $registered;
    }

    public function getLoggedIn(){
        return $this->loggedIn;
    }

    public function setLoggedIn($loggedIn){
        return $this->loggedIn = $loggedIn;
    }
}