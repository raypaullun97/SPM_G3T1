<?php
class ConnectionManager {
    public function getConnection() {
        $servername = '127.0.0.1';
        $dbname = 'lms';
        $username = 'root';
        $password = '';
        
        $url  = "mysql:host=$servername;dbname=$dbname";
        return new PDO($url, $username, $password);  
    }
}
?>