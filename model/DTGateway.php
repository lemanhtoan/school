<?php

class DTGateway {

    public function allRecord() {
        $dbres = mysql_query("SELECT * FROM de_tai");
        return mysql_num_rows($dbres);
    }
    public function selectAll($order, $start, $limit) {
        if ( !isset($order) ) {
            $order = "ten_dt";
        }
        $dbOrder =  mysql_real_escape_string($order);
        $dbres = mysql_query("SELECT * FROM de_tai ORDER BY $dbOrder ASC limit {$start},{$limit}");
        $data = array();
        while ( ($obj = mysql_fetch_object($dbres)) != NULL ) {
            $data[] = $obj;
        }
        
        return $data;
    }
    
    public function selectById($id) {
        $dbId = mysql_real_escape_string($id);
        $dbres = mysql_query("SELECT * FROM de_tai WHERE id=$dbId");
        return mysql_fetch_object($dbres);
    }
    
    public function insert( $ten, $mota, $khoahoc, $khoa, $sinhvien, $giangvien, $create, $update, $status ) {
        $ten = ($ten != NULL)?"'".mysql_real_escape_string($ten)."'":'NULL';
        $mota = ($mota != NULL)?"'".mysql_real_escape_string($mota)."'":'NULL';
        $khoa = ($khoa != NULL)?"'".mysql_real_escape_string($khoa)."'":'NULL';
        $khoahoc = ($khoahoc != NULL)?"'".mysql_real_escape_string($khoahoc)."'":'NULL';
        $sinhvien = ($sinhvien != NULL)?"'".mysql_real_escape_string($sinhvien)."'":'NULL';
        $giangvien = ($giangvien != NULL)?"'".mysql_real_escape_string($giangvien)."'":'NULL';
        $create = ($create != NULL)?"'".mysql_real_escape_string($create)."'":'NULL';
        $update = ($update != NULL)?"'".mysql_real_escape_string($update)."'":'NULL';
        $status = ($status != NULL)?"'".mysql_real_escape_string($status)."'":'NULL';

        mysql_query("INSERT INTO de_tai (ten_dt, mota, khoahoc_id, khoa_id, sinhvien_id, giangvien_id, created_at, updated_at, status) VALUES ( $ten, $mota, $khoahoc, $khoa, $sinhvien, $giangvien, $create, $update, $status )");
        return mysql_insert_id();
    }

    public function update($id, $ten, $mota, $khoahoc, $khoa, $sinhvien, $giangvien, $update, $status) {
        $ten = ($ten != NULL)?"'".mysql_real_escape_string($ten)."'":'NULL';
        $mota = ($mota != NULL)?"'".mysql_real_escape_string($mota)."'":'NULL';
        $khoa = ($khoa != NULL)?"'".mysql_real_escape_string($khoa)."'":'NULL';
        $khoahoc = ($khoahoc != NULL)?"'".mysql_real_escape_string($khoahoc)."'":'NULL';
        $sinhvien = ($sinhvien != NULL)?"'".mysql_real_escape_string($sinhvien)."'":'NULL';
        $giangvien = ($giangvien != NULL)?"'".mysql_real_escape_string($giangvien)."'":'NULL';
        $update = ($update != NULL)?"'".mysql_real_escape_string($update)."'":'NULL';
        $status = ($status != NULL)?"'".mysql_real_escape_string($status)."'":'NULL';
        mysql_query("UPDATE de_tai SET ten_dt = $ten, mota = $mota, khoahoc_id = $khoahoc, khoa_id = $khoa, sinhvien_id = $sinhvien, giangvien_id = $giangvien, updated_at = $update, status = $status   WHERE id = '$id'");
        return $id;
    }

    public function delete($id) {
        $dbId = mysql_real_escape_string($id);
        mysql_query("DELETE FROM de_tai WHERE id=$dbId");
    }

    public function selectAllCond($order, $start, $limit, $khoahocId) {
        if ( !isset($order) ) {
            $order = "ten_dt";
        }
        $dbOrder =  mysql_real_escape_string($order);
        $dbres = mysql_query("SELECT * FROM de_tai WHERE khoahoc_id = $khoahocId ORDER BY $dbOrder ASC limit {$start},{$limit}");
        $data = array();
        while ( ($obj = mysql_fetch_object($dbres)) != NULL ) {
            $data[] = $obj;
        }

        return $data;
    }

    public function selectAllCondKhoa($order, $start, $limit, $khoahocId) {
        if ( !isset($order) ) {
            $order = "ten_dt";
        }
        $dbOrder =  mysql_real_escape_string($order);
        $dbres = mysql_query("SELECT * FROM de_tai WHERE khoa_id = $khoahocId ORDER BY $dbOrder ASC limit {$start},{$limit}");
        $data = array();
        while ( ($obj = mysql_fetch_object($dbres)) != NULL ) {
            $data[] = $obj;
        }

        return $data;
    }
    
}

?>
