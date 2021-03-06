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
	if ( isset($info) ) {
        print '<ul class="errors">';
        foreach ( $info as $field => $error ) {
            print '<li class="alert alert-info">'.htmlentities($error).'</li>';
        }
        print '</ul>';
    }
    ?>

    <form method="POST" action="" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">File</label>
            <input type="file" name="spreadsheet"/>
        </div>
        <input type="hidden" name="form-submitted" value="1" />
        <input type="submit" value="Submit" class="btn btn-primary"/>
    </form>
</div>
<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/school/view/include/footer.php');?>
