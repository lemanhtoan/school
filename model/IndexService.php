<?php
session_start();

class IndexService {
    
    public function openDb() {
        $conn = mysql_connect("localhost", "root", "123456a@"); //11111
        if (!$conn) {
            throw new Exception("Connection to the database server failed!");
        }
        if (!mysql_select_db("school")) {
            throw new Exception("No mvc-crud database found on database server.");
        }
        mysql_set_charset('utf8', $conn);
    }
    
    public function closeDb() {
        mysql_close();
    }

}

?>
