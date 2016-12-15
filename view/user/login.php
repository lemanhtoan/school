<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/school/view/include/header.php');?>
<div class="container">
    <div class="jumbotron">
        <h1>Người dùng</h1>
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
    <form method="POST" action="" novalidate>
        <div class="form-group">
            <label for="name">Kiểu người dùng</label>
            <select name="userTypeId" class="form-control userType">
                <option value=""></option>
                <?php foreach ($userType as $typeId => $typeName):?>
                    <option value="<?php echo $typeId; ?>"><?php echo $typeName; ?></option>
                <?php endforeach;?>
            </select>
        </div>
        <div id="sectionSv" style="display: none">
            <div class="form-group">
                <label for="name">Mã Sinh Viên</label>
                <input type="text" name="usernameSv" class="form-control""/>
            </div>
        </div>
        <div id="sectionGv" style="display: none">
            <div class="form-group">
                <label for="name">Mã Giảng Viên</label>
                <input type="text" name="usernameGv" class="form-control""/>
            </div>
        </div>
        <div id="sectionOther" style="display: none">
            <div class="form-group">
                <label for="name">Email</label>
                <input type="email" name="username" class="form-control"/>
            </div>
        </div>

        <div class="form-group">
            <label for="name">Password</label>
            <input type="password" name="password" class="form-control"/>
        </div>
        
        <input type="hidden" name="form-submitted" value="1" />
        <input type="submit" value="Submit" class="btn btn-primary"/>
    </form>
</div>
<script>
jQuery(document).ready(function($){
    $('.userType').change(function() {
        var select = $(".userType option:selected").val();
        if (select == '3') {//gv
            $('#sectionGv').show();
        } else { $('#sectionGv').hide(); }
        if (select == '4') {//sv
            $('#sectionSv').show();
        } else { $('#sectionSv').hide(); }
        if (select == '1' || select == '2') {//other
            $('#sectionOther').show();
        } else { $('#sectionOther').hide(); }
    });
});
</script>
<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/school/view/include/footer.php');?>
