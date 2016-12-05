<?php

class BoMonGateway {

    public function allRecord() {
        $dbres = mysql_query("SELECT * FROM bo_mon");
        return mysql_num_rows($dbres);
    }
    public function selectAll($order, $start, $limit) {
        if ( !isset($order) ) {
            $order = "ten_mon";
        }
        $dbOrder =  mysql_real_escape_string($order);
        $dbres = mysql_query("SELECT * FROM bo_mon ORDER BY $dbOrder ASC limit {$start},{$limit}");
        $data = array();
        while ( ($obj = mysql_fetch_object($dbres)) != NULL ) {
            $data[] = $obj;
        }
        
        return $data;
    }
    
    public function selectById($id) {
        $dbId = mysql_real_escape_string($id);
        $dbres = mysql_query("SELECT * FROM bo_mon WHERE id=$dbId");
        return mysql_fetch_object($dbres);
    }
    
    public function insert( $ten, $khoaId, $note ) {
        $ten = ($ten != NULL)?"'".mysql_real_escape_string($ten)."'":'NULL';
        $khoaId = ($khoaId != NULL)?"'".mysql_real_escape_string($khoaId)."'":'NULL';
        $note = ($note != NULL)?"'".mysql_real_escape_string($note)."'":'NULL';
        mysql_query("INSERT INTO bo_mon ( ten_mon, khoa_id, mota ) VALUES ( $ten, $khoaId, $note )");
        return mysql_insert_id();
    }

    public function update($id, $ten, $khoaId, $note) {
        $ten = ($ten != NULL)?"'".mysql_real_escape_string($ten)."'":'NULL';
        $khoaId = ($khoaId != NULL)?"'".mysql_real_escape_string($khoaId)."'":'NULL';
        $note = ($note != NULL)?"'".mysql_real_escape_string($note)."'":'NULL';
        mysql_query("UPDATE bo_mon SET ten_mon = $ten, khoa_id = $khoaId, mota = $note WHERE id = '$id'");
        return $id;
    }

    public function delete($id) {
        $dbId = mysql_real_escape_string($id);
        mysql_query("DELETE FROM bo_mon WHERE id=$dbId");
    }
    
}

?>
