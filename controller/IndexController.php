<?php
require_once 'model/KhoaService.php';
require_once 'model/UserService.php';
require_once 'model/Pagination.php';
require_once 'model/KhoaHocService.php';

class IndexController {
    private $indexService = NULL;
    private $khoaService = NULL;
    private $userService = NULL;
    private $khoahocService = NULL;

    public function __construct() {
        $this->indexService = new IndexService();
        $this->khoaService = new KhoaService();
        $this->userService = new UserService();
        $this->khoahocService = new KhoaHocService();
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
            } elseif ($op == 'import_gv') {
                $this->importUser();
            } elseif ($op == 'user_changepassword') {
                $this->changePassUser();
            } elseif ($op == 'user_edit') {
                $this->changeUser();
            } elseif ($op == 'import_sv') {
                $this->importSV();
            } elseif ($op == 'khoahoc_list') {
                $this->listKhoaHoc();
            } elseif ($op == 'khoahoc_new') {
                $this->saveKhoaHoc();
            } elseif ($op == 'khoahoc_show') {
                $this->showKhoaHoc();
            } elseif ($op == 'khoahoc_edit') {
                $this->editKhoaHoc();
            } elseif ($op == 'khoahoc_delete') {
                $this->deleteKhoaHoc();
            } elseif (strpos($op, "khoahoc_list") !== false) { // pagination
                $this->listKhoaHoc();
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
                if (count($_SESSION) > 0) {
                    $this->redirect('index.php?op=user_info');
                    return;
                } else {
                    $errors['login_fail'] = 'Wrong information';
                }
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
                                    $this->userService->create($colEmail, '123456', 3, '');
                                    // create giangvien
                                    $this->userService->createGiangVien($colMaGV, $colName, $colKhoa, $colBoMon, $colEmail);
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

    public function changePassUser()
    {
        $errors = array();
        if ( isset($_POST['form-submitted']) ) {
            $password       = isset($_POST['password']) ?   $_POST['password']  :NULL;
            $userId = $_SESSION['user_session']->id;
            try {
                $this->userService->changePassUser($password, $userId);
                $this->redirect('index.php?op=user_info');
                return;
            } catch (ValidationException $e) {
                $errors = $e->getErrors();
            }
        }
        include 'view/user/changepass.php';
    }

    public function importSV() {
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
                            if (($handle = fopen($_FILES['spreadsheet']['tmp_name'], "r")) !== FALSE) {
                                fgetcsv($handle);
                                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                                    $num = count($data);
                                    for ($c = 0; $c < $num; $c++) {
                                        $col[$c] = $data[$c];
                                    }
                                    $colName = $col[0];
                                    $colEmail = $col[1];
                                    $colMaSV = $col[2];
                                    $colKhoaHoc = $col[3];
                                    $colCTHoc = $col[4];
                                    // create user
                                    $this->userService->create($colEmail, '123456', 4, '');
                                    // create giangvien
                                    $this->userService->createSinhVien($colMaSV, $colName, $colKhoaHoc, $colCTHoc, $colEmail);
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

    /*KHOA HOC ACTION ROUTER*/
    public function listKhoaHoc() {
        $orderby = isset($_GET['orderby'])?$_GET['orderby']:NULL;
        $totalRecord = $this->khoahocService->totalRecord();
        $Pagination = new Pagination();
        $limit = $Pagination->limit;
        $start = $Pagination->start();
        $totalPages = $Pagination->totalPages($totalRecord);
        $data = $this->khoahocService->getAll($orderby, $start, $limit);
        include 'view/khoahoc/list.php';
    }

    public function saveKhoaHoc() {
        $title = 'Add new';
        $name = '';
        $errors = array();
        if ( isset($_POST['form-submitted']) ) {
            $ma       = isset($_POST['makh']) ?   $_POST['makh']  :NULL;
            $ten       = isset($_POST['tenkh']) ?   $_POST['tenkh']  :NULL;
            $khoaId       = isset($_POST['khoa']) ?   $_POST['khoa']  :NULL;
            $note       = isset($_POST['note']) ?   $_POST['note']  :NULL;
            $begin       = isset($_POST['time_begin']) ?   $_POST['time_begin']  :NULL;
            $end       = isset($_POST['time_end']) ?   $_POST['time_end']  :NULL;
            try {
                $this->khoahocService->create($ma, $ten, $khoaId, $note, $begin, $end );
                $this->redirect('index.php?op=khoahoc_list');
                return;
            } catch (ValidationException $e) {
                $errors = $e->getErrors();
            }
        }
        $khoaList = $this->khoaService->getAll('id',0,300);
        include 'view/khoahoc/form.php';
    }

    public function deleteKhoaHoc() {
        $id = isset($_GET['id'])?$_GET['id']:NULL;
        if ( !$id ) {
            throw new Exception('Internal error.');
        }
        $this->khoahocService->delete($id);

        $this->redirect('index.php?op=khoahoc_list');
    }

    public function showKhoaHoc() {
        $id = isset($_GET['id'])?$_GET['id']:NULL;
        if ( !$id ) {
            throw new Exception('Internal error.');
        }
        $data = $this->khoahocService->getId($id);
        include 'view/khoahoc/detail.php';
    }

    public function editKhoaHoc() {
        $title = 'Edit';
        $errors = array();
        $id = isset($_GET['id'])?$_GET['id']:NULL;
        if ( !$id ) {
            throw new Exception('Internal error.');
        }
        $data = $this->khoahocService->getId($id);
        $khoaList = $this->khoaService->getAll('id',0,300);
        if ( isset($_POST['form-submitted']) ) {
            $ma       = isset($_POST['makh']) ?   $_POST['makh']  :NULL;
            $ten       = isset($_POST['tenkh']) ?   $_POST['tenkh']  :NULL;
            $khoaId       = isset($_POST['khoa']) ?   $_POST['khoa']  :NULL;
            $note       = isset($_POST['note']) ?   $_POST['note']  :NULL;
            $begin       = isset($_POST['time_begin']) ?   $_POST['time_begin']  :NULL;
            $end       = isset($_POST['time_end']) ?   $_POST['time_end']  :NULL;
            try {
                $this->khoahocService->update($id, $ma, $ten, $khoaId, $note, $begin, $end );
                $this->redirect('index.php?op=khoahoc_list');
                return;
            } catch (ValidationException $e) {
                $errors = $e->getErrors();
            }
        }

        include 'view/khoahoc/form.php';
    }

    /*END KHOA HOC ACTION ROUTER*/
}
?>