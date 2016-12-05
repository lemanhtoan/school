<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/school/view/include/header.php');?>
<?php
    $Pagination = new Pagination();
?>
<div class="container">
    <div><a href="index.php?op=khoahoc_new" class="btn btn-info">Add new</a></div>
    <?php if ( count($data) > 0 ) { ?>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th><a href="?op=khoahoc_list&orderby=ma_khoa_hoc">Mã khóa học</a></th>
            <th><a href="?op=khoahoc_list&orderby=ten_khoa_hoc">Tên khóa học</a></th>
            <th><a href="?op=khoahoc_list&orderby=khoa_id">Khoa</a></th>
            <th><a href="?op=khoahoc_list&orderby=time_start">Thời gian bắt đầu</a></th>
            <th><a href="?op=khoahoc_list&orderby=time_end">Thời gian kết thúc</a></th>
            <th><a href="?op=khoahoc_list&orderby=ghi_chu">Ghi chú</a></th>
            <th>&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        <?php $i = 0; foreach ($data as $item): $i++;?>
            <tr>
                <td><?php echo $i;?></td>
                <td><a href="index.php?op=khoahoc_show&id=<?php echo $item->id; ?>"><?php echo $item->ma_khoa_hoc; ?></a></td>
                <td><a href="index.php?op=khoahoc_show&id=<?php echo $item->id; ?>"><?php echo $item->ten_khoa_hoc; ?></a></td>
                <td>
                    <a href="index.php?op=khoa_show&id=<?php echo $item->khoa_id; ?>">
                        <?php foreach ($khoaList as $khoa) {
                            if ( $item->khoa_id == $khoa->id ) {
                                echo $khoa->ten_khoa;
                            }
                        }; ?>
                    </a></td>
                <td><?php echo $item->time_start; ?></td>
                <td><?php echo $item->time_end; ?></td>
                <td><?php echo $item->ghi_chu; ?></td>
                <td>
                    <a href="index.php?op=khoahoc_edit&id=<?php echo $item->id; ?>" class="btn btn-info">edit</a>
                    <a href="index.php?op=khoahoc_delete&id=<?php echo $item->id; ?>" class="btn btn-danger" onclick="return checkDel()">delete</a>
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
