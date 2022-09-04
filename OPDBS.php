<?php
    class Opdbs {
        
        protected $servername = "localhost";
        protected $username = "root";
        protected $password = ""; //Your password here
        protected $dbname = "online_attendance";

        public function __construct(){
            $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        }

        public function __toString(){
            if ($this->conn->connect_error){
                die("Connection failed");
            }else{
                echo("Success");
            }    
        }
    }
?>