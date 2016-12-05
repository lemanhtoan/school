<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/school/view/include/header.php');?>
<div class="container">
    <div class="jumbotron">
        <h1>Giảng Viên</h1>
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
            <label for="name">Mã Giảng Viên</label>
            <input type="text" name="magv" class="form-control" value="<?php if (isset($data)) echo $data->ma_giang_vien; ?>"/>
        </div>
        <div class="form-group">
            <label for="name">Tên Giảng Viên</label>
            <input type="text" name="tengv" class="form-control" value="<?php if (isset($data)) echo $data->ho_ten; ?>"/>
        </div>

        <div class="form-group">
            <label for="name">Email</label>
            <input type="email" name="email" class="form-control" value="<?php if (isset($data)) echo $data->email; ?>"/>
        </div>

        <div class="form-group">
            <label for="name">Khoa</label>
            <select name="khoa" id="" class="form-control">
                <option value=""></option>
                <?php foreach ($khoaList as $khoa) :?>
                    <option <?php if (isset($data)) { if ($data->khoa_id == $khoa->id) {echo 'selected';} } ?> value="<?php echo $khoa->id; ?>"><?php echo $khoa->ten_khoa; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="name">Bộ Môn</label>
            <select name="bomon" id="" class="form-control">
                <option value=""></option>
                <?php foreach ($BMList as $bm) :?>
                    <option <?php if (isset($data)) { if ($data->bo_mon_id == $bm->id) {echo 'selected';} } ?> value="<?php echo $bm->id; ?>"><?php echo $bm->ten_mon; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <input type="hidden" name="form-submitted" value="1" />
        <input type="submit" value="Submit" class="btn btn-primary"/>
    </form>
</div>
<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/school/view/include/footer.php');?>
