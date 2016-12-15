<?php
// Turn off all error reporting
error_reporting(0);

require_once 'model/KhoaService.php';
require_once 'model/UserService.php';
require_once 'model/Pagination.php';
require_once 'model/KhoaHocService.php';
require_once 'model/ChuongTrinhService.php';
require_once 'model/GVService.php';
require_once 'model/SVService.php';
require_once 'model/BoMonService.php';
require_once 'model/DTService.php';

class IndexController {
    private $indexService = NULL;
    private $khoaService = NULL;
    private $userService = NULL;
    private $khoahocService = NULL;
    private $chuongtrinhService = NULL;
    private $GVService = NULL;
    private $SVService = NULL;
    private $boMonService = NULL;
    private $DTService = NULL;

    public function __construct() {
        $this->indexService = new IndexService();
        $this->khoaService = new KhoaService();
        $this->userService = new UserService();
        $this->khoahocService = new KhoaHocService();
        $this->chuongtrinhService = new ChuongTrinhService();
        $this->GVService = new GVService();
        $this->SVService = new SVService();
        $this->boMonService = new BoMonService();
        $this->DTService = new DTService();
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
            } elseif ($op == 'detai_list') {
                $this->listDeTai();
            } elseif ($op == 'detai_new') {
                $this->saveDeTai();
            } elseif ($op == 'detai_show') {
                $this->showDeTai();
            } elseif ($op == 'detai_edit') {
                $this->editDeTai();
            } elseif ($op == 'detai_delete') {
                $this->deleteDeTai();
            } elseif (strpos($op, "detai_list") !== false) { // pagination
                $this->listDeTai();
            } elseif (strpos($op, "khoahoc_detai") !== false) { // pagination
                $this->listDeTaiKH();
            } elseif (strpos($op, "khoa_detai") !== false) { // pagination
                $this->listDeTaiKhoa();
            }  elseif (strpos($op, "export_dt") !== false) { // pagination
                $this->exportDT();
            } elseif (strpos($op, "active_user") !== false) { // pagination
                $this->activeUser();
            } else {
                $this->showError("Page not found", "Page for operation ".$op." was not found!");
            }
        } catch ( Exception $e ) {
            $this->showError("Application error", $e->getMessage());
        }
    }

    public function returnRole($ss) {
        if (sizeof ((array) $ss) > 1) {
            $roleType = $ss->user_type;
            if ($roleType == '4') {
                //sv
                $arrData = array('sv_list', 'sv_show', 'sv_edit', 'sv_delete','detai_list','detai_new', 'sv_viewlist', 'sv_dtlist');
                return $arrData;
            } else {
                //khoa, giangvien, nhatruong
                $arrData = array('khoa_list','khoa_new','khoa_show','khoa_edit','khoa_delete','user_register','user_login','user_info','user_logout','import_gv','user_changepassword','user_edit','import_sv','khoahoc_list','khoahoc_new','khoahoc_show','khoahoc_edit','khoahoc_delete','chuongtrinh_list','chuongtrinh_new','chuongtrinh_show','chuongtrinh_edit','chuongtrinh_delete','gv_list','gv_new','gv_show','gv_edit','gv_delete','gv_list','sv_list','sv_new','sv_show','sv_edit','sv_delete','bomon_list','bomon_new','bomon_show','bomon_edit','bomon_delete','detai_list','detai_new','detai_show','detai_edit','detai_delete','khoahoc_detai','khoa_detai','export_dt','active_user');
                return $arrData;
            }
            return true;
        }
        return false;
    }

    public function ssInit() {
        if (!isset($_SESSION['user_session'])) {
            $ss = "";
        } else {
            $ss = $_SESSION['user_session'];
        } 
        $role = $this->returnRole($ss);
        return $role;
    }

    /*INDEX PAGE*/
    public function indexPage()
    {
        $role = $this->ssInit();
        include 'view/home.php';
    }

    /*KHOA ACTION ROUTER*/
    public function listKhoa() {
        $role = $this->ssInit();
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
        $role = $this->ssInit();
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
        $role = $this->ssInit();
        $id = isset($_GET['id'])?$_GET['id']:NULL;
        if ( !$id ) {
            throw new Exception('Internal error.');
        }
        $this->khoaService->delete($id);

        $this->redirect('index.php?op=khoa_list');
    }

    public function showKhoa() {
        $role = $this->ssInit();
        $id = isset($_GET['id'])?$_GET['id']:NULL;
        if ( !$id ) {
            throw new Exception('Internal error.');
        }
        $data = $this->khoaService->getId($id);
        include 'view/khoa/detail.php';
    }

    public function editKhoa() {
        $role = $this->ssInit();
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
        $role = $this->ssInit();
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
		if ($userTypeId == '3') {
			$ten       = isset($_POST['tengv']) ?   $_POST['tengv']  :NULL;
			$khoaId       = isset($_POST['khoa']) ?   $_POST['khoa']  :NULL;
			$ma       = isset($_POST['magv']) ?   $_POST['magv']  :NULL;
			$bomon       = isset($_POST['bomon']) ?   $_POST['bomon']  :NULL;
                	$this->GVService->create( $ma, $ten, $khoaId, $bomon , $email);
		}
		if ($userTypeId == '4') {
			$ma = isset($_POST['masv']) ?   $_POST['masv']  :NULL;
			$ten       = isset($_POST['tensv']) ?   $_POST['tensv']  :NULL;
			$khoahoc      = isset($_POST['khoahoc']) ?   $_POST['khoahoc']  :NULL;
			$chuongtrinhhoc      = isset($_POST['chuongtrinhhoc']) ?   $_POST['chuongtrinhhoc']  :NULL;
			$this->SVService->create( $ma, $ten, $email, $khoahoc, $chuongtrinhhoc );
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
	
	// get data to form 
	$KHList = $this->khoahocService->getAll('id',0,300);
        $CTList = $this->chuongtrinhService->getAll('id',0,300);
	$khoaList = $this->khoaService->getAll('id',0,300);
        $BMList = $this->boMonService->getAll('id',0,300);
        include 'view/user/form.php';
    }

    public function loginUser() {
        $role = $this->ssInit();
        $title = 'Login';
        $errors = array();
        if ( isset($_POST['form-submitted']) ) {
            $password       = isset($_POST['password']) ?   $_POST['password']  :NULL;
            $type       = isset($_POST['userTypeId']) ?   $_POST['userTypeId']  :NULL;
            // echo "<pre>"; var_dump($_POST);die;
            if ($type == '1' || $type == '2') {
                $email       = isset($_POST['username']) ?   $_POST['username']  :NULL;
            }
            if ($type == '3') {
                $email       = isset($_POST['usernameGv']) ?   $_POST['usernameGv']  :NULL;
            }
            if ($type == '4') {
                $email       = isset($_POST['usernameSv']) ?   $_POST['usernameSv']  :NULL;
            }
            try {
                $this->userService->login($email, $password, $type);
                if (count($_SESSION) > 0) {
                    $this->redirect('index.php?op=user_info');
                    return;
                } else {
                    $errors['login_fail'] = 'Sai thông tin đăng nhập';
                }
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
        include 'view/user/login.php';
    }

    public function infoUser() {
        $role = $this->ssInit();
        include 'view/user/detail.php';
    }

    public function logoutUser() {
        $role = $this->ssInit();
        session_destroy();
        unset($_SESSION['user_session']);
        $this->redirect('index.php');
    }

    public function importUser() {
        $role = $this->ssInit();
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
				$info = array('message' => 'Nhập danh sách thành công');
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
        $role = $this->ssInit();
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
        $role = $this->ssInit();
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
				$info = array('message' => 'Nhập danh sách thành công');
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
        $role = $this->ssInit();
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
        $role = $this->ssInit();
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
        $role = $this->ssInit();
        $id = isset($_GET['id'])?$_GET['id']:NULL;
        if ( !$id ) {
            throw new Exception('Internal error.');
        }
        $this->khoahocService->delete($id);

        $this->redirect('index.php?op=khoahoc_list');
    }

    public function showKhoaHoc() {
        $role = $this->ssInit();
        $id = isset($_GET['id'])?$_GET['id']:NULL;
        if ( !$id ) {
            throw new Exception('Internal error.');
        }
        $data = $this->khoahocService->getId($id);
        include 'view/khoahoc/detail.php';
    }

    public function editKhoaHoc() {
        $role = $this->ssInit();
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
        $role = $this->ssInit();
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
        $role = $this->ssInit();
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
        $role = $this->ssInit();
        $id = isset($_GET['id'])?$_GET['id']:NULL;
        if ( !$id ) {
            throw new Exception('Internal error.');
        }
        $this->boMonService->delete($id);

        $this->redirect('index.php?op=bomon_list');
    }

    public function showBoMon() {
        $role = $this->ssInit();
        $id = isset($_GET['id'])?$_GET['id']:NULL;
        if ( !$id ) {
            throw new Exception('Internal error.');
        }
        $data = $this->boMonService->getId($id);
        include 'view/bomon/detail.php';
    }

    public function editBoMon() {
        $role = $this->ssInit();
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
        $role = $this->ssInit();
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
        $role = $this->ssInit();
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
        $role = $this->ssInit();
        $id = isset($_GET['id'])?$_GET['id']:NULL;
        if ( !$id ) {
            throw new Exception('Internal error.');
        }
        $this->chuongtrinhService->delete($id);

        $this->redirect('index.php?op=chuongtrinh_list');
    }

    public function showChuongTrinh() {
        $role = $this->ssInit();
        $id = isset($_GET['id'])?$_GET['id']:NULL;
        if ( !$id ) {
            throw new Exception('Internal error.');
        }
        $data = $this->chuongtrinhService->getId($id);
        include 'view/chuongtrinh/detail.php';
    }

    public function editChuongTrinh() {
        $role = $this->ssInit();
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
        $role = $this->ssInit();
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
        $role = $this->ssInit();
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

        		$password       = '123456';
        		$userTypeId       = 3;
        		$other       = isset($_POST['other']) ?   $_POST['other']  :NULL;
                $create = $this->userService->create($email, $password, $userTypeId, $other);

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
        $role = $this->ssInit();
        $id = isset($_GET['id'])?$_GET['id']:NULL;
        if ( !$id ) {
            throw new Exception('Internal error.');
        }
        $this->GVService->delete($id);

        $this->redirect('index.php?op=gv_list');
    }

    public function showGV() {
        $role = $this->ssInit();
        $id = isset($_GET['id'])?$_GET['id']:NULL;
        if ( !$id ) {
            throw new Exception('Internal error.');
        }
        $data = $this->GVService->getId($id);
        include 'view/giangvien/detail.php';
    }

    public function editGV() {
        $role = $this->ssInit();
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
        $role = $this->ssInit();
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
        $role = $this->ssInit();
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

        		$password       = '123456';
        		$userTypeId       = 4;
        		$other       = isset($_POST['other']) ?   $_POST['other']  :NULL;
                $create = $this->userService->create($email, $password, $userTypeId, $other);

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
        $role = $this->ssInit();
        $id = isset($_GET['id'])?$_GET['id']:NULL;
        if ( !$id ) {
            throw new Exception('Internal error.');
        }
        $this->SVService->delete($id);

        $this->redirect('index.php?op=sv_list');
    }

    public function showSV() {
        $role = $this->ssInit();
        $id = isset($_GET['id'])?$_GET['id']:NULL;
        if ( !$id ) {
            throw new Exception('Internal error.');
        }
        $data = $this->SVService->getId($id);
        include 'view/sinhvien/detail.php';
    }

    public function editSV() {
        $role = $this->ssInit();
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

    /*DE TAI ACTION ROUTER*/
    public function listDeTai() {
        $role = $this->ssInit();
        $orderby = isset($_GET['orderby'])?$_GET['orderby']:NULL;
        $totalRecord = $this->DTService->totalRecord();
        $Pagination = new Pagination();
        $limit = $Pagination->limit;
        $start = $Pagination->start();
        $totalPages = $Pagination->totalPages($totalRecord);
        $data = $this->DTService->getAll($orderby, $start, $limit);
        $KHList = $this->khoahocService->getAll('id',0,300);
        $khoaList = $this->khoaService->getAll('id',0,300);
        $SVList = $this->SVService->getAll('id',0,300);
        $GVList = $this->GVService->getAll('id',0,300);
        include 'view/detai/list.php';
    }

    public function saveDeTai() {
        $role = $this->ssInit();
        $title = 'Add new';
        $name = '';
        $errors = array();
        if ( isset($_POST['form-submitted']) ) {
            $ten = isset($_POST['ten']) ?   $_POST['ten']  :NULL;
            $mota = isset($_POST['mota']) ?   $_POST['mota']  :NULL;
            $khoahoc  = isset($_POST['khoahoc']) ?   $_POST['khoahoc']  :NULL;
            $khoa = isset($_POST['khoa']) ?   $_POST['khoa']  :NULL;
            $sinhvien = isset($_POST['sinhvien']) ?   $_POST['sinhvien']  :NULL;
            $giangvien = isset($_POST['giangvien']) ?   $_POST['giangvien']  :NULL;
            $create = date( 'Y-m-d H:i:s');
            $update = date( 'Y-m-d H:i:s');
            $status = 1; // 1: nop, 2: rut: 3: hoan thanh, 4: huy bo
            try {
                $this->DTService->create( $ten, $mota, $khoahoc, $khoa, $sinhvien, $giangvien, $create, $update, $status );
                $this->redirect('index.php?op=detai_list');
                return;
            } catch (ValidationException $e) {
                $errors = $e->getErrors();
            }
        }
        $KHList = $this->khoahocService->getAll('id',0,300);
        $khoaList = $this->khoaService->getAll('id',0,300);
        $SVList = $this->SVService->getAll('id',0,300);

        if (isset($_SESSION['user_session'])) {
            $userType = $_SESSION['user_session']->user_type;
            if ($userType == '4') {
                $sv = $this->SVService->getSV($_SESSION['user_session']->email);
            }
        }
        $GVList = $this->GVService->getAll('id',0,300);
        include 'view/detai/form.php';
    }

    public function deleteDeTai() {
        $role = $this->ssInit();
        $id = isset($_GET['id'])?$_GET['id']:NULL;
        if ( !$id ) {
            throw new Exception('Internal error.');
        }
        $this->DTService->delete($id);

        $this->redirect('index.php?op=detai_list');
    }

    public function showDeTai() {
        $role = $this->ssInit();
        $id = isset($_GET['id'])?$_GET['id']:NULL;
        if ( !$id ) {
            throw new Exception('Internal error.');
        }
        $data = $this->DTService->getId($id);
        include 'view/detai/detail.php';
    }

    public function editDeTai() {
        $role = $this->ssInit();
        $title = 'Edit';
        $errors = array();
        $id = isset($_GET['id'])?$_GET['id']:NULL;
        if ( !$id ) {
            throw new Exception('Internal error.');
        }
        $data = $this->DTService->getId($id);
        $KHList = $this->khoahocService->getAll('id',0,300);
        $khoaList = $this->khoaService->getAll('id',0,300);
        $SVList = $this->SVService->getAll('id',0,300);
        if (isset($_SESSION['user_session'])) {
            $userType = $_SESSION['user_session']->user_type;
            if ($userType == '4') {
                $sv = $this->SVService->getSV($_SESSION['user_session']->email);
            }
        }
        $GVList = $this->GVService->getAll('id',0,300);
        if ( isset($_POST['form-submitted']) ) {
            $ten = isset($_POST['ten']) ?   $_POST['ten']  :NULL;
            $mota = isset($_POST['mota']) ?   $_POST['mota']  :NULL;
            $khoahoc  = isset($_POST['khoahoc']) ?   $_POST['khoahoc']  :NULL;
            $khoa = isset($_POST['khoa']) ?   $_POST['khoa']  :NULL;
            $sinhvien = isset($_POST['sinhvien']) ?   $_POST['sinhvien']  :NULL;
            $giangvien = isset($_POST['giangvien']) ?   $_POST['giangvien']  :NULL;
            $update = date( 'Y-m-d H:i:s');
            $status = 1; // 1: dangky, 2: rut: 3: hoan thanh, 4: huy bo
            try {
                $this->DTService->update($id, $ten, $mota, $khoahoc, $khoa, $sinhvien, $giangvien, $update, $status );
                $this->redirect('index.php?op=detai_list');
                return;
            } catch (ValidationException $e) {
                $errors = $e->getErrors();
            }
        }

        include 'view/detai/form.php';
    }

    public function listDeTaiKH() {
        $role = $this->ssInit();
        $orderby = isset($_GET['orderby'])?$_GET['orderby']:NULL;
        $khoahocId = isset($_GET['id'])?$_GET['id']:NULL;
        $totalRecord = $this->DTService->totalRecord();
        $Pagination = new Pagination();
        $limit = $Pagination->limit;
        $start = $Pagination->start();
        $totalPages = $Pagination->totalPages($totalRecord);
        $data = $this->DTService->getAllCond($orderby, $start, $limit, $khoahocId);
        $KHList = $this->khoahocService->getAll('id',0,300);
        $khoaList = $this->khoaService->getAll('id',0,300);
        $SVList = $this->SVService->getAll('id',0,300);
        $GVList = $this->GVService->getAll('id',0,300);
        include 'view/detai/list.php';
    }

    public function listDeTaiKhoa() {
        $role = $this->ssInit();
        $orderby = isset($_GET['orderby'])?$_GET['orderby']:NULL;
        $khoaId = isset($_GET['id'])?$_GET['id']:NULL;
        $totalRecord = $this->DTService->totalRecord();
        $Pagination = new Pagination();
        $limit = $Pagination->limit;
        $start = $Pagination->start();
        $totalPages = $Pagination->totalPages($totalRecord);
        $data = $this->DTService->getAllCondKhoa($orderby, $start, $limit, $khoaId);
        $KHList = $this->khoahocService->getAll('id',0,300);
        $khoaList = $this->khoaService->getAll('id',0,300);
        $SVList = $this->SVService->getAll('id',0,300);
        $GVList = $this->GVService->getAll('id',0,300);
        include 'view/detai/list.php';
    }

    public function exportDT() {
        $role = $this->ssInit();
        $orderby = isset($_GET['orderby'])?$_GET['orderby']:NULL;
        $limit = 100000;
        $start = 0;
        $data = $this->DTService->getAll($orderby, $start, $limit);
        $KHList = $this->khoahocService->getAll('id',0,300);
        $khoaList = $this->khoaService->getAll('id',0,300);
        $SVList = $this->SVService->getAll('id',0,300);
        $GVList = $this->GVService->getAll('id',0,300);
        if ( isset($_POST['form-submitted']) ) {
            $detaiName = 'detai-'.date( 'Y-m-d H:i:s').'-'.md5(microtime().mt_rand()).'.docx';
            header("Content-Type:application/msword");
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("content-disposition: attachment;filename=$detaiName");
        }

        include 'view/detai/export.php';
    }

    /*END DE TAI ACTION ROUTER*/

    public function activeUser() {
        $role = $this->ssInit();
        $data = $this->userService->getAllUser();
        if ( isset($_POST['form-submitted']) ) {
            if (count($_POST) > 1) {
                foreach($_POST['check_list'] as $selected){
                    $this->userService->activeUserStatus($selected);
                }
                $info = array('message' => 'Kích hoạt thành công');
            }
            else {
                $errors = array('null' => 'Vui lòng chọn giá trị.');
            }
        }

        include 'view/user/active.php';
    }
}
?>
