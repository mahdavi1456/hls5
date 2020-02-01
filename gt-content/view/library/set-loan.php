<?php include"../../../header.php"; ?>
</head>
    <body class="hold-transition sidebar-mini <?php $opt = new option(); $opt->check_push(); ?>">
<div class="wrapper">
    <?php include"../../../nav.php"; include"../../../menu.php"; ?>

    <div class="content-wrapper">
        <br>
		<div class="col-md-12">
		<?php
		$db = new database();
		$pr = new prime();
		$aru = new aru();
        $per = new person();
		$book = new book();
		
		if(isset($_POST['set-item'])) {
			$p_id = $_POST['p_id'];
			$b_id = $_POST['b_id'];
			$l_fromdate = $_POST['l_fromdate'];
			$l_fromdetails = $_POST['l_fromdetails'];
			$l_todate = $_POST['l_todate'];
			$l_todetails = $_POST['l_todetails'];
			$l_enddate = $_POST['l_enddate'];
			$sql = "insert into loan(p_id, b_id, l_fromdate, l_fromdetails, l_todate, l_todetails, l_enddate) values($p_id, $b_id, '$l_fromdate', '$l_fromdetails', '$l_todate', '$l_todetails', '$l_enddate')";
			$db->ex_query($sql);
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

		if(isset($_POST['del-item'])){
			$l_id = $_POST['del-item'];
			$db->ex_query("delete from loan where l_id = $l_id");
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
		
		if(isset($_POST['set-back'])){
			$l_id = $_POST['l_id'];
			$l_todate = $_POST['l_todate'];
			$l_todetails = $_POST['l_todetails'];
			$db->ex_query("update loan set l_todate = '$l_todate', l_todetails = '$l_todetails' where l_id = $l_id");
			?><br>
			<div class="alert alert-success">
				ثبت بازگشت با موفقیت انجام شد
			</div>
			<script type="text/javascript">
				window.location.reload();
				return;
			</script>
			<?php
		}
		?>
		</div>
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">مدیریت کتب</h3>
                        </div>
                        <div class="card-body">
							<form method="post" action="" class="form">
								<div class="row">
									<div class="col-md-2 col-sm-6">
										<label>نام شخص <span class="red">*</span></label>
										<select name="p_id" class="form-control select2">
										<?php
										$list = $db->get_select_query("select p_id, p_name, p_family from person");
										if(count($list) > 0) {
											foreach($list as $l) {
												?>
												<option value="<?php echo $l['p_id']; ?>"><?php echo $l['p_name'] . " " . $l['p_family']; ?></option>
												<?php
											}
										}
										?>
										</select>
									</div>
									<div class="col-md-2 col-sm-6">
										<label>نام کتاب <span class="red">*</span></label>
										<select name="b_id" class="form-control select2">
										<?php
										$list = $db->get_select_query("select b_id, b_name from book");
										if(count($list) > 0) {
											foreach($list as $l) {
												?>
												<option value="<?php echo $l['b_id']; ?>"><?php echo $l['b_name']; ?></option>
												<?php
											}
										}
										?>
										</select>
									</div>
									<div class="col-md-2 col-sm-6">
										<label>تاریخ امانت <span class="red">*</span></label>
										<input name="l_fromdate" class="form-control datepicker pdp-el" type="text" placeholder="تاریخ امانت..." autocomplete="off">
									</div>
									<div class="col-md-4 col-sm-6">
										<label>توضیحات</label>
										<input name="l_fromdetails" class="form-control" type="text" placeholder="توضیحات...">
									</div>
									<div class="col-md-2 col-sm-6">
										<label>تاریخ تحویل <span class="red">*</span></label>
										<input name="l_enddate" class="form-control datepicker pdp-el" type="text" placeholder="تاریخ تحویل..." autocomplete="off">
									</div>
								</div><br>
								<div class="row">
									<div class="col-md-12 text-center">
										<?php
										if(isset($_POST['edit-item-table'])){ ?>
										<button value="<?php echo $_POST['edit-item-table']; ?>" name="edit-item" class="btn btn-warning btn-lg">ویرایش اطلاعات</button>
										<?php
										} else { ?>
										<button name="set-item" class="btn btn-success btn-lg">ثبت اطلاعات</button>
										<?php
										} ?>
									</div>
								</div>	
							</form>
                            <hr>
                            <div class="row">
                                <div class="panel panel-success table-responsive">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">جدول کتب</h4>
                                    </div>
									<table class="table table-striped">
										<tr>
											<th>ردیف</th>
											<th>نام شخص</th>
											<th>نام کتاب</th>
											<th>تاریخ امانت</th>
											<th>توضیحات</th>
											<th>تاریخ تحویل</th>
											<th>تاریخ برگشت</th>
											<th>توضیحات</th>
											<th>مدیریت</th>
										</tr>
										<?php
										$i = 1;
										$res = $db->get_select_query("select * from loan");
										if(count($res) > 0) {
											foreach($res as $row) { ?>
											<tr>
												<td><?php echo $pr->per_number($i); ?></td>
												<td><?php echo $per->get_person_name($row['p_id']); ?></td>
												<td><?php echo $book->get_book_name($row['b_id']); ?></td>
												<td><?php echo $pr->per_number($row['l_fromdate']); ?></td>
												<td><?php echo $pr->per_number($row['l_fromdetails']); ?></td>
												<td><?php echo $pr->per_number($row['l_enddate']); ?></td>
												<td><?php echo $pr->per_number($row['l_todate']); ?></td>
												<td><?php echo $pr->per_number($row['l_todetails']); ?></td>
												<td>
													<form action="" method="post">
														<button onclick="if(!confirm('آیا از انجام این عملیات اطمینان دارید؟')){return false;}" name="del-item" value="<?php echo $row['l_id']; ?>" class="btn btn-danger btn-sm">حذف</button>
														<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal<?php echo $row['l_id']; ?>">ثبت برگشت</button>
														<div id="myModal<?php echo $row['l_id']; ?>" class="modal fade" role="dialog">
															<div class="modal-dialog">
																<div class="modal-content">
																	<div class="modal-header">
																		<button type="button" class="close" data-dismiss="modal">&times;</button>
																		<h4 class="modal-title">ثبت بازگشت</h4>
																	</div>
																	<div class="modal-body">
																		<input type="hidden" name="l_id" value="<?php echo $row['l_id']; ?>">
																		<label>تاریخ بازگشت <span class="red">*</span></label>
																		<input type="text" class="form-control datepicker" placeholder="تاریخ بازگشت" name="l_todate" autocomplete="off">
																		<br>
																		<label>توضیحات بازگشت</label>
																		<input type="text" class="form-control" placeholder="توضیحات بازگشت" name="l_todetails">
																		<br><button name="set-back" class="btn btn-info">ثبت بازگشت</button>
																	</div>
																	<div class="modal-footer">
																		<button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
																	</div>
																</div>
															</div>
														</div>
													</form>
												</td>
											</tr>
											<?php
											$i++;
											}
										} else { ?>
											<tr><td class="text-center" colspan="9">موردی جهت نمایش موجود نیست</td></tr>
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