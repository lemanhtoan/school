<?php

class GVGateway {

    public function allRecord() {
        $dbres = mysql_query("SELECT * FROM giang_vien");
        return mysql_num_rows($dbres);
    }
    public function selectAll($order, $start, $limit) {
        if ( !isset($order) ) {
            $order = "ma_giang_vien";
        }
        $dbOrder =  mysql_real_escape_string($order);
        $dbres = mysql_query("SELECT * FROM giang_vien ORDER BY $dbOrder ASC limit {$start},{$limit}");
        $data = array();
        while ( ($obj = mysql_fetch_object($dbres)) != NULL ) {
            $data[] = $obj;
        }
        
        return $data;
    }
    
    public function selectById($id) {
        $dbId = mysql_real_escape_string($id);
        $dbres = mysql_query("SELECT * FROM giang_vien WHERE id=$dbId");
        return mysql_fetch_object($dbres);
    }
    
    public function insert( $ma_giang_vien, $ho_ten, $khoa_id, $bo_mon_id, $email ) {
        $ma_giang_vien = ($ma_giang_vien != NULL)?"'".mysql_real_escape_string($ma_giang_vien)."'":'NULL';
        $ho_ten = ($ho_ten != NULL)?"'".mysql_real_escape_string($ho_ten)."'":'NULL';
        $khoa_id = ($khoa_id != NULL)?"'".mysql_real_escape_string($khoa_id)."'":'NULL' ;
        $bo_mon_id = ($bo_mon_id != NULL)?"'".mysql_real_escape_string($bo_mon_id)."'":'NULL' ;
        $email = ($email != NULL)?"'".mysql_real_escape_string($email)."'":'NULL';
        mysql_query("INSERT INTO giang_vien (ma_giang_vien, ho_ten, khoa_id, bo_mon_id, email) VALUES ( $ma_giang_vien, $ho_ten, $khoa_id, $bo_mon_id, $email )");
        return mysql_insert_id();
    }

    public function update($id, $ma_giang_vien, $ho_ten, $khoa_id, $bo_mon_id, $email) {
        $ma_giang_vien = ($ma_giang_vien != NULL)?"'".mysql_real_escape_string($ma_giang_vien)."'":'NULL';
        $ho_ten = ($ho_ten != NULL)?"'".mysql_real_escape_string($ho_ten)."'":'NULL';
        $khoa_id = ($khoa_id != NULL)?"'".mysql_real_escape_string($khoa_id)."'":'NULL' ;
        $bo_mon_id = ($bo_mon_id != NULL)?"'".mysql_real_escape_string($bo_mon_id)."'":'NULL' ;
        $email = ($email != NULL)?"'".mysql_real_escape_string($email)."'":'NULL';
        mysql_query("UPDATE giang_vien SET ma_giang_vien = $ma_giang_vien, ho_ten = $ho_ten, khoa_id = $khoa_id, bo_mon_id = $bo_mon_id, email = $email  WHERE id = '$id'");
        return $id;
    }

    public function delete($id) {
        $dbId = mysql_real_escape_string($id);
        mysql_query("DELETE FROM giang_vien WHERE id=$dbId");
    }
    
}

?>
