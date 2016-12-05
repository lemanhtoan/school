<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/school/view/include/header.php');?>
<div class="container">
    <div class="jumbotron">
        <h1>Sinh    Viên</h1>
    </div>
    <?php
    if ( $errors ) {
        print '<ul class="errors">';
        foreach ( $errors as $field => $error ) {
            print '<li class="alert alert-danger">'.htmlentities($error).'</li>';
        }
        print '</ul>';
    }
    ?>
    <form method="POST" action="">
        <div class="form-group">
            <label for="name">Mã Sinh Viên</label>
            <input type="text" name="masv" class="form-control" value="<?php if (isset($data)) echo $data->ma_sinh_vien; ?>"/>
        </div>
        <div class="form-group">
            <label for="name">Tên Sinh Viên</label>
            <input type="text" name="tensv" class="form-control" value="<?php if (isset($data)) echo $data->ho_ten; ?>"/>
        </div>

        <div class="form-group">
            <label for="name">Email</label>
            <input type="email" name="email" class="form-control" value="<?php if (isset($data)) echo $data->email; ?>"/>
        </div>

        <div class="form-group">
            <label for="name">Khóa Học</label>
            <select name="khoahoc" id="" class="form-control">
                <option value=""></option>
                <?php foreach ($KHList as $kh) :?>
                    <option <?php if (isset($data)) { if ($data->khoa_hoc_id == $kh->id) {echo 'selected';} } ?> value="<?php echo $kh->id; ?>"><?php echo $kh->ten_khoa_hoc; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="name">Chương Trình Học</label>
            <select name="chuongtrinhhoc" id="" class="form-control">
                <option value=""></option>
                <?php foreach ($CTList as $ct) :?>
                    <option <?php if (isset($data)) { if ($data->chuong_trinh_id == $ct->id) {echo 'selected';} } ?> value="<?php echo $ct->id; ?>"><?php echo $ct->ten_chuong_trinh; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <input type="hidden" name="form-submitted" value="1" />
        <input type="submit" value="Submit" class="btn btn-primary"/>
    </form>
</div>
<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/school/view/include/footer.php');?>
