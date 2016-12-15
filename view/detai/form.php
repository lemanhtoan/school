<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/school/view/include/header.php');?>
<div class="container">
    <div class="jumbotron">
        <h1>Đề tài</h1>
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
            <label for="name">Tên đề tài</label>
            <input type="text" name="ten" class="form-control" value="<?php if (isset($data)) echo $data->ten_dt; ?>"/>
        </div>

        <div class="form-group">
            <label for="name">Khóa Học</label>
            <select name="khoahoc" id="" class="form-control">
                <option value=""></option>
                <?php foreach ($KHList as $kh) :?>
                    <option <?php if (isset($data)) { if ($data->khoahoc_id == $kh->id) {echo 'selected';} } ?> value="<?php echo $kh->id; ?>"><?php echo $kh->ten_khoa_hoc; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="name">Khoa </label>
            <select name="khoa" id="" class="form-control">
                <option value=""></option>
                <?php foreach ($khoaList as $kh) :?>
                    <option <?php if (isset($data)) { if ($data->khoa_id == $kh->id) {echo 'selected';} } ?> value="<?php echo $kh->id; ?>"><?php echo $kh->ten_khoa; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="name">Tên Sinh Viên</label>
            <?php if (isset($sv)) {  ?>
            <select name="sinhvien" id="" class="form-control" disabled="true">
                <option  selected='selected' value="<?php echo $sv['id']; ?>"><?php echo $sv['ho_ten']; ?></option>
            </select>
            <?php } else { ?>
            <select name="sinhvien" id="" class="form-control">
                <option value=""></option>
                <?php  foreach ($SVList as $kh) :?>
                    <option <?php if (isset($data)) { if ($data->sinhvien_id == $kh->id) {echo 'selected';} } ?> value="<?php echo $kh->id; ?>"><?php echo $kh->ho_ten; ?></option>
                <?php endforeach; ?>
            </select>
            <?php } ?>
        </div>

        <div class="form-group">
            <label for="name">Tên Giảng Viên</label>
            <select name="giangvien" id="" class="form-control">
                <option value=""></option>
                <?php foreach ($GVList as $kh) :?>
                    <option <?php if (isset($data)) { if ($data->giangvien_id == $kh->id) {echo 'selected';} } ?> value="<?php echo $kh->id; ?>"><?php echo $kh->ho_ten; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="phone">Mô tả</label><br/>
            <textarea name="mota" class="form-control" rows="3"><?php if (isset($data)) echo $data->mota; ?></textarea>
        </div>

        <input type="hidden" name="form-submitted" value="1" />
        <input type="submit" value="Submit" class="btn btn-primary"/>
    </form>
</div>
<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/school/view/include/footer.php');?>
