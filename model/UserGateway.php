<?php

class UserGateway {

    public function selectById($id) {
        $where = "";
        if (filter_var($id, FILTER_VALIDATE_EMAIL)) {
            $where.= 'email = "'.$id.'"';
        } else {
            $where.= 'id = "'.$id.'"';
        }
        $dbres = mysql_query("SELECT * FROM nguoi_dung WHERE $where");
        return mysql_fetch_object($dbres);
    }
    
    public function insert( $email, $password, $userTypeId, $other ) {
        $emailRes = $email;
        $email = ($email != NULL)?"'".mysql_real_escape_string($email)."'":'NULL';
        $password = ($password != NULL)?"'".mysql_real_escape_string($password)."'":'NULL';
        $userTypeId = ($userTypeId != NULL)?"'".mysql_real_escape_string($userTypeId)."'":'NULL';
        $other = ($other != NULL)?"'".mysql_real_escape_string($other)."'":'NULL';
        if (($this->selectById($emailRes)) != false) {
            return 'USER_EXIST';
        }
        mysql_query("INSERT INTO nguoi_dung (email, password, user_type, status, thong_tin_khac) VALUES ($email, md5($password), $userTypeId, '0', $other)");
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

    public function login($email, $password, $type) {
        try
        {
            $dbEmail = ($email != NULL)?"'".mysql_real_escape_string($email)."'":'NULL';
            $dbPassword = ($password != NULL)?"'".mysql_real_escape_string($password)."'":'NULL';
            if ($type == '1' || $type == '2') {
               $dbres = mysql_query("SELECT * FROM nguoi_dung WHERE email=$dbEmail AND password=md5($dbPassword) AND status=1"); 
            }
            if ($type == '3') {
                $dbres = mysql_query("SELECT *  FROM  `giang_vien`  LEFT JOIN nguoi_dung ON nguoi_dung.email = giang_vien.email WHERE giang_vien.ma_giang_vien = $dbEmail AND nguoi_dung.password=md5($dbPassword) AND nguoi_dung.status=1 AND nguoi_dung.user_type=3");
            } 
            if ($type == '4') {
                $dbres = mysql_query("SELECT *  FROM  `sinh_vien`  LEFT JOIN nguoi_dung ON nguoi_dung.email = sinh_vien.email WHERE sinh_vien.ma_sinh_vien = $dbEmail AND nguoi_dung.password=md5($dbPassword) AND nguoi_dung.status=1 AND nguoi_dung.user_type=4");
            }   

            if(mysql_num_rows($dbres) > 0)
            {
                $_SESSION['user_session'] = mysql_fetch_object($dbres);
                return true;
            }
            else
            {
                return false;
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function saveVerifiedEmail($data) {
        $email = $data['email'];
        $active = $data['active'];
        $hash = $data['hash'];
        $created_at = $data['created_at'];
        mysql_query("INSERT INTO user_verified (email, active, hash, created_at)  VALUES ('$email', '$active', '$hash', '$created_at')");
        return mysql_insert_id();
    }

    public function selectByIdGiangVien($id) {
        $dbres = mysql_query("SELECT * FROM giang_vien WHERE ma_giang_vien = $id");
        return mysql_fetch_object($dbres);
    }

    public function insertGiangVien($colMaGV, $colName, $colKhoa, $colBoMon, $email) {
        $colMaGV = ($colMaGV != NULL)?"'".mysql_real_escape_string($colMaGV)."'":'NULL';
        $colName = ($colName != NULL)?"'".mysql_real_escape_string($colName)."'":'NULL';
        $colKhoa = ($colKhoa != NULL)?"'".mysql_real_escape_string($colKhoa)."'":'NULL';
        $colBoMon = ($colBoMon != NULL)?"'".mysql_real_escape_string($colBoMon)."'":'NULL';
        $email = ($email != NULL)?"'".mysql_real_escape_string($email)."'":'NULL';
        if (($this->selectByIdGiangVien($colMaGV)) != false) {
            return 'USER_EXIST';
        }
        mysql_query("INSERT INTO giang_vien (ma_giang_vien, ho_ten, khoa_id, bo_mon_id, email) VALUES ($colMaGV, $colName, $colKhoa, $colBoMon, $email)");
        return mysql_insert_id();
    }

    public function changePassUser($password, $userId) {
        $dbPass = ($password != NULL)?"'".mysql_real_escape_string($password)."'":'NULL';
        mysql_query("UPDATE nguoi_dung SET password = md5($dbPass) WHERE id = '$userId'");
        return $userId;
    }

    public function selectByIdSinhVien($id) {
        $dbres = mysql_query("SELECT * FROM sinh_vien WHERE ma_sinh_vien = $id");
        return mysql_fetch_object($dbres);
    }

    public function insertSinhVien($colMaSV, $colName, $colKhoaHoc, $colCTHoc, $colEmail) {
        $colMaSV = ($colMaSV != NULL)?"'".mysql_real_escape_string($colMaSV)."'":'NULL';
        $colName = ($colName != NULL)?"'".mysql_real_escape_string($colName)."'":'NULL';
        $colKhoaHoc = ($colKhoaHoc != NULL)?"'".mysql_real_escape_string($colKhoaHoc)."'":'NULL';
        $colCTHoc = ($colCTHoc != NULL)?"'".mysql_real_escape_string($colCTHoc)."'":'NULL';
        $colEmail = ($colEmail != NULL)?"'".mysql_real_escape_string($colEmail)."'":'NULL';
        if (($this->selectByIdSinhVien($colEmail)) != false) {
            return 'USER_EXIST';
        }
        mysql_query("INSERT INTO sinh_vien (ma_sinh_vien, ho_ten, khoa_hoc_id, chuong_trinh_id, email) VALUES ($colMaSV, $colName, $colKhoaHoc, $colCTHoc, $colEmail)");
        return mysql_insert_id();
    }

    public function selectAllUser() {
        $dbres = mysql_query("SELECT * FROM nguoi_dung WHERE status=0 ORDER BY user_type ASC");
        $data = array();
        while ( ($obj = mysql_fetch_object($dbres)) != NULL ) {
            $data[] = $obj;
        }

        return $data;
    }

    public function activeUserStatus($id) {
        mysql_query("UPDATE nguoi_dung SET status = 1 WHERE id = '$id'");
        return $id;
    }
}

?>
