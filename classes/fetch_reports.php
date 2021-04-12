<?php 
    //Child Class of Dbh
    //Class to fetch Reports in the dashboard
    class FetchReports extends Dbh{
        private $conn;
        public function __construct() {
            $this->conn = $this->connect();       
        }
        
        //Method to get all reports and return $reports array
        public function getAllReports() {

            $query = 'SELECT * FROM reports'; 
            $result = mysqli_query($this->conn, $query);
            $reports = mysqli_fetch_all($result, MYSQLI_ASSOC);
            mysqli_free_result($result);
            return $reports;
            
        }
        
        //Method to get Searched Report by ID input and return $query_run as an array
        public function getSearchedReport($id_tosearch) {

            $query = "SELECT * FROM reports WHERE id='$id_tosearch' ";

            $query_run = mysqli_query($this->conn, $query);
            return $query_run;
            
        }
        
        //Close Connection
        public function __destruct() {
            $this->conn->close();
        }


    }


?>