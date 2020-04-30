<?php

class Database {

    public $connection;
    public $db;
    public $url;


    function __construct() {

        $this->db = $this->open_db_connection();

    }

    public function open_db_connection() {

        $url = $_SERVER['HTTP_HOST'];

            if(strstr($url,'punipuni.space')==true) {

                $this->connection = new mysqli(getenv('DB_HOST'),getenv('DB_USER'),getenv('DB_PASS'),getenv('DB_NAME'));
            
            } elseif(strstr($url,'localhost')==true) {
            
                $this->connection = new mysqli(getenv('DB_HOST_L'),getenv('DB_USER_L'),getenv('DB_PASS_L'),getenv('DB_NAME_L'));
            
            }

        $this->connection->set_charset("utf8");

        if($this->connection->connect_errno) {

            die("Database connection failed badly" . $this->connection->connect_error);

        }

        return $this->connection;

    }


    public function query($sql) {

        $result = $this->db->query($sql);
        $this->confirm_query($result);
        return $result;
    }


    private function confirm_query($result) {

        if(!$result) {
            die("Query Failed" . $this->db->error);
        }

    }


    public function escape_string($string) {

        return $this->db->real_escape_string($string);

    }


    public function the_insert_id() {

        return mysqli_insert_id($this->db);

    }


}

$database = new Database();


?>