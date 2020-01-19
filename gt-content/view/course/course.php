<?php include"../../../header.php"; ?>
</head>
    <body class="hold-transition sidebar-mini">
<div class="wrapper">
    <?php include"../../../nav.php"; include"../../../menu.php"; ?>

    <div class="content-wrapper">
        <br>
		<div class="col-md-12">
		<?php $aru = new aru();
        if(isset($_POST['add-course'])){
            $aru->add("course", $_POST);
        }
        if(isset($_POST['del-course'])){
            $c_id = $_POST['del-course'];
            $aru->remove("course", "c_id", $c_id, "int");
        }
        if(isset($_POST['update-course'])){
            $c_id = $_GET['edit-course'];
            $aru->update("course", $_POST, "c_id", $c_id);
        }
        if(isset($_GET['edit-course'])){
            $eu = $_GET['edit-course'];
        } else {
            $eu = 0;
        }
		
		if(isset($_POST['add-course_cost'])){
            $aru->add("course_cost", $_POST);
        }
        if(isset($_POST['del-course_cost'])){
            $cc_id = $_POST['del-course_cost'];
            $aru->remove("course_cost", "cc_id", $cc_id, "int");
        }
		
		if(isset($_POST['del-course_ticket'])){
            $ct_id = $_POST['del-course_ticket'];
            $aru->remove("course_ticket", "ct_id", $ct_id, "int");
		}
        ?>
		</div>
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">کارگاه ها</h3>
                        </div>
                        <div class="card-body">
                            <form method="post" class="form">
                                <?php
                                $db = new database();
                                $prime = new prime();
								$user = new user();
                                ?>
                                <div class="row">
                                    <div class="col-md-3 col-sm-6">
                                        <label>نام کارگاه <span class="red">*</span></label>
                                        <input name="c_name" class="form-control" type="text" placeholder="نام کارگاه..." value="<?php echo $aru->field_for_edit("course", "c_name", "c_id", $eu); ?>">
                                    </div>
                                    <div class="col-md-3 col-sm-6">
                                        <label>ظرفیت <span class="red">*</span></label>
                                        <input name="c_capacity" class="form-control" type="text" placeholder="ظرفیت..." value="<?php echo $aru->field_for_edit("course", "c_capacity", "c_id", $eu); ?>">
                                    </div>
                                    <div class="col-md-3 col-sm-6">
                                        <label>تاریخ <span class="red">*</span></label>
                                        <input name="c_date" autocomplete="off" class="form-control datepicker pdp-el" type="text" placeholder="تاریخ..." value="<?php echo $aru->field_for_edit("course", "c_date", "c_id", $eu); ?>">
                                    </div>
                                    <div class="col-md-3 col-sm-6">
                                        <label>مبلغ <span class="red">*</span></label>
                                        <input name="c_fee" class="form-control" type="text" placeholder="مبلغ..." value="<?php echo $aru->field_for_edit("course", "c_fee", "c_id", $eu); ?>">
                                    </div>
								</div><br>
								<div class="row">
									<div class="col-md-3 col-sm-6">
                                        <label>مربی <span class="red">*</span></label>
                                        <select name="t_id" class="form-control">
											<option value="0">-</option>
											<?php $users = $db->get_select_query("select * from user");
											$t_id = $aru->field_for_edit("course", "t_id", "c_id", $eu);
											if(count($users) > 0) {
												foreach($users as $user) {
													?>
													<option <?php if($user['u_id'] == $t_id) echo "selected"; ?> value="<?php echo $user['u_id']; ?>"><?php echo $user['u_name'] . " " . $user['u_family']; ?></option>
													<?php
												}
											}
											?>
										</select>
                                    </div>
									<div class="col-md-9">
										<label>توضیحات</label>
										<textarea name="c_details" class="form-control" placeholder="توضیحات" value="<?php echo $aru->field_for_edit("course", "c_details", "c_id", $eu); ?>"><?php echo $aru->field_for_edit("course", "c_details", "c_id", $eu); ?></textarea>
									</div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <?php
                                        if(isset($_GET['edit-course'])){ ?>
                                            <button name="update-course" value="<?php echo $_GET['edit-course']; ?>" class="btn btn-warning btn-lg">ویرایش اطلاعات</button>
                                            <a class="btn btn-danger btn-lg" href="<?php echo VIEW_URL(); ?>course/course.php">انصراف از ویرایش</a>
                                            <?php
                                        } else { ?>
                                            <button name="add-course" class="btn btn-success">ثبت اطلاعات</button>
                                            <?php
                                        } ?>
                                    </div>
                                </div>
                            </form>
                            <hr>
                            <div class="row">
                                    <div class="panel panel-success table-responsive">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">جدول کارگاه ها</h4>
                                        </div>
                                        <table class="table table-striped">
                                            <tr>
                                                <th>ردیف</th>
                                                <th>نام</th>
                                                <th>ظرفیت</th>
                                                <th>تاریخ</th>
                                                <th>مبلغ</th>
                                                <th>مربی</th>
												<th>توضیحات</th>
												<th>عملیات</th>
											</tr>
                                            <?php
                                            $i = 1;
                                            $res = $db->get_select_query("select * from course order by c_id desc");
                                            if(count($res)>0){
                                                foreach($res as $row) { ?>
                                                    <tr>
                                                        <td><?php echo $prime->per_number($i); ?></td>
                                                        <td><?php echo $row['c_name']; ?></td>
                                                        <td><?php echo $prime->per_number($row['c_capacity']); ?></td>
                                                        <td><?php echo $prime->per_number($row['c_date']); ?></td>
                                                        <td><?php echo $prime->per_number(number_format($row['c_fee'])); ?></td>
                                                        <td><?php //echo $user->get_user_name($row['t_id']) . " " . $user->get_user_family($row['t_id']); ?></td>
														<td><?php echo $prime->per_number($row['c_details']); ?></td>
														<td>
															<form class="miniform" action="" method="post" style="display: inline-block">
																<button name="del-course" onclick="if(!confirm('آیا از انجام این عملیات اطمینان دارید؟')){return false;}" value="<?php echo $row['c_id']; ?>" class="btn btn-danger btn-sm">حذف</button>
															</form>
															<form class="miniform" action="" method="get" style="display: inline-block">
																<button name="edit-course" value="<?php echo $row['c_id']; ?>" class="btn btn-info btn-sm">ویرایش</button>
															</form>
															
															<button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#myModal<?php echo $row['c_id']; ?>">ثبت هزینه</button>
															<div id="myModal<?php echo $row['c_id']; ?>" class="modal fade" role="dialog">
																<div class="modal-dialog">
																	<div class="modal-content">
																		<div class="modal-header">
																			<button type="button" class="close" data-dismiss="modal">&times;</button>
																			<label class="modal-title">ثبت هزینه</label>
																		</div>
																		<div class="modal-body text-center">
																			<form action="" method="post">
																				<div class="row">
																					<div class="col-md-6">
																						<label>مبلغ</label>
																						<input name="cc_price" type="text" class="form-control" placeholder="مبلغ...">
																					</div>
																					<div class="col-md-6">
																						<label>توضیحات</label>
																						<input name="cc_details" type="text" class="form-control" placeholder="توضیحات...">
																					</div>
																				</div><br>
																				<div class="row">
																					<div class="col-md-12">
																						<button class="btn btn-success" name="add-course_cost">ثبت هزینه</button>
																					</div>
																				</div>
																				<input type="hidden" name="c_id" value="<?php echo $row['c_id']; ?>">
																				<input type="hidden" name="cc_date" value="<?php echo jdate('Y/m/d'); ?>">
																			</form>
																			<hr>
																			<table class="table table-bordered">
																				<?php
																				$k = 1;
																				$c_id = $row['c_id'];
																				$total_cost = 0;
																				$list = $db->get_select_query("select * from course_cost where c_id = $c_id");	
																				if(count($list) > 0) {
																					?>
																					<tr>
																						<th>ردیف</th>
																						<th>مبلغ</th>
																						<th>توضیحات</th>
																						<th>تاریخ</th>
																						<th>عملیات</th>
																					</tr>
																					<?php
																					foreach($list as $l) {
																						?>
																						<tr>
																							<td><?php echo $k; ?></td>
																							<td><?php echo number_format($l['cc_price']); ?></td>
																							<td><?php echo $l['cc_details']; ?></td>
																							<td><?php echo $l['cc_date']; ?></td>
																							<td><form action="" method="post"><button type="submit" onclick="if(!confirm('آیا از انجام این عملیات اطمینان دارید؟')){return false;}" class="btn btn-danger btn-sm" name="del-course_cost" value="<?php echo $l['cc_id']; ?>">حذف</button></form></td>
																						</tr>
																						<?php
																						$total_cost += $l['cc_price'];
																					}
																					?>
																					<tr><th colspan="6">جمع هزینه ها: <?php echo number_format($total_cost); ?></th></tr>
																					<?php
																				} else {
																					?>
																					<tr><td colspan="5">هیچ هزینه ای برای این کارگاه ثبت نشده است</td></tr>
																					<?php
																				}
																				?>
																			</table>
																		</div>
																		<div class="modal-footer">
																			<button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
																		</div>
																	</div>
																</div>
															</div>
															
															<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#regModal<?php echo $row['c_id']; ?>">لیست ثبت نام</button>
															<div id="regModal<?php echo $row['c_id']; ?>" class="modal fade" role="dialog">
																<div class="modal-dialog">
																	<div class="modal-content">
																		<div class="modal-header">
																			<button type="button" class="close" data-dismiss="modal">&times;</button>
																			<label class="modal-title">لیست ثبت نام</label>
																		</div>
																		<div class="modal-body text-center">
																			<table class="table table-bordered">
																				<?php
																				$j = 1;
																				$c_id = $row['c_id'];
																				$total_nums = 0;
																				$total_price = 0;
																				$reg_list = $db->get_select_query("select * from course_ticket where c_id = $c_id order by ct_id desc");	
																				if(count($reg_list) > 0) {
																					?>
																					<tr>
																						<th>ردیف</th>
																						<th>نام</th>
																						<th>مبلغ</th>
																						<th>تعداد</th>
																						<th>تاریخ خرید</th>
																						<th>عملیات</th>
																					</tr>
																					<?php
																					foreach($reg_list as $rl) {
																						?>
																						<tr>
																							<td><?php echo $j; ?></td>
																							<td><?php echo $rl['ct_name']; ?></td>
																							<td><?php echo number_format($rl['ct_price']); ?></td>
																							<td><?php echo $rl['ct_num']; ?></td>
																							<td><?php echo $rl['ct_date']; ?></td>
																							<td><form action="" method="post"><button type="submit" onclick="if(!confirm('آیا از انجام این عملیات اطمینان دارید؟')){return false;}" class="btn btn-danger btn-sm" name="del-course_ticket" value="<?php echo $rl['ct_id']; ?>">حذف</button></form></td>
																						</tr>
																						<?php
																						$total_nums += $rl['ct_num'];
																						$total_price += $rl['ct_price'];
																					}
																					?>
																					<tr><th colspan="6">جمع تعداد: <?php echo $total_nums; ?> جمع مبلغ: <?php echo number_format($total_price); ?></th></tr>
																					<?php
																				} else {
																					?>
																					<tr><td colspan="6">لیست ثبت نام این کارگاه خالی است</td></tr>
																					<?php
																				}
																				?>
																			</table>
																		</div>
																		<div class="modal-footer">
																			<button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
																		</div>
																	</div>
																</div>
															</div>
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