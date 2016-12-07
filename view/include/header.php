<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>School</title>
    <link rel="stylesheet" href="libs/css/bootstrap.min.css">
    <link rel="stylesheet" href="libs/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="libs/js/bootstrap.min.js"></script>
    <script src="libs/js/bootstrap-datepicker.js"></script>
    <script src="libs/js/script.js"></script>
</head>
<body>
<nav class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php">Quản Lý Trường Học</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="dropdown <?php if (strpos($_SERVER['REQUEST_URI'], "user_") !== false) { echo 'active';}?>">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">User
                    <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <?php if (isset($_SESSION['user_session'])) { ?>
                    <li><a href="index.php?op=user_info">Profile</a></li>
                    <li><a href="index.php?op=user_logout">Logout</a></li>
                    <li><a href="index.php?op=user_changepassword">Đổi mật khẩu</a></li>
                    <?php } else { ?>
                    <li><a href="index.php?op=user_login">Login</a></li>
                    <li><a href="index.php?op=user_register">Register</a></li>
                    <?php } ?>
                </ul>
            </li>
            <li>
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Quản lý
                    <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="index.php?op=khoahoc_list">Khóa học</a></li>
                    <li  <?php if (strpos($_SERVER['REQUEST_URI'], "khoa_list") !== false) { echo "class = 'active'";}?>><a href="index.php?op=khoa_list">Quản Lý Khoa</a></li>
                    <li><a href="index.php?op=chuongtrinh_list">Chương trình học</a></li>
                    <li><a href="index.php?op=bomon_list">Bộ Môn</a></li>
                    <li><a href="index.php?op=gv_list">Giáo Viên</a></li>
                    <li><a href="index.php?op=sv_list">Sinh Viên</a></li>
                </ul>
            </li>
            <li>
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Import/ Export
                    <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="index.php?op=import_gv">Import GV</a></li>
                    <li><a href="index.php?op=import_sv">Import SV</a></li>
                    <li><a  href="index.php?op=export_dt">Export Đề tài</a></li>
                </ul>
            </li>
            <li><a href="index.php?op=detai_list">Đề tài</a></li>
        </ul>
    </div>
</nav>
<div class="page-wrap">
