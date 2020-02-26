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
								$person = new person();
								$product = new product();
								$u_id = $_SESSION['user_id'];
								
                                $p_id = "";
                                $pr_id = "";
                                $f_count = "";
                                $pr_price = "";
								$p_name = "";
								$p_family = "";

                                if(isset($_POST['edit-item-table'])){
                                    $f_id = $_POST['edit-item-table'];
                                    $res = $db->get_select_query("select * from factor where f_id = $f_id");
                                    $p_id = $res[0]['p_id'];
									$p_name = $db->get_var_query("select p_name from person where p_id = $p_id");
									$p_family = $db->get_var_query("select p_family from person where p_id = $p_id");
                                    $pr_id = $res[0]['pr_id'];
                                    $f_count = $res[0]['f_count'];
                                    $pr_price = $res[0]['pr_price'];
                                }
                                ?>
                                <div class="row">
									<input type="hidden" id="u_id" name="u_id" value="<?php echo $u_id; ?>" >
									<input type="hidden" id="f_date" name="f_date" value="<?php echo jdate('Y-m-d H:i:s'); ?>">
									<div id="login-p-name-container" class="col-md-3 col-sm-6">
										<label>انتخاب شخص</label>
										<input type="text" placeholder="سه حرف اول فامیل..." autocomplete="off" id="p_family" value="<?php echo $p_name . " " . $p_family; ?>" class="form-control" style="width: 100%">
										<div class="family-search-result"></div>
										<input type="hidden" id="p_id" name="p_id" value="<?php echo $p_id; ?>">
									</div>
                                    <div class="col-md-3 col-sm-6">
                                        <label>محصول</label><span class="necessary"> *</span>
										<select id="pr_id3" name="pr_id" class="form-control select2 change-count2">
										<?php
										$res = $db->get_select_query("select pr_id, pr_name from product");
										if(count($res) > 0) {
											foreach($res as $row) {
												?>
												<option value="<?php echo $row['pr_id']; ?>" <?php if($pr_id == $row['pr_id']) { echo 'selected'; } ?> ><?php echo $row['pr_name']; ?></option>
												<?php
											}
										}
										?>
										</select>
                                    </div>
                                    <div class="col-md-3 col-sm-6">
                                        <label>تعداد</label><span class="necessary"> *</span>
                                        <input name="f_count" id="f_count3" class="form-control change-count2" type="text" placeholder="تعداد..." value="<?php echo $f_count; ?>" required>
                                    </div>
									<div class="col-md-3 col-sm-6">
										<label>قیمت کل</label>
										<input  id="pr_price3" type="text" name="pr_price" placeholder="قیمت کل..." class="form-control"  value="<?php echo $pr_price;  ?>" autocomplete="off">
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
                                            $u_id = $_POST['u_id'];
                                            $f_date = $_POST['f_date'];
                                            $p_id = $_POST['p_id'];
											$pr_id = $_POST['pr_id'];
											$f_count = $_POST['f_count'];
											$pr_price = $_POST['pr_price'];

                                            $db->ex_query("insert into factor(u_id, f_date, p_id, pr_id, f_count, pr_price) values($u_id, '$f_date', $p_id, $pr_id, $f_count, $pr_price)");
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
											$u_id = $_POST['u_id'];
                                            $f_date = $_POST['f_date'];
                                            $p_id = $_POST['p_id'];
											$pr_id = $_POST['pr_id'];
											$f_count = $_POST['f_count'];
											$pr_price = $_POST['pr_price'];

                                            $db->ex_query("update factor set u_id = $u_id, f_date = '$f_date', p_id = $p_id, pr_id = $pr_id, f_count = $f_count, pr_price = $pr_price where f_id = $f_id");
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
                                            $db->ex_query("delete from factor where f_id = $f_id");
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
                                            <h4 class="panel-title">فاکتورهای فروش امروز</h4>
                                        </div>
                                        <table class="table table-striped">
                                            <tr>
                                                <th>ردیف</th>
                                                <th>شخص</th>
                                                <th>محصول</th>
                                                <th>تعداد</th>
                                                <th>قیمت کل</th>
                                                <th>مدیریت</th>
                                            </tr>
                                            <?php
                                            $i = 1;
											$date = jdate('Y-m-d');
                                            $res = $db->get_select_query("select * from factor where f_date like '$date%'");
                                            if(count($res)>0){
                                                foreach($res as $row) { ?>
                                                    <tr>
                                                        <td><?php echo $prime->per_number($i); ?></td>
                                                        <td><?php echo $person->get_person_name($row['p_id']); ?></td>
                                                        <td><?php echo $product->get_product_name($row['pr_id']); ?></td>
                                                        <td><?php echo $prime->per_number($row['f_count']); ?></td>
                                                        <td><?php echo $prime->per_number(number_format($row['pr_price'])); ?></td>
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