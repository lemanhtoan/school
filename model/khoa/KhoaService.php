<?php

require_once 'model/khoa/KhoaGateway.php';
require_once 'model/ValidationException.php';


class KhoaService {
    
    private $khoaGateway    = NULL;
    
    private function openDb() {
        $conn = mysql_connect("localhost", "root", "");
        if (!$conn) {
            throw new Exception("Connection to the database server failed!");
        }
        if (!mysql_select_db("school")) {
            throw new Exception("No mvc-crud database found on database server.");
        }
        mysql_set_charset('utf8',$conn);
    }
    
    private function closeDb() {
        mysql_close();
    }
  
    public function __construct() {
        $this->khoaGateway = new khoaGateway();
    }
    
    public function getAllKhoa($order) {
        try {
            $this->openDb();
            $res = $this->khoaGateway->selectAll($order);
            $this->closeDb();
            return $res;
        } catch (Exception $e) {
            $this->closeDb();
            throw $e;
        }
    }
    
    public function getKhoa($id) {
        try {
            $this->openDb();
            $res = $this->khoaGateway->selectById($id);
            $this->closeDb();
            return $res;
        } catch (Exception $e) {
            $this->closeDb();
            throw $e;
        }
        return $this->khoaGateway->find($id);
    }
    
    private function validateKhoaParams( $name ) {
        $errors = array();
        if ( !isset($name) || empty($name) ) {
            $errors[] = 'Name is required';
        }
        if ( empty($errors) ) {
            return;
        }
        throw new ValidationException($errors);
    }
    
    public function createNewKhoa( $name ) {
        try {
            $this->openDb();
            $this->validateKhoaParams($name);
            $res = $this->khoaGateway->insert($name);
            $this->closeDb();
            return $res;
        } catch (Exception $e) {
            $this->closeDb();
            throw $e;
        }
    }

    public function updateKhoa($id, $name) {
        try {
            $this->openDb();
            $this->validateKhoaParams($name);
            $res = $this->khoaGateway->update($id, $name);
            $this->closeDb();
            return $res;
        } catch (Exception $e) {
            $this->closeDb();
            throw $e;
        }
    }
    
    public function deleteKhoa( $id ) {
        try {
            $this->openDb();
            $res = $this->khoaGateway->delete($id);
            $this->closeDb();
        } catch (Exception $e) {
            $this->closeDb();
            throw $e;
        }
    }
    
    
}

?>
