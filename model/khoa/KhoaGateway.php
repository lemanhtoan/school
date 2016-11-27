<?php

/**
 * Table data gateway.
 * 
 *  OK I'm using old MySQL driver, so kill me ...
 *  This will do for simple apps but for serious apps you should use PDO.
 */
class KhoaGateway {
    
    public function selectAll($order) {
        if ( !isset($order) ) {
            $order = "name";
        }
        $dbOrder =  mysql_real_escape_string($order);

        $dbres = mysql_query("SELECT * FROM khoa ORDER BY $dbOrder ASC");
        
        $data = array();
        while ( ($obj = mysql_fetch_object($dbres)) != NULL ) {
            $data[] = $obj;
        }
        
        return $data;
    }
    
    public function selectById($id) {
        $dbId = mysql_real_escape_string($id);
        
        $dbres = mysql_query("SELECT * FROM khoa WHERE id=$dbId");
        
        return mysql_fetch_object($dbres);
		
    }
    
    public function insert( $name ) {
        $dbName = ($name != NULL)?"'".mysql_real_escape_string($name)."'":'NULL';
        mysql_query("INSERT INTO khoa (name) VALUES ($dbName)");
        return mysql_insert_id();
    }

    public function update($id, $name ) {

        $dbName = ($name != NULL)?"'".mysql_real_escape_string($name)."'":'NULL';
        mysql_query("UPDATE khoa SET name = $dbName WHERE id = '$id'");
        return $id;
    }

    public function delete($id) {
        $dbId = mysql_real_escape_string($id);
        mysql_query("DELETE FROM khoa WHERE id=$dbId");
    }
    
}

?>
