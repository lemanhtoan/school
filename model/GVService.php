<?php
require_once 'model/IndexService.php';
require_once 'model/GVGateway.php';
require_once 'model/ValidationException.php';


class GVService {
    private $index = NULL;
    private $GVGateway    = NULL;

    public function __construct() {
        $this->index = new IndexService();
        $this->GVGateway = new GVGateway();
    }
    public function totalRecord()
    {
        try {
            $this->index->openDb();
            $res = $this->GVGateway->allRecord();
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
            $res = $this->GVGateway->selectAll($order, $start, $limit);
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
            $res = $this->GVGateway->selectById($id);
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
    
    public function create( $ma_giang_vien, $ho_ten, $khoa_id, $bo_mon_id, $email ) {
        try {
            $this->index->openDb();
            $this->validateParams($ma_giang_vien);
            $res = $this->GVGateway->insert( $ma_giang_vien, $ho_ten, $khoa_id, $bo_mon_id, $email );
            $this->index->closeDb();
            return $res;
        } catch (Exception $e) {
            $this->index->closeDb();
            throw $e;
        }
    }

    public function update($id, $ma_giang_vien, $ho_ten, $khoa_id, $bo_mon_id, $email) {
        try {
            $this->index->openDb();
            $this->validateParams($ma_giang_vien);
            $res = $this->GVGateway->update($id, $ma_giang_vien, $ho_ten, $khoa_id, $bo_mon_id, $email);
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
            $res = $this->GVGateway->delete($id);
            $this->index->closeDb();
        } catch (Exception $e) {
            $this->index->closeDb();
            throw $e;
        }
    }
    
    
}

?>
