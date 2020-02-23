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
                            <h3 class="card-title">مدیریت حساب های بانکی</h3>
                        </div>
                        <div class="card-body">
                            <form method="post" action="" class="form">
                                <?php
                                $db = new database();
                                $prime = new prime();
								$cost = new cost();
								
                                $ba_name = "";
                                $ba_code = "";
                                $ba_account_owner = "";
								$ba_account_number = "";
								$ba_branch_name = "";
								$ba_branch_number = "";
								$ba_account_type = "";
								$ba_initial_balance = "";
								$ba_shaba_number = "";

                                if(isset($_POST['edit-item-table'])){
                                    $ba_id = $_POST['edit-item-table'];
                                    $res = $db->get_select_query("select * from bank_account where ba_id = $ba_id");
                                    $ba_name = $res[0]['ba_name'];
                                    $ba_code = $res[0]['ba_code'];
                                    $ba_account_owner = $res[0]['ba_account_owner'];
									$ba_account_number = $res[0]['ba_account_number'];
									$ba_branch_name = $res[0]['ba_branch_name'];
									$ba_branch_number = $res[0]['ba_branch_number'];
									$ba_account_type = $res[0]['ba_account_type'];
									$ba_initial_balance = $res[0]['ba_initial_balance'];
									$ba_shaba_number = $res[0]['ba_shaba_number'];
                                }
                                ?>
                                <div class="row">
                                    <div class="col-md-4 col-sm-6">
                                        <label>نام بانک</label><span class="necessary"> *</span>
										<select class="form-control select2" name="ba_name" id="ba_name">
											<option value="ملی" <?php if($ba_name == "ملی") { echo 'selected'; } ?> >ملی</option>
											<option value="صادرات" <?php if($ba_name == "صادرات") { echo 'selected'; } ?>  >صادرات</option>
											<option value="کشاورزی" <?php if($ba_name == "کشاورزی") { echo 'selected'; } ?> >کشاورزی</option>
											<option value="تجارت" <?php if($ba_name == "تجارت") { echo 'selected'; } ?> >تجارت</option>
											<option value="مسکن" <?php if($ba_name == "مسکن") { echo 'selected'; } ?>  >مسکن</option>
											<option value="سپه" <?php if($ba_name == "سپه") { echo 'selected'; } ?>  >سپه</option>
											<option value="رفاه کارگران" <?php if($ba_name == "رفاه کارگران") { echo 'selected'; } ?>  >رفاه کارگران</option>
											<option value="صنعت و معدن" <?php if($ba_name == "صنعت و معدن") { echo 'selected'; } ?>  >صنعت و معدن</option>
											<option value="ملت" <?php if($ba_name == "ملت") { echo 'selected'; } ?> >ملت</option>
											<option value="اقتصاد نوین" <?php if($ba_name == "اقتصاد نوین") { echo 'selected'; } ?>  >اقتصاد نوین</option>
											<option value="توسعه تعاون شهر" <?php if($ba_name == "توسعه تعاون شهر") { echo 'selected'; } ?>  >توسعه تعاون شهر</option>
											<option value="دی" <?php if($ba_name == "دی") { echo 'selected'; } ?>  >دی</option>
											<option value="سینا" <?php if($ba_name == "سینا") { echo 'selected'; } ?>  >سینا</option>
											<option value="پارسیان" <?php if($ba_name == "پارسیان") { echo 'selected'; } ?>  >پارسیان</option>
											<option value="پاسارگاد" <?php if($ba_name == "پاسارگاد") { echo 'selected'; } ?>  >پاسارگاد</option>
											<option value="تات" <?php if($ba_name == "تات") { echo 'selected'; } ?>  >تات</option>
											<option value="قوامین" <?php if($ba_name == "قوامین") { echo 'selected'; } ?>  >قوامین</option>
											<option value="انصار" <?php if($ba_name == "انصار") { echo 'selected'; } ?>  >انصار</option>
											<option value="سرمایه" <?php if($ba_name == "سرمایه") { echo 'selected'; } ?>  >سرمایه</option>
											<option value="سامان" <?php if($ba_name == "سامان") { echo 'selected'; } ?>  >سامان</option>
											<option value="کارآفرین" <?php if($ba_name == "کارآفرین") { echo 'selected'; } ?>  >کارآفرین</option>
											<option value="گردشگری" <?php if($ba_name == "گردشگری") { echo 'selected'; } ?>  >گردشگری</option>
											<option value="رسالت" <?php if($ba_name == "رسالت") { echo 'selected'; } ?>  >رسالت</option>
										</select>
									</div>
                                    <div class="col-md-4 col-sm-6">
                                        <label>کد  بانک</label>
                                        <input name="ba_code" class="form-control" type="text" placeholder="کد بانک..." value="<?php echo $ba_code; ?>">
                                    </div>
									<div class="col-md-4 col-sm-6">
                                        <label>نام صاحب حساب</label><span class="necessary"> *</span>
                                        <input name="ba_account_owner" class="form-control" type="text" placeholder="نام صاحب حساب..." value="<?php echo $ba_account_owner; ?>" required>
                                    </div>
								</div><br>
								<div class="row">
									<div class="col-md-4 col-sm-6">
                                        <label>شماره حساب</label><span class="necessary"> *</span>
                                        <input name="ba_account_number" class="form-control" type="text" placeholder="شماره حساب..." value="<?php echo $ba_account_number; ?>" required>
                                    </div>
									<div class="col-md-4 col-sm-6">
                                        <label>نام شعبه</label><span class="necessary"> *</span>
                                        <input name="ba_branch_name" class="form-control" type="text" placeholder="نام شعبه..." value="<?php echo $ba_branch_name; ?>" required>
                                    </div>
									 <div class="col-md-4 col-sm-6">
                                        <label>شماره شعبه</label>
                                        <input name="ba_branch_number" class="form-control" type="text" placeholder="شماره شعبه..." value="<?php echo $ba_branch_number; ?>">
                                    </div>
								</div><br>
								<div class="row">
									<div class="col-md-4 col-sm-6">
                                        <label>نوع حساب</label><span class="necessary"> *</span>
                                        <select class="form-control" name="ba_account_type"  id="ba_account_type">
											<option value="جاری" <?php if($ba_account_type == "جاری") { echo 'selected'; } ?> >جاری</option>
											<option value="پس انداز" <?php if($ba_account_type == "پس انداز") { echo 'selected'; } ?> >پس انداز</option>
										</select>
                                    </div>
									<div class="col-md-4 col-sm-6">
                                        <label>موجودی اولیه </label><span class="necessary"> *</span>
									    <input name="ba_initial_balance" class="form-control" type="text" placeholder="موجودی اولیه..." value="<?php echo $ba_initial_balance; ?>" required>
									</div>
									<div class="col-md-4 col-sm-6">
                                        <label>شماره شبا</label><span class="necessary"> *</span>
                                        <input name="ba_shaba_number" class="form-control" type="text" placeholder="شماره شبا..." value="<?php echo $ba_shaba_number; ?>" required>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <?php
                                        if(isset($_POST['edit-item-table'])){ ?>
                                            <button value="<?php echo $_POST['edit-item-table']; ?>" name="update-bank" class="btn btn-warning">ویرایش اطلاعات</button>
                                            <?php
                                        } else {
                                            ?>
                                            <button name="add-bank" class="btn btn-success">ذخیره</button>
                                            <?php
                                        } ?>
                                    </div>
                                    <div class="col-md-12">
                                        <?php
										if(isset($_POST['add-bank'])) {
											$ba_name = $_POST['ba_name'];
											$ba_code = $_POST['ba_code'];
											$ba_account_owner = $_POST['ba_account_owner'];
											$ba_account_number = $_POST['ba_account_number'];
											$ba_branch_name = $_POST['ba_branch_name'];
											$ba_branch_number = $_POST['ba_branch_number'];
											$ba_account_type = $_POST['ba_account_type'];
											$ba_initial_balance = $_POST['ba_initial_balance'];
											$ba_shaba_number = $_POST['ba_shaba_number'];
											$db->ex_query("insert into bank_account(ba_name, ba_code, ba_account_owner, ba_account_number, ba_branch_name, ba_branch_number, ba_account_type, ba_initial_balance, ba_shaba_number) values('$ba_name', '$ba_code', '$ba_account_owner', '$ba_account_number', '$ba_branch_name', '$ba_branch_number', '$ba_account_type', $ba_initial_balance, '$ba_shaba_number')");
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

										
										if(isset($_POST['update-bank'])) {
											$ba_id = $_POST['update-bank'];
											$ba_name = $_POST['ba_name'];
											$ba_code = $_POST['ba_code'];
											$ba_account_owner = $_POST['ba_account_owner'];
											$ba_account_number = $_POST['ba_account_number'];
											$ba_branch_name = $_POST['ba_branch_name'];
											$ba_branch_number = $_POST['ba_branch_number'];
											$ba_account_type = $_POST['ba_account_type'];
											$ba_initial_balance = $_POST['ba_initial_balance'];
											$ba_shaba_number = $_POST['ba_shaba_number'];
											$db->ex_query("update bank_account set ba_name = '$ba_name', ba_code = '$ba_code', ba_account_owner = '$ba_account_owner', ba_account_number = '$ba_account_number', ba_branch_name = '$ba_branch_name', ba_branch_number = '$ba_branch_number', ba_account_type = '$ba_account_type', ba_initial_balance = $ba_initial_balance , ba_shaba_number = '$ba_shaba_number'  where ba_id = $ba_id");
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
                                            $ba_id = $_POST['del-item'];
                                            $db->ex_query("delete from bank_account where ba_id = $ba_id");
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
                                            <h4 class="panel-title">جدول حساب های بانکی</h4>
                                        </div></br>
                                        <table class="table table-striped">
                                            <tr>
												<th>ردیف</th>
												<th>نام بانک</th>
												<th>کد بانک</th>
												<th>شماره حساب</th>
												<th>نام صاحب حساب</th>
												<th>موجودی اولیه</th>
												<th>نام شعبه</th>
												<th>شماره شعبه</th>
												<th>نوع حساب</th>
												<th>شماره شبا</th>
												<th>مدیریت</th>
                                            </tr>
                                            <?php
                                            $i = 1;
                                            $res = $db->get_select_query("select * from bank_account");
                                            if(count($res)>0){
                                                foreach($res as $row) { ?>
                                                    <tr>
                                                        <td><?php echo $prime->per_number($i); ?></td>
														<td><?php echo $prime->per_number($row['ba_name']); ?></td>
														<td><?php echo $prime->per_number($row['ba_code']); ?></td>
														<td><?php echo $prime->per_number($row['ba_account_number']); ?></td>
														<td><?php echo $prime->per_number($row['ba_account_owner']); ?></td>
														<td><?php echo $prime->per_number(number_format($row['ba_initial_balance'])); ?></td>
														<td><?php echo $prime->per_number($row['ba_branch_name']); ?></td>
														<td><?php echo $prime->per_number($row['ba_branch_number']); ?></td>
														<td><?php echo $prime->per_number($row['ba_account_type']); ?></td>
														<td><?php echo $prime->per_number($row['ba_shaba_number']); ?></td>
                                                        <td>
                                                            <form action="" method="post">
                                                                <button onclick="if(!confirm('آیا از انجام این عملیات اطمینان دارید؟')){return false;}" name="del-item" value="<?php echo $row['ba_id']; ?>" class="btn btn-danger btn-sm">حذف</button>
                                                                <button name="edit-item-table" value="<?php echo $row['ba_id']; ?>" class="btn btn-info btn-sm">ویرایش</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $i++;
                                                }
                                            } else { ?>
                                                <tr><td class="text-center" colspan="11">موردی جهت نمایش موجود نیست</td></tr>
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