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
                            <h3 class="card-title">مدیریت هزینه ها</h3>
                        </div>
                        <div class="card-body">
                            <form method="post" action="" class="form">
                                <?php
                                $db = new database();
                                $prime = new prime();
								$cost = new cost();
								
                                $h_id = "";
                                $c_price = "";
                                $c_date = "";
								$c_time = "";
								$ba_id = "";
								$u_id = "";
								$c_details = "";

                                if(isset($_POST['edit-item-table'])){
                                    $c_id = $_POST['edit-item-table'];
                                    $res = $db->get_select_query("select * from costs where c_id = $c_id");
                                    $h_id = $res[0]['h_id'];
                                    $c_price = $res[0]['c_price'];
                                    $c_date = $res[0]['c_date'];
									$c_time = $res[0]['c_time'];
									$ba_id = $res[0]['ba_id'];
									$u_id = $res[0]['u_id'];
									$c_details = $res[0]['c_details'];
                                }
                                ?>
                                <div class="row">
                                    <div class="col-md-4 col-sm-6">
                                        <label>سرفصل</label><span class="necessary"> *</span>
										<select class="form-control" name="h_id" id="h_id">
											<option value="0"></option>
											<?php
											$res = 0;
											$res = $db->get_select_query("select * from headlines");
											if(count($res) > 0){
												foreach($res as $row){ ?>
													<option value="<?php echo $row['h_id']; ?>" <?php if($row['h_id'] == $h_id) { echo 'selected'; }  ?> ><?php echo $row['h_name']; ?></option>
												<?php
												}
											}
											?>
										</select>
									</div>
                                    <div class="col-md-4 col-sm-6">
                                        <label>مبلغ</label><span class="necessary"> *</span>
                                        <input name="c_price" class="form-control" type="text" placeholder="مبلغ..." value="<?php echo $c_price; ?>" required>
                                    </div>
									<div class="col-md-4 col-sm-6">
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
								</div><br>
								<div class="row">
									<div class="col-md-4 col-sm-6">
                                        <label>تاریخ </label><span class="necessary"> *</span>
										<input type="text" name="c_date" class="form-control datepicker" value="<?php if($c_date != "") echo $c_date; else echo jdate('Y/m/d'); ?>" placeholder="تاریخ..." autocomplete="off">
									</div>
									<div class="col-md-4 col-sm-6">
                                        <label>ساعت</label><span class="necessary"> *</span>
                                        <input name="c_time" class="form-control" type="text" placeholder="ساعت..." value="<?php if($c_time != "") echo $c_time; else echo  jdate("H:i"); ?>" required>
                                    </div>
									<div class="col-md-4 col-sm-6">
                                        <label>توضیحات</label>
                                        <input name="c_details" class="form-control" type="text" placeholder="توضیحات..." value="<?php echo $c_details; ?>" required>
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
											$h_id = $_POST['h_id'];
											$c_price = $_POST['c_price'];
											$c_date = $_POST['c_date'];
											$c_time = $_POST['c_time'];
											$ba_id = $_POST['ba_id'];
											$u_id = $_SESSION['user_id'];
											$c_details = $_POST['c_details'];
											$db->ex_query("insert into costs(h_id, c_price, c_date, c_time, ba_id, u_id, c_details) values($h_id, '$c_price', '$c_date', '$c_time', $ba_id, $u_id, '$c_details')");
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
											$c_id = $_POST['update-costs'];
											$h_id = $_POST['h_id'];
											$c_price = $_POST['c_price'];
											$c_date = $_POST['c_date'];
											$c_time = $_POST['c_time'];
											$ba_id = $_POST['ba_id'];
											$u_id = $_SESSION['user_id'];
											$c_details = $_POST['c_details'];
											$db->ex_query("update costs set h_id = $h_id, c_price = '$c_price', c_date = '$c_date', c_time = '$c_time', ba_id = $ba_id, u_id = $u_id, c_details = '$c_details' where c_id = $c_id");
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
                                            $c_id = $_POST['del-item'];
                                            $db->ex_query("delete from costs where c_id = $c_id");
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
                                            <h4 class="panel-title">جدول هزینه ها</h4>
                                        </div>
                                        <table class="table table-striped">
                                            <tr>
												<th>ردیف</th>
												<th>سرفصل</th>
												<th>مبلغ</th>
												<th>تاریخ</th>
												<th>ساعت</th>
												<th>حساب</th>
												<th>توضیحات</th>
												<th>مدیریت</th>
                                            </tr>
                                            <?php
                                            $i = 1;
                                            $res = $db->get_select_query("select * from costs");
                                            if(count($res)>0){
                                                foreach($res as $row) { ?>
                                                    <tr>
                                                        <td><?php echo $prime->per_number($i); ?></td>
                                                        <td><?php $h_id2 = $cost->get_headlines_name($row['h_id']); echo $prime->per_number($h_id2); ?></td>
                                                        <td><?php echo $prime->per_number(number_format($row['c_price'])); ?></td>
														<td><?php echo $prime->per_number($row['c_date']); ?></td>
														<td><?php echo $prime->per_number($row['c_time']); ?></td>
														<td><?php $ba_id2 = $cost->get_bank_name($row['ba_id']); echo $prime->per_number($ba_id2); ?></td>
														<td><?php echo $prime->per_number($row['c_details']); ?></td>
                                                        <td>
                                                            <form action="" method="post">
                                                                <button onclick="if(!confirm('آیا از انجام این عملیات اطمینان دارید؟')){return false;}" name="del-item" value="<?php echo $row['c_id']; ?>" class="btn btn-danger btn-sm">حذف</button>
                                                                <button name="edit-item-table" value="<?php echo $row['c_id']; ?>" class="btn btn-info btn-sm">ویرایش</button>
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