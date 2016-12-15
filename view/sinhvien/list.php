<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/school/view/include/header.php');?>
<?php
    $Pagination = new Pagination();
?>
<div class="container">
<div class="jumbotron">
        <h1>Sinh viên</h1>
    </div>
    <?php if (in_array('sv_new', $role)): ?><div><a href="index.php?op=sv_new" class="btn btn-info">Add new</a></div><?php endif; ?>
    <?php if (in_array('sv_viewlist', $role)) { ?>
        <?php if (isset($_SESSION['user_session'])) { ?>
            <?php if ( count($data) > 0 ) { ?>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th><a href="?op=sv_list&orderby=ma_sinh_vien">Mã sv</a></th>
                    <th><a href="?op=sv_list&orderby=ho_ten">Tên sv</a></th>
                    <th><a href="?op=sv_list&orderby=khoa_hoc_id">Khóa học</a></th>
                    <th><a href="?op=sv_list&orderby=chuong_trinh_id">Chương trình học</a></th>
                    <th><a href="?op=sv_list&orderby=email">Email</a></th>
                    <th>&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 0; foreach ($data as $item): $i++; if($item->ma_sinh_vien == $_SESSION['user_session']->ma_sinh_vien) :?>
                    <tr>
                        <td><?php echo $i;?></td>
                        <td><a href="index.php?op=sv_show&id=<?php echo $item->id; ?>"><?php echo $item->ma_sinh_vien; ?></a></td>
                        <td><?php echo $item->ho_ten?></td>
                        <td>
                            <a href="index.php?op=khoahoc_show&id=<?php echo $item->khoa_hoc_id; ?>">
                                <?php foreach ($KHList as $kh) {
                                    if ( $item->khoa_hoc_id == $kh->id ) {
                                        echo $kh->ten_khoa_hoc;
                                    }
                                }; ?>
                            </a>
                        </td>
                        <td>
                            <a href="index.php?op=chuongtrinh_show&id=<?php echo $item->chuong_trinh_id; ?>">
                                <?php foreach ($CTList as $ct) {
                                    if ( $item->chuong_trinh_id == $ct->id ) {
                                        echo $ct->ten_chuong_trinh;
                                    }
                                }; ?>
                            </a>
                        </td>
                        <td><?php echo $item->email; ?></td>
                        <td>
                            <a href="index.php?op=sv_edit&id=<?php echo $item->id; ?>" class="btn btn-info">edit</a>
                        </td>
                    </tr>
                <?php endif; endforeach; ?>
                </tbody>
            </table>
            <?php } ?>
        <?php } ?>
    <?php } else { ?>
        <?php if ( count($data) > 0 ) { ?>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th><a href="?op=sv_list&orderby=ma_sinh_vien">Mã sv</a></th>
                    <th><a href="?op=sv_list&orderby=ho_ten">Tên sv</a></th>
                    <th><a href="?op=sv_list&orderby=khoa_hoc_id">Khóa học</a></th>
                    <th><a href="?op=sv_list&orderby=chuong_trinh_id">Chương trình học</a></th>
                    <th><a href="?op=sv_list&orderby=email">Email</a></th>
                    <th>&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 0; foreach ($data as $item): $i++;?>
                    <tr>
                        <td><?php echo $i;?></td>
                        <td><a href="index.php?op=sv_show&id=<?php echo $item->id; ?>"><?php echo $item->ma_sinh_vien; ?></a></td>
                        <td><?php echo $item->ho_ten?></td>
                        <td>
                            <a href="index.php?op=khoahoc_show&id=<?php echo $item->khoa_hoc_id; ?>">
                                <?php foreach ($KHList as $kh) {
                                    if ( $item->khoa_hoc_id == $kh->id ) {
                                        echo $kh->ten_khoa_hoc;
                                    }
                                }; ?>
                            </a>
                        </td>
                        <td>
                            <a href="index.php?op=chuongtrinh_show&id=<?php echo $item->chuong_trinh_id; ?>">
                                <?php foreach ($CTList as $ct) {
                                    if ( $item->chuong_trinh_id == $ct->id ) {
                                        echo $ct->ten_chuong_trinh;
                                    }
                                }; ?>
                            </a>
                        </td>
                        <td><?php echo $item->email; ?></td>
                        <td>
                            <a href="index.php?op=sv_edit&id=<?php echo $item->id; ?>" class="btn btn-info">edit</a>
                            <a href="index.php?op=sv_delete&id=<?php echo $item->id; ?>" class="btn btn-danger" onclick="return checkDel()">delete</a>
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
