<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/school/view/include/header.php');?>
<?php
    $Pagination = new Pagination();
?>
<div class="container">
    <div><a href="index.php?op=gv_new" class="btn btn-info">Add new</a></div>
    <?php if ( count($data) > 0 ) { ?>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th><a href="?op=gv_list&orderby=ma_giang_vien">Mã GV</a></th>
            <th><a href="?op=gv_list&orderby=ho_ten">Tên GV</a></th>
            <th><a href="?op=gv_list&orderby=khoa_id">Khoa</a></th>
            <th><a href="?op=gv_list&orderby=bo_mon_id">Bộ Môn</a></th>
            <th><a href="?op=gv_list&orderby=email">Email</a></th>
            <th>&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        <?php $i = 0; foreach ($data as $item): $i++;?>
            <tr>
                <td><?php echo $i;?></td>
                <td><a href="index.php?op=gv_show&id=<?php echo $item->id; ?>"><?php echo $item->ma_giang_vien; ?></a></td>
                <td><?php echo $item->ho_ten?></td>
                <td>
                    <a href="index.php?op=khoa_show&id=<?php echo $item->khoa_id; ?>">
                        <?php foreach ($khoaList as $khoa) {
                            if ( $item->khoa_id == $khoa->id ) {
                                echo $khoa->ten_khoa;
                            }
                        }; ?>
                    </a>
                </td>
                <td>
                    <a href="index.php?op=bomon_show&id=<?php echo $item->bo_mon_id; ?>">
                        <?php foreach ($BMList as $bm) {
                            if ( $item->bo_mon_id == $bm->id ) {
                                echo $bm->ten_mon;
                            }
                        }; ?>
                    </a>
                </td>
                <td><?php echo $item->email; ?></td>
                <td>
                    <a href="index.php?op=gv_edit&id=<?php echo $item->id; ?>" class="btn btn-info">edit</a>
                    <a href="index.php?op=gv_delete&id=<?php echo $item->id; ?>" class="btn btn-danger" onclick="return checkDel()">delete</a>
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
