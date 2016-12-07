<?php
require_once 'model/IndexService.php';
require_once 'model/DTGateway.php';
require_once 'model/ValidationException.php';

class DTService {
    private $index = NULL;
    private $DTGateway    = NULL;

    public function __construct() {
        $this->index = new IndexService();
        $this->DTGateway = new DTGateway();
    }
    public function totalRecord()
    {
        try {
            $this->index->openDb();
            $res = $this->DTGateway->allRecord();
            $this->index->closeDb();
            return $res;
        } catch (Exception $e) {
            $this->index->closeDb();
            throw $e;
        }
    }

    public function getAll($order, $start, $limit) {
        try {
            $this->index->openDb();
            $res = $this->DTGateway->selectAll($order, $start, $limit);
            $this->index->closeDb();
            return $res;
        } catch (Exception $e) {
            $this->index->closeDb();
            throw $e;
        }
    }
    
    public function getId($id) {
        try {
            $this->index->openDb();
            $res = $this->DTGateway->selectById($id);
            $this->index->closeDb();
            return $res;
        } catch (Exception $e) {
            $this->index->closeDb();
            throw $e;
        }
    }
    
    private function validateParams( $name) {
        $errors = array();
        if ( !isset($name) || empty($name) ) {
            $errors[] = 'Name is required';
        }
        if ( empty($errors) ) {
            return;
        }
        throw new ValidationException($errors);
    }
    
    public function create( $ten, $mota, $khoahoc, $khoa, $sinhvien, $giangvien, $create, $update, $status ) {
        try {
            $this->index->openDb();
            $this->validateParams($ten);
            $res = $this->DTGateway->insert( $ten, $mota, $khoahoc, $khoa, $sinhvien, $giangvien, $create, $update, $status );
            $this->index->closeDb();
            return $res;
        } catch (Exception $e) {
            $this->index->closeDb();
            throw $e;
        }
    }

    public function update($id, $ten, $mota, $khoahoc, $khoa, $sinhvien, $giangvien, $update, $status) {
        try {
            $this->index->openDb();
            $this->validateParams($ten);
            $res = $this->DTGateway->update($id, $ten, $mota, $khoahoc, $khoa, $sinhvien, $giangvien, $update, $status);
            $this->index->closeDb();
            return $res;
        } catch (Exception $e) {
            $this->index->closeDb();
            throw $e;
        }
    }
    
    public function delete( $id ) {
        try {
            $this->index->openDb();
            $res = $this->DTGateway->delete($id);
            $this->index->closeDb();
        } catch (Exception $e) {
            $this->index->closeDb();
            throw $e;
        }
    }


    public function getAllCond($order, $start, $limit, $khoahocId) {
        try {
            $this->index->openDb();
            $res = $this->DTGateway->selectAllCond($order, $start, $limit, $khoahocId);
            $this->index->closeDb();
            return $res;
        } catch (Exception $e) {
            $this->index->closeDb();
            throw $e;
        }
    }

    public function getAllCondKhoa($order, $start, $limit, $khoahocId) {
        try {
            $this->index->openDb();
            $res = $this->DTGateway->selectAllCondKhoa($order, $start, $limit, $khoahocId);
            $this->index->closeDb();
            return $res;
        } catch (Exception $e) {
            $this->index->closeDb();
            throw $e;
        }
    }
    
}

?>
