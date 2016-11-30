<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/school/view/include/header.php');?>
<div class="container">
    <h1>User info</h1>
    <?php if (isset($_SESSION['user_session'])) : $data = $_SESSION['user_session']; ?>
        <?php
        switch ($data->user_type) {
            case 1:  $dataType = "Nhà trường"; break;
            case 2:  $dataType = "Khoa"; break;
            case 3:  $dataType = "Giảng viên"; break;
            case 4:  $dataType = "Sinh viên"; break;
        }
        ?>
        <h3>Email: <?php echo $data->email; ?></h3>
        <p>Kiểu người dùng: <?php echo $dataType; ?></p>
        <p>Thông tin khác: <?php echo $data->thong_tin_khac; ?></p>
<!--        <a href="index.php?op=user_edit" class="btn btn-info"> Edit </a>-->
    <?php endif; ?>
</div>
<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/school/view/include/footer.php');?>
