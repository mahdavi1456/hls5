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
                            <h3 class="card-title">دارایی ها</h3>
                        </div>
                        <div class="card-body">
                            <form method="post" action="" class="form">
                                <?php
                                $db = new database();
                                $prime = new prime();
								$cost = new cost();
								
                                $d_name = "";
                                $d_price = "";
                                $d_date = "";
								$ba_id = "";
								$d_details = "";

                                if(isset($_POST['edit-item-table'])){
                                    $d_id = $_POST['edit-item-table'];
                                    $res = $db->get_select_query("select * from device where d_id = $d_id");
                                    $d_name = $res[0]['d_name'];
                                    $d_price = $res[0]['d_price'];
                                    $d_date = $res[0]['d_date'];
									$ba_id = $res[0]['ba_id'];
									$d_details = $res[0]['d_details'];
                                }
                                ?>
                                <div class="row">
                                    <div class="col-md-3 col-sm-6">
                                        <label>نام</label><span class="necessary"> *</span>
										<input name="d_name" class="form-control" type="text" placeholder="نام..." value="<?php echo $d_name; ?>">
									</div>
                                    <div class="col-md-3 col-sm-6">
                                        <label>قیمت</label><span class="necessary"> *</span>
                                        <input name="d_price" class="form-control" type="text" placeholder="قیمت..." value="<?php echo $d_price; ?>" required>
                                    </div>
									<div class="col-md-3 col-sm-6">
                                        <label>برداشت از</label><span class="necessary"> *</span>
										<select class="form-control" name="ba_id" id="ba_id">
											<option value="0"></option>
											<?php
											$res = 0;
											$res = $db->get_select_query("select * from bank_account");
											if(count($res) > 0){
												foreach($res as $row){ ?>
													<option value="<?php echo $row['ba_id']; ?>" <?php if($row['ba_id'] == $ba_id) { echo 'selected'; }  ?> ><?php echo $row['ba_account_owner']  . " " . $row['ba_account_number'] . " " . $row['ba_name']; ?></option>
												<?php
												}
											}
											?>
										</select>
									</div>
									<div class="col-md-3 col-sm-6">
                                        <label>تاریخ </label><span class="necessary"> *</span>
										<input type="text" name="d_date" class="form-control datepicker" value="<?php if($d_date != "") echo $d_date; else echo jdate('Y/m/d'); ?>" placeholder="تاریخ..." autocomplete="off">
									</div>
								</div><br>
								<div class="row">
									<div class="col-md-12 col-sm-12">
                                        <label>توضیحات</label>
                                        <input name="d_details" class="form-control" type="text" placeholder="توضیحات..." value="<?php echo $d_details; ?>">
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <?php
                                        if(isset($_POST['edit-item-table'])){ ?>
                                            <button value="<?php echo $_POST['edit-item-table']; ?>" name="update-costs" class="btn btn-warning">ویرایش اطلاعات</button>
                                            <?php
                                        } else {
                                            ?>
                                            <button name="add-costs" class="btn btn-success">ذخیره</button>
                                            <?php
                                        } ?>
                                    </div>
                                    <div class="col-md-12">
                                        <?php
										if(isset($_POST['add-costs'])) {
											$d_name = $_POST['d_name'];
											$d_price = $_POST['d_price'];
											$d_date = $_POST['d_date'];
											$ba_id = $_POST['ba_id'];
											$u_id = $_SESSION['user_id'];
											$d_details = $_POST['d_details'];
											$db->ex_query("insert into device(d_name, d_price, d_date, ba_id, d_details, u_id) values('$d_name', '$d_price', '$d_date', $ba_id, '$d_details', u_id)");
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

										
										if(isset($_POST['update-costs'])) {
											$d_id = $_POST['update-costs'];
											$d_name = $_POST['d_name'];
											$d_price = $_POST['d_price'];
											$d_date = $_POST['d_date'];
											$ba_id = $_POST['ba_id'];
											$u_id = $_SESSION['user_id'];
											$d_details = $_POST['d_details'];
											$db->ex_query("update device set d_name = '$d_name', d_price = '$d_price', d_date = '$d_date', ba_id = $ba_id, d_details = '$d_details', u_id = $u_id where d_id = $d_id");
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
                                            $d_id = $_POST['del-item'];
                                            $db->ex_query("delete from device where d_id = $d_id");
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
                                            <h4 class="panel-title">جدول دارایی ها</h4>
                                        </div>
                                        <table class="table table-striped">
                                            <tr>
												<th>ردیف</th>
												<th>نام</th>
												<th>قیمت</th>
												<th>برداشت از</th>
												<th>تاریخ</th>
												<th>توضیحات</th>
												<th>مدیریت</th>
                                            </tr>
                                            <?php
                                            $i = 1;
                                            $res = $db->get_select_query("select * from device");
                                            if(count($res)>0){
                                                foreach($res as $row) { ?>
                                                    <tr>
                                                        <td><?php echo $prime->per_number($i); ?></td>
                                                        <td><?php echo $prime->per_number($row['d_name']); ?></td>
                                                        <td><?php echo $prime->per_number(number_format($row['d_price'])); ?></td>
														<td><?php $ba_id2 = $cost->get_bank_name($row['ba_id']); echo $prime->per_number($ba_id2); ?></td>
														<td><?php echo $prime->per_number($row['d_date']); ?></td>
														<td><?php echo $prime->per_number($row['d_details']); ?></td>
                                                        <td>
                                                            <form action="" method="post">
                                                                <button onclick="if(!confirm('آیا از انجام این عملیات اطمینان دارید؟')){return false;}" name="del-item" value="<?php echo $row['d_id']; ?>" class="btn btn-danger btn-sm">حذف</button>
                                                                <button name="edit-item-table" value="<?php echo $row['d_id']; ?>" class="btn btn-info btn-sm">ویرایش</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $i++;
                                                }
                                            } else { ?>
                                                <tr><td class="text-center" colspan="8">موردی جهت نمایش موجود نیست</td></tr>
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