<?php

class User extends Db_object{

    protected static $db_table = "users";
    protected static $db_table_fields = array('username','password','weight','goal_intake_calorie','nomal_intake_calorie');
    public $id;
    public $username;
    public $password;
    public $weight;
    public $goal_intake_calorie;
    public $nomal_intake_calorie;


    public function register_user($username, $password) {

        global $database;
    
        $username = $database->escape_string($username);
        $password = $database->escape_string($password);

        $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

        $sql = "INSERT INTO users (username, password) ";
        $sql .= "VALUES('{$username}', '{$password}') ";

        $database->query($sql);

        $message = "Your registration has been submitted";

    }


    public static function verify_user($username, $password) {

        global $database;

        $username = $database->escape_string($username);
        $password = $database->escape_string($password);

        $find_username_query = "SELECT * FROM users WHERE username = '{$username}'";
        $find_username = $database->query($find_username_query);

        $row = mysqli_fetch_array($find_username);

        if(password_verify($password,$row['password'])){
             
            $the_result_array = self::find_by_query($find_username_query);

            return !empty($the_result_array) ? array_shift($the_result_array) : false;

        };

    }


    public function username_exists($username) {

        global $database;
    
        $result = $database->query("SELECT username FROM users WHERE username = '$username' ");

        if(mysqli_num_rows($result) > 0) {
            return true;
        } else {
            return false;
        }

    }


} // End of Class User

































?>