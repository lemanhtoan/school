<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/school/view/include/header.php');?>
<div class="container">
    <div class="jumbotron">
        <h1>Khoa</h1>
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
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="<?php if (isset($data)) echo $data->ten_khoa; ?>"/>
        </div>
        <input type="hidden" name="form-submitted" value="1" />
        <input type="submit" value="Submit" class="btn btn-primary"/>
    </form>
</div>
<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/school/view/include/footer.php');?>
