<?php
require_once 'model/KhoaService.php';
require_once 'model/UserService.php';
require_once 'model/Pagination.php';

class IndexController {
    private $indexService = NULL;
    private $khoaService = NULL;
    private $userService = NULL;

    public function __construct() {
        $this->indexService = new IndexService();
        $this->khoaService = new KhoaService();
        $this->userService = new UserService();
    }

    public function redirect($location, $error='') {
        header('Location: '.$location.$error);
    }

    public function handleRequest() {
        $op = isset($_GET['op'])?$_GET['op']:NULL;
        try {
            if ( !$op ) {
                $this->indexPage();
            } elseif ($op == 'khoa_list') {
                $this->listKhoa();
            } elseif ($op == 'khoa_new') {
                $this->saveKhoa();
            } elseif ($op == 'khoa_show') {
                $this->showKhoa();
            } elseif ($op == 'khoa_edit') {
                $this->editKhoa();
            } elseif ($op == 'khoa_delete') {
                $this->deleteKhoa();
            } elseif (strpos($op, "khoa_list") !== false) { // pagination
                $this->listKhoa();
            } elseif ($op == 'user_register') {
                $this->saveUser();
            } elseif ($op == 'user_login') {
                $this->loginUser();
            } elseif ($op == 'user_info') {
                $this->infoUser();
            } elseif ($op == 'user_logout') {
                $this->logoutUser();
            } elseif ($op == 'import_student') {
                $this->importUser();
            } else {
                $this->showError("Page not found", "Page for operation ".$op." was not found!");
            }
        } catch ( Exception $e ) {
            $this->showError("Application error", $e->getMessage());
        }
    }

    /*INDEX PAGE*/
    public function indexPage()
    {
        include 'view/home.php';
    }

    /*KHOA ACTION ROUTER*/
    public function listKhoa() {
        $orderby = isset($_GET['orderby'])?$_GET['orderby']:NULL;
        $totalRecord = $this->khoaService->totalRecord();
        $Pagination = new Pagination();
        $limit = $Pagination->limit;
        $start = $Pagination->start();
        $totalPages = $Pagination->totalPages($totalRecord);
        $data = $this->khoaService->getAll($orderby, $start, $limit);
        include 'view/khoa/list.php';
    }

    public function saveKhoa() {
        $title = 'Add new';
        $name = '';
        $errors = array();
        if ( isset($_POST['form-submitted']) ) {
            $name       = isset($_POST['name']) ?   $_POST['name']  :NULL;
            try {
                $this->khoaService->create($name);
                $this->redirect('index.php?op=khoa_list');
                return;
            } catch (ValidationException $e) {
                $errors = $e->getErrors();
            }
        }
        include 'view/khoa/form.php';
    }

    public function deleteKhoa() {
        $id = isset($_GET['id'])?$_GET['id']:NULL;
        if ( !$id ) {
            throw new Exception('Internal error.');
        }
        $this->khoaService->delete($id);

        $this->redirect('index.php?op=khoa_list');
    }

    public function showKhoa() {
        $id = isset($_GET['id'])?$_GET['id']:NULL;
        if ( !$id ) {
            throw new Exception('Internal error.');
        }
        $data = $this->khoaService->getId($id);
        include 'view/khoa/detail.php';
    }

    public function editKhoa() {
        $title = 'Edit';
        $name = '';
        $errors = array();
        $id = isset($_GET['id'])?$_GET['id']:NULL;
        if ( !$id ) {
            throw new Exception('Internal error.');
        }
        $data = $this->khoaService->getId($id);
        if ( isset($_POST['form-submitted']) ) {
            $name       = isset($_POST['name']) ?   $_POST['name']  :NULL;
            try {
                $this->khoaService->update($id, $name);
                $this->redirect('index.php?op=khoa_list');
                return;
            } catch (ValidationException $e) {
                $errors = $e->getErrors();
            }
        }

        include 'view/khoa/form.php';
    }

    public function showError($title, $message) {
        include 'view/error.php';
    }
    /*END KHOA ACTION ROUTER*/
    /*USER*/
    public function saveUser()
    {
        $title = 'Register';
        $email = $password = $other = '';
        $errors = array();
        if ( isset($_POST['form-submitted']) ) {
            $email       = isset($_POST['email']) ?   $_POST['email']  :NULL;
            $password       = isset($_POST['password']) ?   $_POST['password']  :NULL;
            $userTypeId       = isset($_POST['userTypeId']) ?   $_POST['userTypeId']  : 4;
            $other       = isset($_POST['other']) ?   $_POST['other']  :NULL;
            try {
                $create = $this->userService->create($email, $password, $userTypeId, $other);
                if ($create == "USER_EXIST") {
                    $this->redirect('index.php', '?op=user_register&error=exist');
                    return false;
                }
                $this->redirect('index.php');
                return;
            } catch (ValidationException $e) {
                $errors = $e->getErrors();
            }
        }
        $userType = array(
            1 => 'Nhà trường',
            2 => 'Khoa',
            3 => 'Giảng viên',
            4 => 'Sinh viên',
        );
        include 'view/user/form.php';
    }

    public function loginUser() {
        $title = 'Login';
        $errors = array();
        if ( isset($_POST['form-submitted']) ) {
            $email       = isset($_POST['email']) ?   $_POST['email']  :NULL;
            $password       = isset($_POST['password']) ?   $_POST['password']  :NULL;
            try {
                $this->userService->login($email, $password);
                $this->redirect('index.php?op=user_info');
                return;
            } catch (ValidationException $e) {
                $errors = $e->getErrors();
            }
        }
        include 'view/user/login.php';
    }

    public function infoUser() {
        include 'view/user/detail.php';
    }

    public function logoutUser() {
        session_destroy();
        unset($_SESSION['user_session']);
        $this->redirect('index.php');
    }

    public function importUser() {
        $errors = array();
        if ( isset($_POST['form-submitted']) ) {
            if(isset($_FILES['spreadsheet'])){
                if($_FILES['spreadsheet']['tmp_name']){
                    if(!$_FILES['spreadsheet']['error'])
                    {
                        $inputFile = $_FILES['spreadsheet']['name'];
                        $extension = strtoupper(pathinfo($inputFile, PATHINFO_EXTENSION));
                        if($extension == 'CSV'){
                            $file = fopen($_FILES['spreadsheet']['tmp_name'], "r");
//                            while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
//
//                                echo "<pre>";var_dump($data);
//                            }
                            if (($handle = fopen($_FILES['spreadsheet']['tmp_name'], "r")) !== FALSE) {
                                fgetcsv($handle);
                                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                                    $num = count($data);
                                    for ($c = 0; $c < $num; $c++) {
                                        $col[$c] = $data[$c];
                                    }
                                    $colName = $col[0];
                                    $colEmail = $col[1];
                                    $colMaGV = $col[2];
                                    $colKhoa = $col[3];
                                    $colBoMon = $col[4];
                                    // create user
                                    $createId = $this->userService->create($colEmail, '123456', 2, '');
                                    // create giangvien
                                    if ($createId) {
                                        $createIdGiangVien = $this->userService->createGiangVien($colMaGV, $colName, $colKhoa, $colBoMon, $createId);
                                    }
                                }
                            }
                            fclose($file);
                        }
                        else{
                            echo "Please upload an XLSX or ODS file";
                        }
                    }
                    else{
                        echo $_FILES['spreadsheet']['error'];
                    }
                }
            }
        }
        include 'view/user/import.php';
    }
}
?>