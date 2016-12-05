<?php
require_once 'model/IndexService.php';
require_once 'model/ChuongTrinhGateway.php';
require_once 'model/ValidationException.php';


class ChuongTrinhService {
    private $index = NULL;
    private $chuongtrinhGateway    = NULL;

    public function __construct() {
        $this->index = new IndexService();
        $this->chuongtrinhGateway = new ChuongTrinhGateway();
    }
    public function totalRecord()
    {
        try {
            $this->index->openDb();
            $res = $this->chuongtrinhGateway->allRecord();
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
            $res = $this->chuongtrinhGateway->selectAll($order, $start, $limit);
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
            $res = $this->chuongtrinhGateway->selectById($id);
            $this->index->closeDb();
            return $res;
        } catch (Exception $e) {
            $this->index->closeDb();
            throw $e;
        }
        return $this->contactsGateway->find($id);
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
    
    public function create( $ten, $khoaHocId, $note, $time ) {
        try {
            $this->index->openDb();
            $this->validateParams($ten);
            $res = $this->chuongtrinhGateway->insert( $ten, $khoaHocId, $note, $time );
            $this->index->closeDb();
            return $res;
        } catch (Exception $e) {
            $this->index->closeDb();
            throw $e;
        }
    }

    public function update($id, $ten, $khoaHocId, $note, $time) {
        try {
            $this->index->openDb();
            $this->validateParams($ten);
            $res = $this->chuongtrinhGateway->update($id, $ten, $khoaHocId, $note, $time);
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
            $res = $this->chuongtrinhGateway->delete($id);
            $this->index->closeDb();
        } catch (Exception $e) {
            $this->index->closeDb();
            throw $e;
        }
    }
    
    
}

?>
