<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/school/view/include/header.php');?>
<div class="container">
    <div class="jumbotron">
        <h1>Người dùng</h1>
    </div>
    <?php
        if (strpos($_SERVER['REQUEST_URI'], "error=exist") !== false) :
            $errors = array('user_exist'=>'User exist');
        endif;
    ?>
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
            <label for="name">Email</label>
            <input type="email" name="email" class="form-control" value="<?php if (isset($data)) echo $data->email; ?>"/>
        </div>
        <div class="form-group">
            <label for="name">Password</label>
            <input type="password" name="password" class="form-control" value="<?php if (isset($data)) echo $data->password; ?>"/>
        </div>
        <div class="form-group">
            <label for="name">Kiểu người dùng</label>
            <select name="userTypeId" class="form-control">
                <option value=""></option>
                <?php foreach ($userType as $typeId => $typeName):?>
                    <option value="<?php echo $typeId; ?>"><?php echo $typeName; ?></option>
                <?php endforeach;?>
            </select>
        </div>
        <div class="form-group">
            <label for="phone">Thông tin khác</label>
            <textarea name="other" class="form-control" rows="3"><?php if (isset($data)) echo $data->thong_tin_khac; ?></textarea>
        </div>
        <input type="hidden" name="form-submitted" value="1" />
        <input type="submit" value="Submit" class="btn btn-primary"/>
    </form>
</div>
<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/school/view/include/footer.php');?>
