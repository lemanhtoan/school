<?php
require_once 'model/IndexService.php';
require_once 'model/BoMonGateway.php';
require_once 'model/ValidationException.php';


class BoMonService {
    private $index = NULL;
    private $bomonGateway    = NULL;

    public function __construct() {
        $this->index = new IndexService();
        $this->bomonGateway = new bomonGateway();
    }
    public function totalRecord()
    {
        try {
            $this->index->openDb();
            $res = $this->bomonGateway->allRecord();
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
            $res = $this->bomonGateway->selectAll($order, $start, $limit);
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
            $res = $this->bomonGateway->selectById($id);
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
    
    public function create( $ten, $khoaId, $note ) {
        try {
            $this->index->openDb();
            $this->validateParams($ten);
            $res = $this->bomonGateway->insert( $ten, $khoaId, $note );
            $this->index->closeDb();
            return $res;
        } catch (Exception $e) {
            $this->index->closeDb();
            throw $e;
        }
    }

    public function update($id, $ten, $khoaId, $note) {
        try {
            $this->index->openDb();
            $this->validateParams($ten);
            $res = $this->bomonGateway->update($id, $ten, $khoaId, $note);
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
            $res = $this->bomonGateway->delete($id);
            $this->index->closeDb();
        } catch (Exception $e) {
            $this->index->closeDb();
            throw $e;
        }
    }
    
    
}

?>
