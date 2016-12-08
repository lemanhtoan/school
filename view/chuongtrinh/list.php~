<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/school/view/include/header.php');?>
<?php
    $Pagination = new Pagination();
?>
<div class="container">
    <div><a href="index.php?op=chuongtrinh_new" class="btn btn-info">Add new</a></div>
    <?php if ( count($data) > 0 ) { ?>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th><a href="?op=chuongtrinh_list&orderby=ten_chuong_trinh">Tên Chương Trình</a></th>
            <th><a href="?op=chuongtrinh_list&orderby=khoa_hoc_id">Khóa Học</a></th>
            <th><a href="?op=chuongtrinh_list&orderby=total_time">Thời Gian Học</a></th>
            <th><a href="?op=chuongtrinh_list&orderby=ghi_chu">Ghi chú</a></th>
            <th>&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        <?php $i = 0; foreach ($data as $item): $i++;?>
            <tr>
                <td><?php echo $i;?></td>
                <td><a href="index.php?op=chuongtrinh_show&id=<?php echo $item->id; ?>"><?php echo $item->ten_chuong_trinh; ?></a></td>
                <td>
                    <a href="index.php?op=khoahoc_show&id=<?php echo $item->khoa_hoc_id; ?>">
                        <?php foreach ($khoaHocList as $khoahoc) {
                            if ( $item->khoa_hoc_id == $khoahoc->id ) {
                                echo $khoahoc->ten_khoa_hoc;
                            }
                        }; ?>
                    </a></td>
                <td><?php echo $item->total_time; ?></td>
                <td><?php echo $item->ghi_chu; ?></td>
                <td>
                    <a href="index.php?op=chuongtrinh_edit&id=<?php echo $item->id; ?>" class="btn btn-info">edit</a>
                    <a href="index.php?op=chuongtrinh_delete&id=<?php echo $item->id; ?>" class="btn btn-danger" onclick="return checkDel()">delete</a>
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
</div>
<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/school/view/include/footer.php');?>
