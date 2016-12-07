<?php if ( isset($_POST['form-submitted']) ) { ?>
    <html>
    <body>
    <h1>Đề tài</h1>
    <div class="container">
        <?php if (count($data) > 0) { ?>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Tên đề tài</th>
                    <th>Tên sinh viên</th>
                    <th>Tên giảng viên</th>
                    <th>Khóa học</th>
                    <th>Khoa</th>
                    <th>Mô tả</th>
                    <th>Ngày đăng ký</th>
                    <th>Ngày cập nhật</th>
                    <th>Trạng thái</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 0;
                foreach ($data as $item): $i++; ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td>
                            <b><?php echo $item->ten_dt; ?></b>
                        </td>
                        <td>
                            <b>
                                <?php foreach ($SVList as $kh) {
                                    if ($item->sinhvien_id == $kh->id) {
                                        echo $kh->ho_ten;
                                    }
                                }; ?>
                            </b>
                        </td>
                        <td>
                            <b>
                                <?php foreach ($GVList as $kh) {
                                    if ($item->giangvien_id == $kh->id) {
                                        echo $kh->ho_ten;
                                    }
                                }; ?>
                            </b>
                        </td>
                        <td>
                            <?php foreach ($KHList as $ct) {
                                if ($item->khoahoc_id == $ct->id) {
                                    echo $ct->ten_khoa_hoc;
                                }
                            }; ?>
                        </td>
                        <td>
                            <?php foreach ($khoaList as $ct) {
                                if ($item->khoa_id == $ct->id) {
                                    echo $ct->ten_khoa;
                                }
                            }; ?>
                        </td>
                        <td><?php echo $item->mota; ?></td>
                        <td><?php echo $item->created_at; ?></td>
                        <td><?php echo $item->updated_at; ?></td>
                        <td><?php switch ($item->status) {
                                case 1:
                                    $txt = "Đã đăng ký";
                                    break;
                                case 2:
                                    $txt = "Đã rút";
                                    break;
                                case 3:
                                    $txt = "Đã hoàn thành";
                                    break;
                                case 4:
                                    $txt = "Đã hủy bỏ";
                                    break;
                            }
                            echo $txt; ?></td>

                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

        <?php } else { ?>
            <h5>Empty list.</h5>
        <?php } ?>
    </div>
    </body>
    </html>
    <?php exit; // end of word output
} ?>
<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/school/view/include/header.php');?>
<div class="container">
    <div class="jumbotron">
        <h1>Xuất đề tài ra MS Word</h1>
    </div>
        <form name="export_form" method="post">
            <input type="submit" name="form-submitted" value="Xuất dữ liệu" class="btn btn-info" />
        </form>
    </div>
</div>
<?php require_once(realpath($_SERVER["DOCUMENT_ROOT"]) .'/school/view/include/footer.php');?>
