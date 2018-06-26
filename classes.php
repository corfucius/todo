<?php
include'config.php';


class todos {
    private $db;
    function __construct (){
    $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    }
}

class User {

    private $db;
    private $errors;

    function __construct (){

        $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    }

    public function create($username, $password, $email) {

        // Encrypt password using link open on your browser
        // before inserting it into the database.

        if ( $this->db->query('INSERT INTO users (username, password, email, creation_date) VALUES("'.$username.'", md5("'.$password.'"), "'.$email.'", NOW())') ) {
            echo 'New User!';
        } else {
            echo 'Something went wrong!';
        }
    }

    public function validate_create_form($username, $password, $email, $confirm_password) {
        if ($password != $confirm_password) {
            echo 'Your passwords do not match<br>';
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo 'invalid email address';
        } else {
        $users = new User();
        $users->create($username, $password, $email); 

        header('location: ../index.php');
        }
    }

    public function check_for_login_errors($username, $email, $password) {
        
        if(empty($username)) {
            echo "Please enter a username <br>";
        }
        if(empty($email)) {
            echo 'Please enter an email <br>';
        }
        if(empty($password)) {
            echo 'Please enter a password <br>';
        } else {
            return true;
        } 
      }
    }   
 
