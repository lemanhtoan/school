<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/school/view/include/header.php');?>
<div class="container">
<div class="jumbotron">
        <h1>Khóa học</h1>
    </div>
    <h1><?php print $data->ten_khoa_hoc; ?></h1>
</div>
<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/school/view/include/footer.php');?>
