<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/school/view/include/header.php');?>
<div class="container">
    <div class="jumbotron">
        <h1>Chương Trình Học</h1>
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
            <label for="name">Tên Chương Trình</label>
            <input type="text" name="name" class="form-control" value="<?php if (isset($data)) echo $data->ten_chuong_trinh; ?>"/>
        </div>

        <div class="form-group">
            <label for="name">Khóa Học</label>
            <select name="khoa" id="" class="form-control">
                <option value=""></option>
                <?php foreach ($khoaHocList as $khoa) :?>
                    <option <?php if (isset($data)) { if ($data->khoa_hoc_id == $khoa->id) {echo 'selected';} } ?> value="<?php echo $khoa->id; ?>"><?php echo $khoa->ten_khoa_hoc; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="name">Thời Gian Học (Năm)</label>
            <input type="number" min="0" max = "6" class="form-control" name="timetotal" value="<?php if (isset($data)) echo $data->total_time; ?>">
        </div>

        <div class="form-group">
            <label for="phone">Ghi Chú</label><br/>
            <textarea name="note" class="form-control" rows="3"><?php if (isset($data)) echo $data->ghi_chu; ?></textarea>
        </div>

        <input type="hidden" name="form-submitted" value="1" />
        <input type="submit" value="Submit" class="btn btn-primary"/>
    </form>
</div>
<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/school/view/include/footer.php');?>
