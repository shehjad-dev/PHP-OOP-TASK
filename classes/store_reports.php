<?php 
    //Child Class of Dbh
    //Class to Store Reports in DB
    class StoreReports extends Dbh {
        private $conn;
        public function __construct() {
            $this->conn = $this->connect();       
        }
        
        //Method to store reports in the DB
        public function saveReports($amount,  $buyer, $receipt_id, $items, $email, $client_ip,$note, $city, $phone, $entry_at, $entry_by) {
            
            //Query to insert bubyer reports in to DB
            $query = "INSERT INTO reports(amount, buyer, receipt_id, items, buyer_email, buyer_ip, note, city, phone, entry_at, entry_by) VALUES('$amount', '$buyer', '$receipt_id', '$items', '$email', '$client_ip','$note', '$city', '$phone', '$entry_at', '$entry_by')";
            
            //Performing mysqli_query and redirecting to ROOT_URL
            if(mysqli_query($this->conn, $query)) {
                header('Location: '. ROOT_URL. '');
            } else {
                echo 'Error: '. mysqli_error($this->conn);
            }

        }
        
        //Close Connection
        public function __destruct() {
            $this->conn->close();
        }

        
    }



?>