<?php

class KhoaGateway {

    public function allRecord() {
        $dbres = mysql_query("SELECT * FROM khoa");
        return mysql_num_rows($dbres);
    }
    public function selectAll($order, $start, $limit) {
        if ( !isset($order) ) {
            $order = "ten_khoa";
        }
        $dbOrder =  mysql_real_escape_string($order);
        $dbres = mysql_query("SELECT * FROM khoa ORDER BY $dbOrder ASC limit {$start},{$limit}");
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
    
    public function insert( $name) {
        $dbName = ($name != NULL)?"'".mysql_real_escape_string($name)."'":'NULL';
        mysql_query("INSERT INTO khoa (ten_khoa) VALUES ($dbName)");
        return mysql_insert_id();
    }

    public function update($id, $name) {
        $dbName = ($name != NULL)?"'".mysql_real_escape_string($name)."'":'NULL';
        mysql_query("UPDATE khoa SET ten_khoa = $dbName WHERE id = '$id'");
        return $id;
    }

    public function delete($id) {
        $dbId = mysql_real_escape_string($id);
        mysql_query("DELETE FROM khoa WHERE id=$dbId");
    }
    
}

?>
