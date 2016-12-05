<?php
require_once 'model/KhoaService.php';
require_once 'model/UserService.php';
require_once 'model/Pagination.php';
require_once 'model/KhoaHocService.php';
require_once 'model/ChuongTrinhService.php';
require_once 'model/GVService.php';
require_once 'model/SVService.php';
require_once 'model/BoMonService.php';

class IndexController {
    private $indexService = NULL;
    private $khoaService = NULL;
    private $userService = NULL;
    private $khoahocService = NULL;
    private $chuongtrinhService = NULL;
    private $GVService = NULL;
    private $SVService = NULL;
    private $boMonService = NULL;

    public function __construct() {
        $this->indexService = new IndexService();
        $this->khoaService = new KhoaService();
        $this->userService = new UserService();
        $this->khoahocService = new KhoaHocService();
        $this->chuongtrinhService = new ChuongTrinhService();
        $this->GVService = new GVService();
        $this->SVService = new SVService();
        $this->boMonService = new BoMonService();
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
            } elseif ($op == 'chuongtrinh_list') {
                $this->listChuongTrinh();
            } elseif ($op == 'chuongtrinh_new') {
                $this->saveChuongTrinh();
            } elseif ($op == 'chuongtrinh_show') {
                $this->showChuongTrinh();
            } elseif ($op == 'chuongtrinh_edit') {
                $this->editChuongTrinh();
            } elseif ($op == 'chuongtrinh_delete') {
                $this->deleteChuongTrinh();
            } elseif (strpos($op, "chuongtrinh_list") !== false) { // pagination
                $this->listChuongTrinh();
            } elseif ($op == 'gv_list') {
                $this->listGV();
            } elseif ($op == 'gv_new') {
                $this->saveGV();
            } elseif ($op == 'gv_show') {
                $this->showGV();
            } elseif ($op == 'gv_edit') {
                $this->editGV();
            } elseif ($op == 'gv_delete') {
                $this->deleteGV();
            } elseif (strpos($op, "gv_list") !== false) { // pagination
                $this->listGV();
            } elseif ($op == 'sv_list') {
                $this->listSV();
            } elseif ($op == 'sv_new') {
                $this->saveSV();
            } elseif ($op == 'sv_show') {
                $this->showSV();
            } elseif ($op == 'sv_edit') {
                $this->editSV();
            } elseif ($op == 'sv_delete') {
                $this->deleteSV();
            } elseif (strpos($op, "sv_list") !== false) { // pagination
                $this->listSV();
            } elseif ($op == 'bomon_list') {
                $this->listBoMon();
            } elseif ($op == 'bomon_new') {
                $this->saveBoMon();
            } elseif ($op == 'bomon_show') {
                $this->showBoMon();
            } elseif ($op == 'bomon_edit') {
                $this->editBoMon();
            } elseif ($op == 'bomon_delete') {
                $this->deleteBoMon();
            } elseif (strpos($op, "bomon_list") !== false) { // pagination
                $this->listBoMon();
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
        $khoaList = $this->khoaService->getAll('id',0,300);
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

    /*BO MON ACTION ROUTER*/
    public function listBoMon() {
        $orderby = isset($_GET['orderby'])?$_GET['orderby']:NULL;
        $totalRecord = $this->boMonService->totalRecord();
        $Pagination = new Pagination();
        $limit = $Pagination->limit;
        $start = $Pagination->start();
        $totalPages = $Pagination->totalPages($totalRecord);
        $data = $this->boMonService->getAll($orderby, $start, $limit);
        $khoaList = $this->khoaService->getAll('id',0,300);
        include 'view/bomon/list.php';
    }

    public function saveBoMon() {
        $title = 'Add new';
        $name = '';
        $errors = array();
        if ( isset($_POST['form-submitted']) ) {
            $ten       = isset($_POST['tenmon']) ?   $_POST['tenmon']  :NULL;
            $khoaId       = isset($_POST['khoa']) ?   $_POST['khoa']  :NULL;
            $note       = isset($_POST['mota']) ?   $_POST['mota']  :NULL;
            try {
                $this->boMonService->create( $ten, $khoaId, $note );
                $this->redirect('index.php?op=bomon_list');
                return;
            } catch (ValidationException $e) {
                $errors = $e->getErrors();
            }
        }
        $khoaList = $this->khoaService->getAll('id',0,300);
        include 'view/bomon/form.php';
    }

    public function deleteBoMon() {
        $id = isset($_GET['id'])?$_GET['id']:NULL;
        if ( !$id ) {
            throw new Exception('Internal error.');
        }
        $this->boMonService->delete($id);

        $this->redirect('index.php?op=bomon_list');
    }

    public function showBoMon() {
        $id = isset($_GET['id'])?$_GET['id']:NULL;
        if ( !$id ) {
            throw new Exception('Internal error.');
        }
        $data = $this->boMonService->getId($id);
        include 'view/bomon/detail.php';
    }

    public function editBoMon() {
        $title = 'Edit';
        $errors = array();
        $id = isset($_GET['id'])?$_GET['id']:NULL;
        if ( !$id ) {
            throw new Exception('Internal error.');
        }
        $data = $this->boMonService->getId($id);
        $khoaList = $this->khoaService->getAll('id',0,300);
        if ( isset($_POST['form-submitted']) ) {
            $ten       = isset($_POST['tenmon']) ?   $_POST['tenmon']  :NULL;
            $khoaId       = isset($_POST['khoa']) ?   $_POST['khoa']  :NULL;
            $note       = isset($_POST['mota']) ?   $_POST['mota']  :NULL;
            try {
                $this->boMonService->update($id, $ten, $khoaId, $note);
                $this->redirect('index.php?op=bomon_list');
                return;
            } catch (ValidationException $e) {
                $errors = $e->getErrors();
            }
        }

        include 'view/bomon/form.php';
    }

    /*END BO MON ACTION ROUTER*/

    /*CHUONG TRINH ACTION ROUTER*/
    public function listChuongTrinh() {
        $orderby = isset($_GET['orderby'])?$_GET['orderby']:NULL;
        $totalRecord = $this->chuongtrinhService->totalRecord();
        $Pagination = new Pagination();
        $limit = $Pagination->limit;
        $start = $Pagination->start();
        $totalPages = $Pagination->totalPages($totalRecord);
        $data = $this->chuongtrinhService->getAll($orderby, $start, $limit);
        $khoaHocList = $this->khoahocService->getAll('id',0,300);
        include 'view/chuongtrinh/list.php';
    }

    public function saveChuongTrinh() {
        $title = 'Add new';
        $name = '';
        $errors = array();
        if ( isset($_POST['form-submitted']) ) {
            $ten       = isset($_POST['name']) ?   $_POST['name']  :NULL;
            $khoaHocId       = isset($_POST['khoa']) ?   $_POST['khoa']  :NULL;
            $note       = isset($_POST['note']) ?   $_POST['note']  :NULL;
            $time       = isset($_POST['timetotal']) ?   $_POST['timetotal']  :NULL;
            try {
                $this->chuongtrinhService->create( $ten, $khoaHocId, $note, $time );
                $this->redirect('index.php?op=chuongtrinh_list');
                return;
            } catch (ValidationException $e) {
                $errors = $e->getErrors();
            }
        }
        $khoaHocList = $this->khoahocService->getAll('id',0,300);
        include 'view/chuongtrinh/form.php';
    }

    public function deleteChuongTrinh() {
        $id = isset($_GET['id'])?$_GET['id']:NULL;
        if ( !$id ) {
            throw new Exception('Internal error.');
        }
        $this->chuongtrinhService->delete($id);

        $this->redirect('index.php?op=chuongtrinh_list');
    }

    public function showChuongTrinh() {
        $id = isset($_GET['id'])?$_GET['id']:NULL;
        if ( !$id ) {
            throw new Exception('Internal error.');
        }
        $data = $this->chuongtrinhService->getId($id);
        include 'view/chuongtrinh/detail.php';
    }

    public function editChuongTrinh() {
        $title = 'Edit';
        $errors = array();
        $id = isset($_GET['id'])?$_GET['id']:NULL;
        if ( !$id ) {
            throw new Exception('Internal error.');
        }
        $data = $this->chuongtrinhService->getId($id);
        $khoaHocList = $this->khoahocService->getAll('id',0,300);
        if ( isset($_POST['form-submitted']) ) {
            $ten       = isset($_POST['name']) ?   $_POST['name']  :NULL;
            $khoaHocId       = isset($_POST['khoa']) ?   $_POST['khoa']  :NULL;
            $note       = isset($_POST['note']) ?   $_POST['note']  :NULL;
            $time       = isset($_POST['timetotal']) ?   $_POST['timetotal']  :NULL;
            try {
                $this->chuongtrinhService->update($id, $ten, $khoaHocId, $note, $time );
                $this->redirect('index.php?op=chuongtrinh_list');
                return;
            } catch (ValidationException $e) {
                $errors = $e->getErrors();
            }
        }

        include 'view/chuongtrinh/form.php';
    }

    /*END CHUONG TRINH ACTION ROUTER*/

    /*GIAO VIEN ACTION ROUTER*/
    public function listGV() {
        $orderby = isset($_GET['orderby'])?$_GET['orderby']:NULL;
        $totalRecord = $this->GVService->totalRecord();
        $Pagination = new Pagination();
        $limit = $Pagination->limit;
        $start = $Pagination->start();
        $totalPages = $Pagination->totalPages($totalRecord);
        $data = $this->GVService->getAll($orderby, $start, $limit);
        $khoaList = $this->khoaService->getAll('id',0,300);
        $BMList = $this->boMonService->getAll('id',0,300);
        include 'view/giangvien/list.php';
    }

    public function saveGV() {
        $title = 'Add new';
        $name = '';
        $errors = array();
        if ( isset($_POST['form-submitted']) ) {
            $ten       = isset($_POST['tengv']) ?   $_POST['tengv']  :NULL;
            $khoaId       = isset($_POST['khoa']) ?   $_POST['khoa']  :NULL;
            $ma       = isset($_POST['magv']) ?   $_POST['magv']  :NULL;
            $bomon       = isset($_POST['bomon']) ?   $_POST['bomon']  :NULL;
            $email       = isset($_POST['email']) ?   $_POST['email']  :NULL;
            try {
                $this->GVService->create( $ma, $ten, $khoaId, $bomon , $email);
                $this->redirect('index.php?op=gv_list');
                return;
            } catch (ValidationException $e) {
                $errors = $e->getErrors();
            }
        }
        $khoaList = $this->khoaService->getAll('id',0,300);
        $BMList = $this->boMonService->getAll('id',0,300);
        include 'view/giangvien/form.php';
    }

    public function deleteGV() {
        $id = isset($_GET['id'])?$_GET['id']:NULL;
        if ( !$id ) {
            throw new Exception('Internal error.');
        }
        $this->GVService->delete($id);

        $this->redirect('index.php?op=gv_list');
    }

    public function showGV() {
        $id = isset($_GET['id'])?$_GET['id']:NULL;
        if ( !$id ) {
            throw new Exception('Internal error.');
        }
        $data = $this->GVService->getId($id);
        include 'view/giangvien/detail.php';
    }

    public function editGV() {
        $title = 'Edit';
        $errors = array();
        $id = isset($_GET['id'])?$_GET['id']:NULL;
        if ( !$id ) {
            throw new Exception('Internal error.');
        }
        $data = $this->GVService->getId($id);
        $khoaList = $this->khoaService->getAll('id',0,300);
        $BMList = $this->boMonService->getAll('id',0,300);
        if ( isset($_POST['form-submitted']) ) {
            $ten       = isset($_POST['tengv']) ?   $_POST['tengv']  :NULL;
            $khoaId       = isset($_POST['khoa']) ?   $_POST['khoa']  :NULL;
            $ma       = isset($_POST['magv']) ?   $_POST['magv']  :NULL;
            $bomon       = isset($_POST['bomon']) ?   $_POST['bomon']  :NULL;
            $email       = isset($_POST['email']) ?   $_POST['email']  :NULL;
            try {
                $this->GVService->update($id, $ma, $ten, $khoaId, $bomon , $email);
                $this->redirect('index.php?op=gv_list');
                return;
            } catch (ValidationException $e) {
                $errors = $e->getErrors();
            }
        }

        include 'view/giangvien/form.php';
    }

    /*END GIAO VIEN ACTION ROUTER*/

    /*SINH VIEN ACTION ROUTER*/
    public function listSV() {
        $orderby = isset($_GET['orderby'])?$_GET['orderby']:NULL;
        $totalRecord = $this->SVService->totalRecord();
        $Pagination = new Pagination();
        $limit = $Pagination->limit;
        $start = $Pagination->start();
        $totalPages = $Pagination->totalPages($totalRecord);
        $data = $this->SVService->getAll($orderby, $start, $limit);
        $KHList = $this->khoahocService->getAll('id',0,300);
        $CTList = $this->chuongtrinhService->getAll('id',0,300);
        include 'view/sinhvien/list.php';
    }

    public function saveSV() {
        $title = 'Add new';
        $name = '';
        $errors = array();
        if ( isset($_POST['form-submitted']) ) {
            $ma = isset($_POST['masv']) ?   $_POST['masv']  :NULL;
            $ten       = isset($_POST['tensv']) ?   $_POST['tensv']  :NULL;
            $email       = isset($_POST['email']) ?   $_POST['email']  :NULL;
            $khoahoc      = isset($_POST['khoahoc']) ?   $_POST['khoahoc']  :NULL;
            $chuongtrinhhoc      = isset($_POST['chuongtrinhhoc']) ?   $_POST['chuongtrinhhoc']  :NULL;
            try {
                $this->SVService->create( $ma, $ten, $email, $khoahoc, $chuongtrinhhoc );
                $this->redirect('index.php?op=sv_list');
                return;
            } catch (ValidationException $e) {
                $errors = $e->getErrors();
            }
        }
        $KHList = $this->khoahocService->getAll('id',0,300);
        $CTList = $this->chuongtrinhService->getAll('id',0,300);
        include 'view/sinhvien/form.php';
    }

    public function deleteSV() {
        $id = isset($_GET['id'])?$_GET['id']:NULL;
        if ( !$id ) {
            throw new Exception('Internal error.');
        }
        $this->SVService->delete($id);

        $this->redirect('index.php?op=sv_list');
    }

    public function showSV() {
        $id = isset($_GET['id'])?$_GET['id']:NULL;
        if ( !$id ) {
            throw new Exception('Internal error.');
        }
        $data = $this->SVService->getId($id);
        include 'view/sinhvien/detail.php';
    }

    public function editSV() {
        $title = 'Edit';
        $errors = array();
        $id = isset($_GET['id'])?$_GET['id']:NULL;
        if ( !$id ) {
            throw new Exception('Internal error.');
        }
        $data = $this->SVService->getId($id);
        $KHList = $this->khoahocService->getAll('id',0,300);
        $CTList = $this->chuongtrinhService->getAll('id',0,300);
        if ( isset($_POST['form-submitted']) ) {
            $ma = isset($_POST['masv']) ?   $_POST['masv']  :NULL;
            $ten       = isset($_POST['tensv']) ?   $_POST['tensv']  :NULL;
            $email       = isset($_POST['email']) ?   $_POST['email']  :NULL;
            $khoahoc      = isset($_POST['khoahoc']) ?   $_POST['khoahoc']  :NULL;
            $chuongtrinhhoc      = isset($_POST['chuongtrinhhoc']) ?   $_POST['chuongtrinhhoc']  :NULL;
            try {
                $this->SVService->update($id, $ma, $ten, $email, $khoahoc, $chuongtrinhhoc );
                $this->redirect('index.php?op=sv_list');
                return;
            } catch (ValidationException $e) {
                $errors = $e->getErrors();
            }
        }

        include 'view/sinhvien/form.php';
    }

    /*END SINH VIEN ACTION ROUTER*/
}
?>