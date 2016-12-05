<?php
require_once 'model/IndexService.php';
require_once 'model/SVGateway.php';
require_once 'model/ValidationException.php';


class SVService {
    private $index = NULL;
    private $SVGateway    = NULL;

    public function __construct() {
        $this->index = new IndexService();
        $this->SVGateway = new SVGateway();
    }
    public function totalRecord()
    {
        try {
            $this->index->openDb();
            $res = $this->SVGateway->allRecord();
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
            $res = $this->SVGateway->selectAll($order, $start, $limit);
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
            $res = $this->SVGateway->selectById($id);
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
    
    public function create( $ma, $ten, $email, $khoahoc, $chuongtrinhhoc ) {
        try {
            $this->index->openDb();
            $this->validateParams($ma);
            $res = $this->SVGateway->insert( $ma, $ten, $email, $khoahoc, $chuongtrinhhoc );
            $this->index->closeDb();
            return $res;
        } catch (Exception $e) {
            $this->index->closeDb();
            throw $e;
        }
    }

    public function update($id, $ma, $ten, $email, $khoahoc, $chuongtrinhhoc) {
        try {
            $this->index->openDb();
            $this->validateParams($ma);
            $res = $this->SVGateway->update($id, $ma, $ten, $email, $khoahoc, $chuongtrinhhoc);
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
            $res = $this->SVGateway->delete($id);
            $this->index->closeDb();
        } catch (Exception $e) {
            $this->index->closeDb();
            throw $e;
        }
    }
    
    
}

?>
