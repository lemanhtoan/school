<?php

class SVGateway {

    public function allRecord() {
        $dbres = mysql_query("SELECT * FROM sinh_vien");
        return mysql_num_rows($dbres);
    }
    public function selectAll($order, $start, $limit) {
        if ( !isset($order) ) {
            $order = "ma_sinh_vien";
        }
        $dbOrder =  mysql_real_escape_string($order);
        $dbres = mysql_query("SELECT * FROM sinh_vien ORDER BY $dbOrder ASC limit {$start},{$limit}");
        $data = array();
        while ( ($obj = mysql_fetch_object($dbres)) != NULL ) {
            $data[] = $obj;
        }
        
        return $data;
    }
    
    public function selectById($id) {
        $dbId = mysql_real_escape_string($id);
        $dbres = mysql_query("SELECT * FROM sinh_vien WHERE id=$dbId");
        return mysql_fetch_object($dbres);
    }

    public function selectByEmail($email) {
        $email = ($email != NULL)?"'".mysql_real_escape_string($email)."'":'NULL';
        $dbres = mysql_query("SELECT * FROM sinh_vien WHERE email=$email");
        return mysql_fetch_array($dbres);
    }
    
    public function insert( $ma, $ten, $email, $khoahoc, $chuongtrinhhoc ) {
        $ma = ($ma != NULL)?"'".mysql_real_escape_string($ma)."'":'NULL';
        $ten = ($ten != NULL)?"'".mysql_real_escape_string($ten)."'":'NULL';
        $email = ($email != NULL)?"'".mysql_real_escape_string($email)."'":'NULL';
        $khoahoc = ($khoahoc != NULL)?"'".mysql_real_escape_string($khoahoc)."'":'NULL';
        $chuongtrinhhoc = ($chuongtrinhhoc != NULL)?"'".$chuongtrinhhoc."'":'NULL';
        mysql_query("INSERT INTO sinh_vien (ma_sinh_vien, ho_ten, email, khoa_hoc_id, chuong_trinh_id) VALUES ( $ma, $ten, $email, $khoahoc, $chuongtrinhhoc )");
        return mysql_insert_id();
    }

    public function update($id, $ma, $ten, $email, $khoahoc, $chuongtrinhhoc) {
        $ma = ($ma != NULL)?"'".mysql_real_escape_string($ma)."'":'NULL';
        $ten = ($ten != NULL)?"'".mysql_real_escape_string($ten)."'":'NULL';
        $email = ($email != NULL)?"'".mysql_real_escape_string($email)."'":'NULL';
        $khoahoc = ($khoahoc != NULL)?"'".mysql_real_escape_string($khoahoc)."'":'NULL';
        $chuongtrinhhoc = ($chuongtrinhhoc != NULL)?"'".$chuongtrinhhoc."'":'NULL';
        mysql_query("UPDATE sinh_vien SET ma_sinh_vien = $ma, ho_ten = $ten, khoa_hoc_id = $khoahoc, email = $email, chuong_trinh_id = $chuongtrinhhoc WHERE id = '$id'");
        return $id;
    }

    public function delete($id) {
        $dbId = mysql_real_escape_string($id);
        mysql_query("DELETE FROM sinh_vien WHERE id=$dbId");
    }
    
}

?>
