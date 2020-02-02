<?php include"../../../header.php"; ?>
</head>
    <body class="hold-transition sidebar-mini <?php $opt = new option(); $opt->check_push(); ?>">
<div class="wrapper">
    <!-- Navbar -->
    <?php include"../../../nav.php"; ?>

    <!-- Main Sidebar Container -->
    <?php include"../../../menu.php"; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <br>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">امانتی ها</h3>
                        </div>
                        <div class="card-body">
                            <form method="post" action="" class="form">
                                <?php
                                $db = new database();
                                $prime = new prime();
                                $ad_name = "";

                                if(isset($_POST['edit-item-table'])){
                                    $ad_id = $_POST['edit-item-table'];
                                    $res = $db->get_select_query("select * from adjective where ad_id = $ad_id");
                                    $ad_name = $res[0]['ad_name'];
                                }
                                ?>
                                <div class="row">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4 text-center">
                                        <h3>نام امانتی</h3>
                                        <input name="ad_name" class="form-control" type="text" placeholder="نام امانتی..." value="<?php echo $ad_name; ?>">
                                    </div>
                                    <div class="col-md-4"></div>
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
                                            $ad_name = $_POST['ad_name'];
                                            $db->ex_query("insert into adjective(ad_name) values('$ad_name')");
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
                                            $ad_id = $_POST['edit-item'];
                                            $ad_name = $_POST['ad_name'];

                                            $db->ex_query("update adjective set ad_name = '$ad_name' where ad_id = $ad_id");
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
                                            $ad_id = $_POST['del-item'];
                                            $db->ex_query("delete from adjective where ad_id = $ad_id");
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
                                            <h4 class="panel-title">جدول امانتی ها</h4>
                                        </div>
                                        <table class="table table-striped">
                                            <tr>
                                                <th>ردیف</th>
                                                <th>نام امانتی</th>
                                                <th>مدیریت</th>
                                            </tr>
                                            <?php
                                            $i = 1;
                                            $res = $db->get_select_query("select * from adjective");
                                            if(count($res) > 0){
                                                foreach($res as $row){ ?>
                                                    <tr>
                                                        <td><?php echo $prime->per_number($i); ?></td>
                                                        <td><?php echo $row['ad_name']; ?></td>
                                                        <td>
                                                            <form action="" method="post">
                                                                <button onclick="if(!confirm('آیا از انجام این عملیات اطمینان دارید؟')){return false;}" name="del-item" value="<?php echo $row['ad_id']; ?>" class="btn btn-danger btn-sm">حذف</button>
                                                                <button name="edit-item-table" value="<?php echo $row['ad_id']; ?>" class="btn btn-info btn-sm">ویرایش</button>
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