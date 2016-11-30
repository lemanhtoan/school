<?php

class KhoaHocGateway {

    public function allRecord() {
        $dbres = mysql_query("SELECT * FROM khoa_hoc");
        return mysql_num_rows($dbres);
    }
    public function selectAll($order, $start, $limit) {
        if ( !isset($order) ) {
            $order = "ma_khoa_hoc";
        }
        $dbOrder =  mysql_real_escape_string($order);
        $dbres = mysql_query("SELECT * FROM khoa_hoc ORDER BY $dbOrder ASC limit {$start},{$limit}");
        $data = array();
        while ( ($obj = mysql_fetch_object($dbres)) != NULL ) {
            $data[] = $obj;
        }
        
        return $data;
    }
    
    public function selectById($id) {
        $dbId = mysql_real_escape_string($id);
        $dbres = mysql_query("SELECT * FROM khoa_hoc WHERE id=$dbId");
        return mysql_fetch_object($dbres);
    }
    
    public function insert( $ma, $ten, $khoaId, $note, $begin, $end ) {
        $ma = ($ma != NULL)?"'".mysql_real_escape_string($ma)."'":'NULL';
        $ten = ($ten != NULL)?"'".mysql_real_escape_string($ten)."'":'NULL';
        $khoaId = ($khoaId != NULL)?"'".mysql_real_escape_string($khoaId)."'":'NULL';
        $note = ($note != NULL)?"'".mysql_real_escape_string($note)."'":'NULL';
        $begin = ($begin != NULL)?"'".$begin."'":'NULL';
        $end = ($end != NULL)?"'".$end."'":'NULL';
        mysql_query("INSERT INTO khoa_hoc (ma_khoa_hoc, ten_khoa_hoc, khoa_id, ghi_chu, time_start, time_end) VALUES ( $ma, $ten, $khoaId, $note, $begin, $end )");
        return mysql_insert_id();
    }

    public function update($id, $ma, $ten, $khoaId, $note, $begin, $end) {
        $ma = ($ma != NULL)?"'".mysql_real_escape_string($ma)."'":'NULL';
        $ten = ($ten != NULL)?"'".mysql_real_escape_string($ten)."'":'NULL';
        $khoaId = ($khoaId != NULL)?"'".mysql_real_escape_string($khoaId)."'":'NULL';
        $note = ($note != NULL)?"'".mysql_real_escape_string($note)."'":'NULL';
        $begin = ($begin != NULL)?"'".$begin."'":'NULL';
        $end = ($end != NULL)?"'".$end."'":'NULL';
        mysql_query("UPDATE khoa_hoc SET ma_khoa_hoc = $ma, ten_khoa_hoc = $ten, khoa_id = $khoaId, ghi_chu = $note, time_start = $begin,  time_end = $end  WHERE id = '$id'");
        return $id;
    }

    public function delete($id) {
        $dbId = mysql_real_escape_string($id);
        mysql_query("DELETE FROM khoa_hoc WHERE id=$dbId");
    }
    
}

?>
