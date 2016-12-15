<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/school/view/include/header.php');?>
<?php
    $Pagination = new Pagination();
?>
<div class="container">
<div class="jumbotron">
        <h1>Đề tài</h1>
    </div>
    <?php if (isset($_SESSION['user_session'])) { ?>
        <?php if ( count($data) > 0 ) { ?>
            <?php $count = 0; foreach ($data as $item): $i++; 
            if ($_SESSION['user_session']->email == $item->svEmail): $count++; ?>
            <?php endif; endforeach;?>
    <?php } }?>
    <?php if ($count != '1') :?>
        <div><a href="index.php?op=detai_new" class="btn btn-info">Add new</a></div>
    <?php endif; ?>
    
    <?php if (in_array('sv_dtlist', $role)) { ?>
        <?php if (isset($_SESSION['user_session'])) { ?>
            <?php if ( count($data) > 0 ) { ?>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th><a href="?op=detai_list&orderby=ten_dt">Tên đề tài</a></th>
                    <th><a href="?op=detai_list&orderby=sinhvien_id">Tên sinh viên</a></th>
                    <th><a href="?op=detai_list&orderby=giangvien_id">Tên giảng viên</a></th>
                    <th><a href="?op=detai_list&orderby=khoahoc_id">Khóa học</a></th>
                    <th><a href="?op=detai_list&orderby=khoa_id">Khoa</a></th>
                    <th><a href="?op=detai_list&orderby=mota">Mô tả</a></th>
                    <th><a href="?op=detai_list&orderby=created_at">Ngày đăng ký</a></th>
                    <th><a href="?op=detai_list&orderby=updated_at">Ngày cập nhật</a></th>
                    <th><a href="?op=detai_list&orderby=status">Trạng thái</a></th>
                    <th>&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 0; foreach ($data as $item): $i++; if ($_SESSION['user_session']->email == $item->svEmail): ?>
                    <tr>
                        <td><?php echo $i;?></td>
                        <td><a href="index.php?op=detai_show&id=<?php echo $item->id; ?>"><?php echo $item->ten_dt; ?></a></td>
                        <td>
                            <a href="index.php?op=sv_show&id=<?php echo $item->sinhvien_id; ?>">
                                <?php  foreach ($SVList as $kh) {
                                    if ( $item->sinhvien_id == $kh->id ) {
                                        echo $kh->ho_ten;
                                    }
                                }; ?>
                            </a>
                        </td>
                        <td>
                            <a href="index.php?op=gv_show&id=<?php echo $item->giangvien_id; ?>">
                                <?php foreach ($GVList as $kh) {
                                    if ( $item->giangvien_id == $kh->id ) {
                                        echo $kh->ho_ten;
                                    }
                                }; ?>
                            </a>
                        </td>
                        <td>
                            <a href="index.php?op=khoahoc_show&id=<?php echo $item->khoahoc_id; ?>">
                                <?php foreach ($KHList as $ct) {
                                    if ( $item->khoahoc_id == $ct->id ) {
                                        echo $ct->ten_khoa_hoc;
                                    }
                                }; ?>
                            </a>
                        </td>
                        <td>
                            <a href="index.php?op=khoa_show&id=<?php echo $item->khoa_id; ?>">
                                <?php foreach ($khoaList as $ct) {
                                    if ( $item->khoa_id == $ct->id ) {
                                        echo $ct->ten_khoa;
                                    }
                                }; ?>
                            </a>
                        </td>
                        <td><?php echo $item->mota; ?></td>
                        <td><?php echo $item->created_at; ?></td>
                        <td><?php echo $item->updated_at; ?></td>
                        <td><?php switch ($item->status) {
                                case 1: $txt = "Đã đăng ký"; break;
                                case 2: $txt = "Đã rút"; break;
                                case 3: $txt = "Đã hoàn thành"; break;
                                case 4: $txt = "Đã hủy bỏ"; break;
                            } echo $txt; ?></td>
                        <td>
                            <a href="index.php?op=detai_edit&id=<?php echo $item->id; ?>" class="btn btn-info">edit</a>
                        </td>
                    </tr>
                <?php endif; endforeach; ?>
                </tbody>
            </table>
        <?php } } ?>
    <?php } else { ?>
        <?php if ( count($data) > 0 ) { ?>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th><a href="?op=detai_list&orderby=ten_dt">Tên đề tài</a></th>
                    <th><a href="?op=detai_list&orderby=sinhvien_id">Tên sinh viên</a></th>
                    <th><a href="?op=detai_list&orderby=giangvien_id">Tên giảng viên</a></th>
                    <th><a href="?op=detai_list&orderby=khoahoc_id">Khóa học</a></th>
                    <th><a href="?op=detai_list&orderby=khoa_id">Khoa</a></th>
                    <th><a href="?op=detai_list&orderby=mota">Mô tả</a></th>
                    <th><a href="?op=detai_list&orderby=created_at">Ngày đăng ký</a></th>
                    <th><a href="?op=detai_list&orderby=updated_at">Ngày cập nhật</a></th>
                    <th><a href="?op=detai_list&orderby=status">Trạng thái</a></th>
                    <th>&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 0; foreach ($data as $item): $i++;?>
                    <tr>
                        <td><?php echo $i;?></td>
                        <td><a href="index.php?op=detai_show&id=<?php echo $item->id; ?>"><?php echo $item->ten_dt; ?></a></td>
                        <td>
                            <a href="index.php?op=sv_show&id=<?php echo $item->sinhvien_id; ?>">
                                <?php  foreach ($SVList as $kh) {
                                    if ( $item->sinhvien_id == $kh->id ) {
                                        echo $kh->ho_ten;
                                    }
                                }; ?>
                            </a>
                        </td>
                        <td>
                            <a href="index.php?op=gv_show&id=<?php echo $item->giangvien_id; ?>">
                                <?php foreach ($GVList as $kh) {
                                    if ( $item->giangvien_id == $kh->id ) {
                                        echo $kh->ho_ten;
                                    }
                                }; ?>
                            </a>
                        </td>
                        <td>
                            <a href="index.php?op=khoahoc_show&id=<?php echo $item->khoahoc_id; ?>">
                                <?php foreach ($KHList as $ct) {
                                    if ( $item->khoahoc_id == $ct->id ) {
                                        echo $ct->ten_khoa_hoc;
                                    }
                                }; ?>
                            </a>
                        </td>
                        <td>
                            <a href="index.php?op=khoa_show&id=<?php echo $item->khoa_id; ?>">
                                <?php foreach ($khoaList as $ct) {
                                    if ( $item->khoa_id == $ct->id ) {
                                        echo $ct->ten_khoa;
                                    }
                                }; ?>
                            </a>
                        </td>
                        <td><?php echo $item->mota; ?></td>
                        <td><?php echo $item->created_at; ?></td>
                        <td><?php echo $item->updated_at; ?></td>
                        <td><?php switch ($item->status) {
                                case 1: $txt = "Đã đăng ký"; break;
                                case 2: $txt = "Đã rút"; break;
                                case 3: $txt = "Đã hoàn thành"; break;
                                case 4: $txt = "Đã hủy bỏ"; break;
                            } echo $txt; ?></td>
                        <td>
                            <a href="index.php?op=detai_edit&id=<?php echo $item->id; ?>" class="btn btn-info">edit</a>
                            <a href="index.php?op=detai_delete&id=<?php echo $item->id; ?>" class="btn btn-danger" onclick="return checkDel()">delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

            <ul class="pagination">
                <?php echo $Pagination->listPages($totalPages); ?>
            </ul>

            <?php } else { ?>
                <h5>Empty list.</h5>
            <?php } ?>
    <?php } ?>
    
</div>
<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/school/view/include/footer.php');?>
