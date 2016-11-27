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

    public function login($email, $password) {
        try
        {
            $dbEmail = ($email != NULL)?"'".mysql_real_escape_string($email)."'":'NULL';
            $dbPassword = ($password != NULL)?"'".mysql_real_escape_string($password)."'":'NULL';
            $dbres = mysql_query("SELECT * FROM nguoi_dung WHERE email=$dbEmail AND password=md5($dbPassword) AND status=1");

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

    public function selectByEmailUser($id) {
        var_dump("SELECT * FROM nguoi_dung WHERE id = $id");die;
        $dbres = mysql_query("SELECT * FROM nguoi_dung WHERE id = $id");
        return mysql_result($dbres);
    }

    public function insertGiangVien($colMaGV, $colName, $colKhoa, $colBoMon, $createId) {
        $colMaGV = ($colMaGV != NULL)?"'".mysql_real_escape_string($colMaGV)."'":'NULL';
        $colName = ($colName != NULL)?"'".mysql_real_escape_string($colName)."'":'NULL';
        $colKhoa = ($colKhoa != NULL)?"'".mysql_real_escape_string($colKhoa)."'":'NULL';
        $colBoMon = ($colBoMon != NULL)?"'".mysql_real_escape_string($colBoMon)."'":'NULL';
        $createId = ($createId != NULL)?"'".mysql_real_escape_string($createId)."'":'NULL';
        if (($this->selectByIdGiangVien($colMaGV)) != false) {
            return 'USER_EXIST';
        }
        mysql_query("INSERT INTO giang_vien (ma_giang_vien, ho_ten, khoa_id, bo_mon_id, user_id) VALUES ($colMaGV, $colName, $colKhoa, $colBoMon, $createId)");

        // save user_verified
        $keyVerified = md5(uniqid("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789", true));
        var_dump($this->selectByEmailUser(mysql_insert_id()));die;
        $data = array(
            "email" => selectByEmailUser(mysql_insert_id()),
            "active" => 0,
            "hash" => $keyVerified,
            "created_at" => date("Y-m-d H:i:s")
        );
        $this->saveVerifiedEmail($data);
        return mysql_insert_id();
    }
}

?>
