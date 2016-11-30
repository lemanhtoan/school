<?php
require_once 'model/IndexService.php';
require_once 'model/KhoaHocGateway.php';
require_once 'model/ValidationException.php';


class KhoaHocService {
    private $index = NULL;
    private $khoahocGateway    = NULL;

    public function __construct() {
        $this->index = new IndexService();
        $this->khoahocGateway = new KhoaHocGateway();
    }
    public function totalRecord()
    {
        try {
            $this->index->openDb();
            $res = $this->khoahocGateway->allRecord();
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
            $res = $this->khoahocGateway->selectAll($order, $start, $limit);
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
            $res = $this->khoahocGateway->selectById($id);
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
    
    public function create( $ma, $ten, $khoaId, $note, $begin, $end  ) {
        try {
            $this->index->openDb();
            $this->validateParams($ma);
            $res = $this->khoahocGateway->insert( $ma, $ten, $khoaId, $note, $begin, $end );
            $this->index->closeDb();
            return $res;
        } catch (Exception $e) {
            $this->index->closeDb();
            throw $e;
        }
    }

    public function update($id, $ma, $ten, $khoaId, $note, $begin, $end) {
        try {
            $this->index->openDb();
            $this->validateParams($ma);
            $res = $this->khoahocGateway->update($id, $ma, $ten, $khoaId, $note, $begin, $end);
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
            $res = $this->khoahocGateway->delete($id);
            $this->index->closeDb();
        } catch (Exception $e) {
            $this->index->closeDb();
            throw $e;
        }
    }
    
    
}

?>
