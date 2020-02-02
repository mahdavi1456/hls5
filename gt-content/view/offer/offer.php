<?php include"../../../header.php"; ?>
</head>
    <body class="hold-transition sidebar-mini <?php $opt = new option(); $opt->check_push(); ?>">
    <div class="wrapper">
        <!-- Navbar -->
        <?php include"../../../nav.php"; include"../../../menu.php"; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <br>
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">کدهای تخفیف</h3>
                            </div>
                            <div class="card-body">
                                <form method="post" action="" class="form">
                                    <?php
                                    $db = new database();
                                    $prime = new prime();
                                    $o_code = "";
                                    $o_type = "";
                                    $o_per = "";
                                    $o_details = "";

                                    if(isset($_POST['edit-item-table'])){
                                        $o_id = $_POST['edit-item-table'];
                                        $res = $db->get_select_query("select * from offer where o_id = $o_id");
                                        $o_code = $res[0]['o_code'];
                                        $o_type = $res[0]['o_type'];
                                        $o_per = $res[0]['o_per'];
                                        $o_details = $res[0]['o_details'];
                                    }
                                    ?>
                                    <div class="row">
                                        <input type="hidden" name="a_id" value="<?php echo $a_id; ?>">
                                        <div class="col-md-3 text-center">
                                            <label>نام کد</label>
                                            <input name="o_code" class="form-control" type="text" placeholder="نام کد" value="<?php echo $o_code; ?>">
                                        </div>
                                        <div class="col-md-3 text-center">
                                            <label>نوع تخفیف</label>
                                            <select name="o_type" class="form-control">
                                                <option value="درصد" <?php if($o_type == "درصد") echo "selected"; ?>>درصد</option>
                                                <option value="مبلغ" <?php if($o_type == "مبلغ") echo "selected"; ?>>مبلغ</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 text-center">
                                            <label>مقدار تخفیف</label>
                                            <input name="o_per" class="form-control" type="text" placeholder="درصد تخفیف" value="<?php echo $o_per; ?>">
                                        </div>
                                        <div class="col-md-3 text-center">
                                            <label>توضیحات</label>
                                            <input name="o_details" class="form-control" type="text" placeholder="توضیحات" value="<?php echo $o_details; ?>">
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <?php
                                            if(isset($_POST['edit-item-table'])){ ?>
                                                <button value="<?php echo $_POST['edit-item-table']; ?>" name="edit-item" class="btn btn-warning">ویرایش اطلاعات</button>
                                                <button class="btn btn-danger" onclick="window.location.reload();">انصراف از ویرایش</button>
                                                <?php
                                            } else {
                                                ?>
                                                <button name="set-item" class="btn btn-success">ثبت اطلاعات</button>
                                                <?php
                                            } ?>
                                        </div>
                                        <div class="col-md-12">
                                            <?php
                                            if(isset($_POST['set-item'])){
                                                $o_code = $_POST['o_code'];
                                                $o_type = $_POST['o_type'];
                                                $o_per = $_POST['o_per'];
                                                $o_details = $_POST['o_details'];
                                                $db->ex_query("insert into offer(o_code, o_type, o_per, o_details) values('$o_code', '$o_type', $o_per, '$o_details')");
                                                ?><br>
                                                <div class="alert alert-success">
                                                    مورد با موفقیت ثبت شد
                                                </div>
                                                <script type="text/javascript">
                                                    window.location.reload();
                                                    return;
                                                </script>
                                                <?php
                                            }

                                            if(isset($_POST['edit-item'])){
                                                $o_id = $_POST['edit-item'];
                                                $o_code = $_POST['o_code'];
                                                $o_type = $_POST['o_type'];
                                                $o_per = $_POST['o_per'];
                                                $o_details = $_POST['o_details'];
                                                $db->ex_query("update offer set o_code = '$o_code', o_type = '$o_type', o_per = $o_per, o_details = '$o_details' where o_id = $o_id");
                                                ?><br>
                                                <div class="alert alert-warning">
                                                    مورد با موفقیت ویرایش شد
                                                </div>
                                                <script type="text/javascript">
                                                    window.location.reload();
                                                    return;
                                                </script>
                                                <?php
                                            }

                                            if(isset($_POST['del-item'])){
                                                $o_id = $_POST['del-item'];
                                                $db->ex_query("delete from offer where o_id = $o_id");
                                                ?><br>
                                                <div class="alert alert-success">
                                                    مورد با موفقیت حذف شد
                                                </div>
                                                <script type="text/javascript">
                                                    window.location.reload();
                                                    return;
                                                </script>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </form>
                                <hr>
                                <div class="row">
                                    
                                        <div class="panel panel-success table-responsive">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">جدول کدهای تخفیف</h4>
                                            </div>
                                            <table class="table table-striped">
                                                <tr>
                                                    <th>ردیف</th>
                                                    <th>نام کد</th>
                                                    <th>نوع تخفیف</th>
                                                    <th>مقدار تخفیف</th>
                                                    <th>توضیحات</th>
                                                    <th>مدیریت</th>
                                                </tr>
                                                <?php
                                                $i = 1;
                                                $res = $db->get_select_query("select * from offer");
                                                if(count($res)>0) {
                                                    foreach($res as $row) { ?>
                                                        <tr>
                                                            <td><?php echo $prime->per_number($i); ?></td>
                                                            <td><?php echo $row['o_code']; ?></td>
                                                            <td><?php echo $row['o_type']; ?></td>
                                                            <td><?php echo $prime->per_number(number_format($row['o_per'])); if($row['o_type'] == "درصد") echo " درصد"; ?></td>
                                                            <td><?php echo $prime->per_number($row['o_details']); ?></td>
                                                            <td>
                                                                <form action="" method="post">
                                                                    <button onclick="if(!confirm('آیا از انجام این عملیات اطمینان دارید؟')){return false;}" name="del-item" value="<?php echo $row['o_id']; ?>" class="btn btn-danger btn-sm">حذف</button>
                                                                    <button name="edit-item-table" value="<?php echo $row['o_id']; ?>" class="btn btn-info btn-sm">ویرایش</button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                        $i++;
                                                    }
                                                } else { ?>
                                                    <tr><td class="text-center" colspan="6">موردی جهت نمایش موجود نیست</td></tr>
                                                    <?php
                                                } ?>
                                            </table>
                                        </div>
                                    
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </section>
            <!-- /.content -->
        </div>
    </div>
<?php include "../../../footer.php";