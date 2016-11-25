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
            $phone      = isset($_POST['phone'])?   $_POST['phone'] :NULL;
            $email      = isset($_POST['email'])?   $_POST['email'] :NULL;
            $address    = isset($_POST['address'])? $_POST['address']:NULL;
            
            try {
                $this->contactsService->createNewContact($name, $phone, $email, $address);
                $this->redirect('index.php');
                return;
            } catch (ValidationException $e) {
                $errors = $e->getErrors();
            }
        }
        
        include 'view/contact-form.php';
    }
    
    public function deleteContact() {
        $id = isset($_GET['id'])?$_GET['id']:NULL;
        if ( !$id ) {
            throw new Exception('Internal error.');
        }
        
        $this->contactsService->deleteContact($id);
        
        $this->redirect('index.php');
    }
    
    public function showContact() {
        $id = isset($_GET['id'])?$_GET['id']:NULL;
        if ( !$id ) {
            throw new Exception('Internal error.');
        }
        $contact = $this->contactsService->getContact($id);
        
        include 'view/contact.php';
    }

    public function editContact() {
        $title = 'Edit contact';

        $name = '';
        $phone = '';
        $email = '';
        $address = '';

        $errors = array();

        $id = isset($_GET['id'])?$_GET['id']:NULL;
        if ( !$id ) {
            throw new Exception('Internal error.');
        }
        $contact = $this->contactsService->getContact($id);

        if ( isset($_POST['form-submitted']) ) {
            $name       = isset($_POST['name']) ?   $_POST['name']  :NULL;
            $phone      = isset($_POST['phone'])?   $_POST['phone'] :NULL;
            $email      = isset($_POST['email'])?   $_POST['email'] :NULL;
            $address    = isset($_POST['address'])? $_POST['address']:NULL;
            try {
                $this->contactsService->updateContact($id, $name, $phone, $email, $address);
                $this->redirect('index.php');
                return;
            } catch (ValidationException $e) {
                $errors = $e->getErrors();
            }
        }

        include 'view/contact-form.php';
    }
    
    public function showError($title, $message) {
        include 'view/error.php';
    }
    
}
?>
