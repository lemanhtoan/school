<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/school/view/include/header.php');?>

<div class="container">
<div class="jumbotron">
        <h1>Người dùng</h1>
    </div>
    <?php
    if ( isset($errors) ) {
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
    <?php if ( count($data) > 0 ) { ?>
    <form method="POST" action="">
        <table class="table table-striped">
            <thead>
            <tr>
                <th><input type="checkbox" onClick="toggle(this)" /></th>
                <th>Email người dùng</th>
                <th>Kiểu người dùng</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($data as $item): ?>
                <tr>
                    <td><input type="checkbox" class="cbx" name="check_list[]" value="<?php echo $item->id; ?>"></td>
                    <td><?php echo $item->email;?></td>
                    <td> <?php
                        switch ($item->user_type) {
                            case 1:  $dataType = "Nhà trường"; break;
                            case 2:  $dataType = "Khoa"; break;
                            case 3:  $dataType = "Giảng viên"; break;
                            case 4:  $dataType = "Sinh viên"; break;
                        }
                        echo $dataType;
                        ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <input type="hidden" name="form-submitted" value="1" />
        <input type="submit" value="Submit" class="btn btn-primary"/>
    </form>
    <?php } else { ?>
        <h5>Empty list.</h5>
    <?php } ?>
</div>
<?php if ( isset($info) ) { ?>
<script>
// refresh page after submit
setTimeout(function(){
     window.location = window.location.href;
}, 1000);
</script>
<?php } ?>
<script>
    function toggle(source) {
        checkboxes = document.getElementsByClassName('cbx');
        for(var i=0, n=checkboxes.length;i<n;i++) {
            checkboxes[i].checked = source.checked;
        }
    }
</script>
<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/school/view/include/footer.php');?>
