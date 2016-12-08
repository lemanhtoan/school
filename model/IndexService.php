<?php
session_start();

class IndexService {
    
    public function openDb() {
        $conn = mysql_connect("localhost", "root", "123456a@"); //123456a@ 11111
        if (!$conn) {
            throw new Exception("Connection to the database server failed!");
        }
        if (!mysql_select_db("school")) {
            throw new Exception("No database found on database server.");
        }
        mysql_set_charset('utf8', $conn);
    }
    
    public function closeDb() {
        mysql_close();
    }

    public function checkActive($hash) {       
	$dbres = mysql_query("SELECT * FROM user_verified WHERE hash=$hash AND active = '0'");
        if (mysql_fetch_object($dbres)) {
	    mysql_query("UPDATE user_verified SET active = 1 WHERE hash = '$hash'");
	}	
    }
}
?>
