<?php include"../../../header.php"; ?>
</head>
    <body class="hold-transition sidebar-mini <?php $opt = new option(); $opt->check_push(); ?>">
<div class="wrapper">
    <?php include"../../../nav.php"; include"../../../menu.php"; ?>

    <div class="content-wrapper">
        <br>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">فروش آزاد</h3>
                        </div>
                        <div class="card-body">
                            <form method="post" action="" class="form">
                                <?php
                                $db = new database();
                                $prime = new prime();
								
                                $pr_name = "";
                                $pr_stock = "";
                                $pr_buy = "";
                                $pr_sale = "";

                                if(isset($_POST['edit-item-table'])){
                                    $pr_id = $_POST['edit-item-table'];
                                    $res = $db->get_select_query("select * from product where pr_id = $pr_id");
                                    $pr_name = $res[0]['pr_name'];
                                    $pr_stock = $res[0]['pr_stock'];
                                    $pr_buy = $res[0]['pr_buy'];
                                    $pr_sale = $res[0]['pr_sale'];
                                }
                                ?>
                                <div class="row">
									<input type="hidden" name="u_id" value="<?php echo ; ?>">
                                    <div class="col-md-3 col-sm-6">
                                        <label>انتخاب شخص</label>
                                        <input name="p_id" class="form-control" type="text">
                                    </div>
                                    <div class="col-md-3 col-sm-6">
                                        <label>انتخاب محصول</label>
                                        <input name="pr_id" class="form-control" type="text">
                                    </div>
                                    <div class="col-md-3 col-sm-6">
                                        <label>تعداد</label>
                                        <input name="f_count" class="form-control" type="text" placeholder="تعداد..." value="<?php echo $f_count; ?>">
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <?php
                                        if(isset($_POST['edit-item-table'])){ ?>
                                            <button value="<?php echo $_POST['edit-item-table']; ?>" name="edit-item" class="btn btn-warning">ویرایش اطلاعات</button>
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
                                            $pr_name = $_POST['pr_name'];
                                            $pr_stock = $_POST['pr_stock'];
                                            $pr_buy = $_POST['pr_buy'];
                                            $pr_sale = $_POST['pr_sale'];

                                            $db->ex_query("insert into product(pr_name, pr_stock, pr_buy, pr_sale) values('$pr_name', $pr_stock, $pr_buy, $pr_sale)");
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

                                        if(isset($_POST['edit-item']))
                                        {
                                            $pr_id = $_POST['edit-item'];
                                            $pr_name = $_POST['pr_name'];
                                            $pr_stock = $_POST['pr_stock'];
                                            $pr_buy = $_POST['pr_buy'];
                                            $pr_sale = $_POST['pr_sale'];

                                            $db->ex_query("update product set pr_name = '$pr_name', pr_stock = $pr_stock, pr_buy = $pr_buy, pr_sale = $pr_sale where pr_id = $pr_id");
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

                                        if(isset($_POST['del-item']))
                                        {
                                            $pr_id = $_POST['del-item'];
                                            $db->ex_query("delete from product where pr_id = $pr_id");
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
                                            <h4 class="panel-title">جدول محصولات</h4>
                                        </div>
                                        <table class="table table-striped">
                                            <tr>
                                                <th>ردیف</th>
                                                <th>نام محصول</th>
                                                <th>موجودی</th>
                                                <th>قیمت خرید</th>
                                                <th>قیمت فروش</th>
                                                <th>مدیریت</th>
                                            </tr>
                                            <?php
                                            $i = 1;
                                            $res = $db->get_select_query("select * from product");
                                            if(count($res)>0){
                                                foreach($res as $row) { ?>
                                                    <tr>
                                                        <td><?php echo $prime->per_number($i); ?></td>
                                                        <td><?php echo $row['pr_name']; ?></td>
                                                        <td><?php echo $prime->per_number($row['pr_stock']); ?></td>
                                                        <td><?php echo $prime->per_number($row['pr_buy']); ?></td>
                                                        <td><?php echo $prime->per_number($row['pr_sale']); ?></td>
                                                        <td>
                                                            <form action="" method="post">
                                                                <button onclick="if(!confirm('آیا از انجام این عملیات اطمینان دارید؟')){return false;}" name="del-item" value="<?php echo $row['pr_id']; ?>" class="btn btn-danger btn-sm">حذف</button>
                                                                <button name="edit-item-table" value="<?php echo $row['pr_id']; ?>" class="btn btn-info btn-sm">ویرایش</button>
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
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<?php include "../../../footer.php"; ?>