<?php
class ConnectionManager {
    public function getConnection() {
        $servername = 'localhost';
        $dbname = 'lms';
        $username = 'root';
        $password = 'MCWUlrGKEOi2';

        
        $url  = "mysql:host=$servername;dbname=$dbname;port=8888";
        return new PDO($url, $username, $password);  
    }
}
?>