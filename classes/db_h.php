<?php 

    //Parent Class of StoreReports and FetchReports 
    //create mysql connection to DB 
    class Dbh {
        private $hostname;
        private $username;
        private $password;
        private $dbname;
        
        //Method to create a connection
        protected function connect() {
            require('./config/config.php');

            $this->hostname = DB_HOST;
            $this->username = DB_USER;
            $this->password = DB_PASS;
            $this->dbname = DB_NAME;
            $conn = new mysqli($this->hostname, $this->username, $this->password, $this->dbname);
            
            if(mysqli_connect_errno()) {
                //if true then connection failed
                echo "Connection to Database Failed". mysqli_connect_errno();
            }
            return $conn;

        }

        
    }



?>