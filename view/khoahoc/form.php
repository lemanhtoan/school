<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/school/view/include/header.php');?>
<div class="container">
    <div class="jumbotron">
        <h1>Khóa học</h1>
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
            <label for="name">Mã Khóa học</label>
            <input type="text" name="makh" class="form-control" value="<?php if (isset($data)) echo $data->ma_khoa_hoc; ?>"/>
        </div>
        <div class="form-group">
            <label for="name">Tên Khóa học</label>
            <input type="text" name="tenkh" class="form-control" value="<?php if (isset($data)) echo $data->ten_khoa_hoc; ?>"/>
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
            <label for="name">Thời gian bắt đầu</label>
            <div class="input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                <input type="text" class="form-control" name="time_begin" value="<?php if (isset($data)) echo $data->time_start; ?>">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-th"></span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="name">Thời gian kết thúc</label>
            <div class="input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                <input type="text" class="form-control" name="time_end" value="<?php if (isset($data)) echo $data->time_end; ?>">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-th"></span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="phone">Ghi chú</label><br/>
            <textarea name="note" class="form-control" rows="3"><?php if (isset($data)) echo $data->ghi_chu; ?></textarea>
        </div>

        <input type="hidden" name="form-submitted" value="1" />
        <input type="submit" value="Submit" class="btn btn-primary"/>
    </form>
</div>
<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/school/view/include/footer.php');?>
