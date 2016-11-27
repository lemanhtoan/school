<?php
require_once 'model/IndexService.php';
require_once 'model/KhoaGateway.php';
require_once 'model/ValidationException.php';


class KhoaService {
    private $index = NULL;
    private $khoaGateway    = NULL;

    public function __construct() {
        $this->index = new IndexService();
        $this->khoaGateway = new KhoaGateway();
    }
    public function totalRecord()
    {
        try {
            $this->index->openDb();
            $res = $this->khoaGateway->allRecord();
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
            $res = $this->khoaGateway->selectAll($order, $start, $limit);
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
            $res = $this->khoaGateway->selectById($id);
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
    
    public function create( $name ) {
        try {
            $this->index->openDb();
            $this->validateParams($name);
            $res = $this->khoaGateway->insert($name);
            $this->index->closeDb();
            return $res;
        } catch (Exception $e) {
            $this->index->closeDb();
            throw $e;
        }
    }

    public function update($id, $name) {
        try {
            $this->index->openDb();
            $this->validateParams($name);
            $res = $this->khoaGateway->update($id, $name);
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
            $res = $this->khoaGateway->delete($id);
            $this->index->closeDb();
        } catch (Exception $e) {
            $this->index->closeDb();
            throw $e;
        }
    }
    
    
}

?>
