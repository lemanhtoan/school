<?php

require_once 'model/khoa/KhoaService.php';

class KhoaController {
    
    private $khoaService = NULL;
    
    public function __construct() {
        $this->khoaService = new KhoaService();
    }
    
    public function redirect($location) {
        header('Location: '.$location);
    }
    
    public function handleRequest() {
        $op = isset($_GET['op'])?$_GET['op']:NULL;
        try {
            if ( !$op || $op == 'list' ) {
                var_dump($op) ;
                $this->listKhoa();
            } elseif ( $op == 'new' ) {
                $this->saveKhoa();
            } elseif ( $op == 'delete' ) {
                $this->deleteKhoa();
            } elseif ( $op == 'show' ) {
                $this->showKhoa();
            } elseif ( $op == 'edit' ) {
                $this->editKhoa();
            } else {
                $this->showError("Page not found", "Page for operation ".$op." was not found!");
            }
        } catch ( Exception $e ) {
            // some unknown Exception got through here, use application error page to display it
            $this->showError("Application error", $e->getMessage());
        }
    }
    
    public function listKhoa() {
        $orderby = isset($_GET['orderby'])?$_GET['orderby']:NULL;
        $data = $this->khoaService->getAllKhoa($orderby);
        include 'view/khoa/listkhoa.php';
    }
    
    public function savekhoa() {
       
        $title = 'Add new contact';
        
        $name = '';
        $phone = '';
        $email = '';
        $address = '';
       
        $errors = array();
        
        if ( isset($_POST['form-submitted']) ) {
            $name       = isset($_POST['name']) ?   $_POST['name']  :NULL;

            try {
                $this->khoaService->createNewKhoa($name);
                $this->redirect('index.php');
                return;
            } catch (ValidationException $e) {
                $errors = $e->getErrors();
            }
        }
        
        include 'view/khoa/khoa-form.php';
    }
    
    public function deleteKhoa() {
        $id = isset($_GET['id'])?$_GET['id']:NULL;
        if ( !$id ) {
            throw new Exception('Internal error.');
        }
        
        $this->khoaService->deleteKhoa($id);
        
        $this->redirect('index.php');
    }
    
    public function showKhoa() {
        $id = isset($_GET['id'])?$_GET['id']:NULL;
        if ( !$id ) {
            throw new Exception('Internal error.');
        }
        $data = $this->khoaService->getKhoa($id);

        include 'view/khoa/khoa.php';
    }

    public function editKhoa() {
        $title = 'Edit contact';

        $name = '';

        $errors = array();

        $id = isset($_GET['id'])?$_GET['id']:NULL;
        if ( !$id ) {
            throw new Exception('Internal error.');
        }
        $contact = $this->khoaService->getKhoa($id);

        if ( isset($_POST['form-submitted']) ) {
            $name       = isset($_POST['name']) ?   $_POST['name']  :NULL;

            try {
                $this->khoaService->updateKhoa($id, $name);
                $this->redirect('index.php');
                return;
            } catch (ValidationException $e) {
                $errors = $e->getErrors();
            }
        }

        include 'view/khoa/khoa-form.php';
    }
    
    public function showError($title, $message) {
        include 'view/error.php';
    }
    
}
?>
