<?php include"../../../header.php"; ?>
</head>
    <body class="hold-transition sidebar-mini">
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
                            <h3 class="card-title">غذاها</h3>
                        </div>
                        <div class="card-body">
                            <form method="post" action="" class="form">
                                <?php
                                $db = new database();
                                $prime = new prime();
								
                                $f_name = "";
                                $f_type = "";
                                $f_supply = "";
                                $f_price = "";

                                if(isset($_POST['edit-item-table'])){
                                    $f_id = $_POST['edit-item-table'];
                                    $res = $db->get_select_query("select * from food where f_id = $f_id");
                                    $f_name = $res[0]['f_name'];
                                    $f_type = $res[0]['f_type'];
                                    $f_supply = $res[0]['f_supply'];
                                    $f_price = $res[0]['f_price'];
                                }
                                ?>
                                <div class="row">
                                    <div class="col-md-3 col-sm-6">
                                        <label>نام غذا</label><span class="necessary"> *</span>
                                        <input name="f_name" class="form-control" type="text" placeholder="نام غذا..." value="<?php echo $f_name; ?>" required>
                                    </div>
                                    <div class="col-md-3 col-sm-6">
                                        <label>نوع</label><span class="necessary"> *</span>
										<select id="f_type" name="f_type" class="form-control">
											<option value="صبحانه" <?php if($f_type == "صبحانه") { echo 'selected'; } ?> >صبحانه</option>
											<option value="ناهار" <?php if($f_type == "ناهار") { echo 'selected'; } ?> >ناهار</option>
											<option value="میان وعده" <?php if($f_type == "میان وعده") { echo 'selected'; } ?> >میان وعده</option>
											<option value="شام" <?php if($f_type == "شام") { echo 'selected'; } ?> >شام</option>
										</select>
									</div>
                                    <div class="col-md-3 col-sm-6">
                                        <label>موجودی</label><span class="necessary"> *</span>
                                        <input name="f_supply" class="form-control" type="text" placeholder="موجودی..." value="<?php echo $f_supply; ?>" required>
                                    </div>
                                    <div class="col-md-3 col-sm-6">
                                        <label>قیمت</label><span class="necessary"> *</span>
                                        <input name="f_price" class="form-control" type="text" placeholder="قیمت..." value="<?php echo $f_price; ?>">
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
                                            <button name="set-item" class="btn btn-success">ذخیره</button>
                                            <?php
                                        } ?>
                                    </div>
                                    <div class="col-md-12">
                                        <?php
                                        if(isset($_POST['set-item'])){
                                            $f_name = $_POST['f_name'];
                                            $f_type = $_POST['f_type'];
                                            $f_supply = $_POST['f_supply'];
                                            $f_price = $_POST['f_price'];

                                            $db->ex_query("insert into food(f_name, f_type, f_supply, f_price) values('$f_name', '$f_type', $f_supply, $f_price)");
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
                                            $f_id = $_POST['edit-item'];
                                            $f_name = $_POST['f_name'];
                                            $f_type = $_POST['f_type'];
                                            $f_supply = $_POST['f_supply'];
                                            $f_price = $_POST['f_price'];

                                            $db->ex_query("update food set f_name = '$f_name', f_type = '$f_type', f_supply = $f_supply, f_price = $f_price where f_id = $f_id");
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
                                            $f_id = $_POST['del-item'];
                                            $db->ex_query("delete from food where f_id = $f_id");
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
                                            <h4 class="panel-title">جدول غذاها</h4>
                                        </div>
                                        <table class="table table-striped">
                                            <tr>
                                                <th>ردیف</th>
                                                <th>نام غذا</th>
                                                <th>نوع</th>
                                                <th>موجودی</th>
                                                <th>قیمت</th>
                                                <th>مدیریت</th>
                                            </tr>
                                            <?php
                                            $i = 1;
                                            $res = $db->get_select_query("select * from food");
                                            if(count($res)>0){
                                                foreach($res as $row) { ?>
                                                    <tr>
                                                        <td><?php echo $prime->per_number($i); ?></td>
                                                        <td><?php echo $row['f_name']; ?></td>
                                                        <td><?php echo $row['f_type']; ?></td>
                                                        <td><?php echo $prime->per_number($row['f_supply']); ?></td>
                                                        <td><?php echo $prime->per_number(number_format($row['f_price'])); ?></td>
                                                        <td>
                                                            <form action="" method="post">
                                                                <button onclick="if(!confirm('آیا از انجام این عملیات اطمینان دارید؟')){return false;}" name="del-item" value="<?php echo $row['f_id']; ?>" class="btn btn-danger btn-sm">حذف</button>
                                                                <button name="edit-item-table" value="<?php echo $row['f_id']; ?>" class="btn btn-info btn-sm">ویرایش</button>
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