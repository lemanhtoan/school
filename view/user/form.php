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
            <select name="userTypeId" class="form-control userType">
                <option value=""></option>
                <?php foreach ($userType as $typeId => $typeName):?>
                    <option value="<?php echo $typeId; ?>"><?php echo $typeName; ?></option>
                <?php endforeach;?>
            </select>
        </div>
	
	<!-- section sv -->
	<div id="sectionSv" style="display: none">
		<div class="form-group">
		    <label for="name">Mã Sinh Viên</label>
		    <input type="text" name="masv" class="form-control""/>
		</div>
		<div class="form-group">
		    <label for="name">Tên Sinh Viên</label>
		    <input type="text" name="tensv" class="form-control""/>
		</div>
		<div class="form-group">
		    <label for="name">Khóa Học</label>
		    <select name="khoahoc" id="" class="form-control">
		        <option value=""></option>
		        <?php foreach ($KHList as $kh) :?>
		            <option value="<?php echo $kh->id; ?>"><?php echo $kh->ten_khoa_hoc; ?></option>
		        <?php endforeach; ?>
		    </select>
		</div>
		<div class="form-group">
		    <label for="name">Chương Trình Học</label>
		    <select name="chuongtrinhhoc" id="" class="form-control">
		        <option value=""></option>
		        <?php foreach ($CTList as $ct) :?>
		            <option value="<?php echo $ct->id; ?>"><?php echo $ct->ten_chuong_trinh; ?></option>
		        <?php endforeach; ?>
		    </select>
		</div>	
	</div>	
	<!-- section sv -->

	<!-- section gv -->
	<div id="sectionGv" style="display: none">
		<div class="form-group">
		    <label for="name">Mã Giảng Viên</label>
		    <input type="text" name="magv" class="form-control"/>
		</div>
		<div class="form-group">
		    <label for="name">Tên Giảng Viên</label>
		    <input type="text" name="tengv" class="form-control"/>
		</div>
		<div class="form-group">
		    <label for="name">Khoa</label>
		    <select name="khoa" id="" class="form-control">
		        <option value=""></option>
		        <?php foreach ($khoaList as $khoa) :?>
		            <option value="<?php echo $khoa->id; ?>"><?php echo $khoa->ten_khoa; ?></option>
		        <?php endforeach; ?>
		    </select>
		</div>
		<div class="form-group">
		    <label for="name">Bộ Môn</label>
		    <select name="bomon" id="" class="form-control">
		        <option value=""></option>
		        <?php foreach ($BMList as $bm) :?>
		            <option value="<?php echo $bm->id; ?>"><?php echo $bm->ten_mon; ?></option>
		        <?php endforeach; ?>
		    </select>
		</div>
	</div>
	<!-- section gv -->
	
        <div class="form-group">
            <label for="phone">Thông tin khác</label>
            <textarea name="other" class="form-control" rows="3"><?php if (isset($data)) echo $data->thong_tin_khac; ?></textarea>
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
	});
});
</script>
<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/school/view/include/footer.php');?>
