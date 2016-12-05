<?php

class ChuongTrinhGateway {

    public function allRecord() {
        $dbres = mysql_query("SELECT * FROM chuong_trinh_hoc");
        return mysql_num_rows($dbres);
    }
    public function selectAll($order, $start, $limit) {
        if ( !isset($order) ) {
            $order = "ten_chuong_trinh";
        }
        $dbOrder =  mysql_real_escape_string($order);
        $dbres = mysql_query("SELECT * FROM chuong_trinh_hoc ORDER BY $dbOrder ASC limit {$start},{$limit}");
        $data = array();
        while ( ($obj = mysql_fetch_object($dbres)) != NULL ) {
            $data[] = $obj;
        }
        
        return $data;
    }
    
    public function selectById($id) {
        $dbId = mysql_real_escape_string($id);
        $dbres = mysql_query("SELECT * FROM chuong_trinh_hoc   WHERE id=$dbId");
        return mysql_fetch_object($dbres);
    }
    
    public function insert( $ten, $khoaHocId, $note, $time ) {
        $ten = ($ten != NULL)?"'".mysql_real_escape_string($ten)."'":'NULL';
        $khoaHocId = ($khoaHocId != NULL)?"'".mysql_real_escape_string($khoaHocId)."'":'NULL';
        $note = ($note != NULL)?"'".mysql_real_escape_string($note)."'":'NULL';
        $time = ($time != NULL)?"'".$time."'":'NULL';
        mysql_query("INSERT INTO chuong_trinh_hoc (ten_chuong_trinh, khoa_hoc_id, ghi_chu, total_time) VALUES ( $ten, $khoaHocId, $note, $time )");
        return mysql_insert_id();
    }

    public function update($id, $ten, $khoaHocId, $note, $time) {
        $ten = ($ten != NULL)?"'".mysql_real_escape_string($ten)."'":'NULL';
        $khoaHocId = ($khoaHocId != NULL)?"'".mysql_real_escape_string($khoaHocId)."'":'NULL';
        $note = ($note != NULL)?"'".mysql_real_escape_string($note)."'":'NULL';
        $time = ($time != NULL)?"'".$time."'":'NULL';
        mysql_query("UPDATE chuong_trinh_hoc SET ten_chuong_trinh = $ten, khoa_hoc_id = $khoaHocId, ghi_chu = $note, total_time = $time  WHERE id = '$id'");
        return $id;
    }

    public function delete($id) {
        $dbId = mysql_real_escape_string($id);
        mysql_query("DELETE FROM chuong_trinh_hoc WHERE id=$dbId");
    }
    
}

?>
