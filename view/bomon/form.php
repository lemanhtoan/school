<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/school/view/include/header.php');?>
<div class="container">
    <div class="jumbotron">
        <h1>Bộ môn</h1>
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
            <label for="name">Tên Bộ Môn</label>
            <input type="text" name="tenmon" class="form-control" value="<?php if (isset($data)) echo $data->ten_mon; ?>"/>
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
            <label for="phone">Mô tả</label><br/>
            <textarea name="mota" class="form-control" rows="3"><?php if (isset($data)) echo $data->mota; ?></textarea>
        </div>

        <input type="hidden" name="form-submitted" value="1" />
        <input type="submit" value="Submit" class="btn btn-primary"/>
    </form>
</div>
<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/school/view/include/footer.php');?>
