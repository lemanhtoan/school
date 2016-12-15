<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>School</title>
    <link rel="stylesheet" href="libs/css/bootstrap.min.css">
    <link rel="stylesheet" href="libs/css/style.css">
    <script src="libs/js/jquery.min.js"></script>
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
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Người dùng
                    <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <?php if (isset($_SESSION['user_session'])) { ?>
                    <li><a href="index.php?op=user_info">Thông tin</a></li>
                    <li><a href="index.php?op=user_logout">Thoát</a></li>
                    <li><a href="index.php?op=user_changepassword">Đổi mật khẩu</a></li>
                    <?php } else { ?>
                    <li><a href="index.php?op=user_login">Đăng nhập</a></li>
                    <li><a href="index.php?op=user_register">Đăng ký</a></li>
                    <?php } ?>
                </ul>
            </li>
            <?php if (isset($_SESSION['user_session'])) { ?>
            <li>
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Quản lý
                    <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><?php if (in_array('khoahoc_list', $role)): ?><a href="index.php?op=khoahoc_list">Khóa học</a><?php endif;?></li>
                    <li  <?php if (strpos($_SERVER['REQUEST_URI'], "khoa_list") !== false) { echo "class = 'active'";}?>><?php if (in_array('khoa_list', $role)): ?><a href="index.php?op=khoa_list">Quản Lý Khoa</a><?php endif;?></li>
                    <li><?php if (in_array('chuongtrinh_list', $role)): ?><a href="index.php?op=chuongtrinh_list">Chương trình học</a><?php endif;?></li>
                    <li><?php if (in_array('bomon_list', $role)): ?><a href="index.php?op=bomon_list">Bộ Môn</a><?php endif;?></li>
                    <li><?php if (in_array('gv_list', $role)): ?><a href="index.php?op=gv_list">Giáo Viên</a> <?php endif;?></li>
                    <li><?php if (in_array('sv_list', $role)): ?><a href="index.php?op=sv_list">Sinh Viên</a> <?php endif;?></li>
                </ul>
            </li>
            <?php if ( $_SESSION['user_session']->user_type != '4' ) { ?>
            <li>
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Nhập/ Xuất dữ liệu
                    <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="index.php?op=import_gv">Nhập Giảng Viên</a></li>
                    <li><a href="index.php?op=import_sv">Nhập Sinh Viên</a></li>
                    <li><a  href="index.php?op=export_dt">Xuất Đề Tài</a></li>
                </ul>
            </li>
            <?php } ?>
            <li><?php if (in_array('detai_list', $role)): ?><a href="index.php?op=detai_list">Đề tài</a><?php endif;?></li>
            <li><?php if (in_array('active_user', $role)): ?><a href="index.php?op=active_user">Kích hoạt người dùng</a><?php endif;?></li>
            <?php } ?>
        </ul>
    </div>
</nav>
<div class="page-wrap">
