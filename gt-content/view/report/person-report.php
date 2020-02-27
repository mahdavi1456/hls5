<?php include"../../../header.php"; 
 $db = new database(); 
 $report = new report();
  $gd = new gdate();
	?>
</head>
<body class="hold-transition sidebar-mini <?php $opt = new option(); $opt->check_push(); ?>">
<div class="wrapper">
	<?php 
	include "../../../nav.php"; include"../../../menu.php"; 
	$person = new person();
	$pr = new prime();?>
	<div class="content-wrapper">
		<br>
		<div class="col-md-12">
		<?php
		if(isset($_POST['set_sharj'])){
			$p_id = $_POST['p_id'];
			$p_pack = $_POST['p_pack'];
			
			$last_expire = $db->get_var_query("select p_expire from person where p_id = $p_id");
			$last_sharj = $db->get_var_query("select p_sharj from person where p_id = $p_id");
			
			$now = jdate('Y/m/d');
				
			$db->ex_query("update person set p_pack = $p_pack where p_id = $p_id");
				
			if(isset($_POST['p_expire']) && $_POST['p_expire']!=""){
				$p_expire = $gd->add_to_datee($now, $_POST['p_expire']);
				$db->ex_query("update person set p_expire = '$p_expire' where p_id = $p_id");
			}
			
			if(isset($_POST['p_sharj']) && $_POST['p_sharj']!=""){
				$ps = $_POST['p_sharj'];
				$db->ex_query("update person set p_sharj = $ps where p_id = $p_id");				
			}
				
			if(isset($_POST['pa_price']) && $_POST['pa_price']!="" && isset($_POST['pa_type']) && $_POST['pa_type']!=""){
				$u_id = $_SESSION['user_id'];
				$pa_date = jdate('Y/m/d');
				$pa_details = $_POST['p_sharj'] . " دقیقه شارژ و " . $_POST['p_expire'] . " روز اعتبار";
				$pa_price = $_POST['pa_price'];
				$pa_type = $_POST['pa_type'];
				$pa_status = 1;
				$db->ex_query("insert into payment(p_id, pa_price, pa_date, pa_details, pa_type, u_id) values($p_id, '$pa_price', '$pa_date', '$pa_details', '$pa_type', $u_id) ");
			}
			?><br>
			<div class="alert alert-success">
				حساب کاربری شخص مورد نظر با موفقیت شارژ شد
			</div>
			<script type="text/javascript">
				window.location.reload();
				return;
			</script>
			<?php
		}
		
		if(isset($_POST['add_payment'])) {
			$pa = new payment();			
			$p_id = $_POST['p_id'];
			$pa_price = $_POST['pa_price'];
			$pa_details = $_POST['pa_details'];
			$pa_type = $_POST['pa_type'];
			$sql = $pa->add_payment($p_id, $pa_price, $pa_details, $pa_type);
			?><br>
			<div class="alert alert-success">
				پرداخت با موفقیت ثبت شد
			</div>
			<script type="text/javascript">
				window.location.reload();
				return;
			</script>
			<?php
		}
		
		if(isset($_POST['edit_sharj1'])){
			$p_sharj_new = 0;
			$p_id = $_POST['p_id'];
			$p_sharj1 = $_POST['p_sharj1'];
			$p_sharj2 = $_POST['p_sharj2'];
			$p_expire = $_POST['p_expire'];
			
			$ps = ($p_sharj1 * 60) + $p_sharj2;
			$p_sharj_old = $db->get_var_query("select p_sharj from person where p_id = $p_id");
			$p_sharj_new = $ps + $p_sharj_old;
			$db->ex_query("update person set p_sharj = $p_sharj_new ,  p_expire = '$p_expire' where p_id = $p_id");				
			
			?><br>
			<div class="alert alert-success">
				شارژ با موفقیت ثبت شد
			</div>
			<script type="text/javascript">
				window.location.reload();
				return;
			</script>
			<?php
		}
		if(isset($_POST['edit_sharj2'])){
			$p_sharj_new = 0;
			$p_id = $_POST['p_id'];
			$p_sharj1 = $_POST['p_sharj1'];
			$p_sharj2 = $_POST['p_sharj2'];
			$p_expire = $_POST['p_expire'];
			
			$ps = ($p_sharj1 * 60) + $p_sharj2;
			$p_sharj_old = $db->get_var_query("select p_sharj from person where p_id = $p_id");
			$p_sharj_new = $p_sharj_old - $ps;
			$db->ex_query("update person set p_sharj = $p_sharj_new ,  p_expire = '$p_expire' where p_id = $p_id");				
			
			?><br>
			<div class="alert alert-success">
				شارژ با موفقیت ثبت شد
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
							<h3 class="card-title">گزارش حساب اشخاص</h3>
							<div class="card-tools">
								<form action="" method="get">
									<div class="input-group input-group-sm">
										<div id="login-p-name-container" class="col-md-9 text-center">
											<!--select id="p_id" name="p_id" class="form-control select2">
												<?php
												/*$res = $db->get_select_query("select p_id, p_name, p_family from person");
												if(count($res) > 0) {
													foreach($res as $row) {
														?>
														<option value="<?php echo $row['p_id']; ?>" <?php if(isset($_GET['p_id']) && $_GET['p_id'] == $row['p_id']) { echo 'selected'; } ?> ><?php echo $row['p_name'] . " " . $row['p_family']; ?></option>
														<?php
													}
												}*/
												?>
											</select-->
											<input type="text" placeholder="سه حرف اول فامیل..." autocomplete="off" id="p_family" class="form-control" style="width: 100%">
											<div class="family-search-result"></div>
											<input type="hidden" id="p_id" name="p_id">
										</div>
										<div class="input-group-append">
											<button name="search" type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
										</div>
									</div>
								</form>
							</div>
						</div><br>
						<?php
						if(isset($_GET['p_id'])) { 
						$status = $person->get_person_status($_GET['p_id']); 
						$p_id = $_GET['p_id']; ?>
							<div class="row">
								
								<div class="col-3 text-center">
									<b>وضعیت: </b><b <?php if($status < 0) {  ?> class="text-danger" <?php } else { ?> class="text-success" <?php } ?>><?php  $d = $pr->per_number(number_format($status)); echo $d; ?></b>
								</div>
								<div class="col-8 text-right">
									<button data-toggle="modal" type="button" class="btn btn-success btn-lg" data-p_id="<?php echo $p_id; ?>" data-target="#pay_modal<?php echo $p_id; ?>">پرداخت</button>
									<button data-toggle="modal" type="button" class="btn btn-primary btn-lg load-set-card" data-p_id="<?php echo $p_id; ?>" data-target="#cardModal<?php echo $p_id; ?>">شارژ اشتراک</button>
									<button data-toggle="modal" type="button" class="btn btn-warning btn-lg" data-p_id="<?php echo $p_id; ?>" data-target="#edit_Modal<?php echo $p_id; ?>">ویرایش شارژ</button>
								</div>
							</div>
							<?php
						} ?>
					   
						</br>
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-header bg-info">
										<h3 class="card-title">گزارش ورود</h3>
									</div>
									<div class="card-body p-0">
										<div class="card-body table-responsive p-0">
											<?php echo $report->table_fullday(2); ?>
										</div>
									</div>
									<div class="card-footer">
										
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-6">
								<div class="card">
									<div class="card-header bg-success">
										<h3 class="card-title">گزارش مالی</h3>
									</div>
									<div class="card-body p-0">
										<div class="card-body table-responsive p-0">
											<?php
											echo $report->table_fullpay(2); ?>
										</div>
									</div>
								</div>
							</div>
							<div class="col-6">
								<div class="card">
									<div class="card-header bg-warning">
										<h3 class="card-title">گزارش فاکتور</h3>
									</div>
									<div class="card-body p-0">
										<div class="card-body table-responsive p-0">
											<?php echo $report->table_fullfactor('2'); ?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div id="cardModal<?php echo $p_id; ?>" class="modal fade" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<label class="modal-title">شارژ اشتراک</label>
									</div>
									<div class="modal-body text-center">
										<form action="" method="post">
											<div class="row">
											<?php
											$sharj = $db->get_var_query("select p_sharj from person where p_id = $p_id");
											$expire = $db->get_var_query("select p_expire from person where p_id = $p_id");
											$pack = $db->get_var_query("select p_pack from person where p_id = $p_id");
											if($pack==0)
												$pack_name = "آزاد";
											else
												$pack_name = $db->get_var_query("select pk_name from package where pk_id = $pack");
											?>
												<div class="col-md-3">
													<div class="alert alert-warning"><h4 style="margin: 0">شارژ: <?php echo $pr->per_number($gd->convert_time($sharj)); ?></h4></div>
												</div>
												<div class="col-md-5">
													<div class="alert alert-warning"><h4 style="margin: 0">اعتبار: <?php echo $pr->per_number(str_replace("-", "/", $expire)); ?></h4></div>
												</div>
												<div class="col-md-4">
													<div class="alert alert-warning">
														<h4 style="margin: 0">
														<?php echo $pr->per_number($pack_name); ?>
														<select name="p_pack" class="form-control pk_id" data-id="<?php echo $p_id; ?>">
															<option value="0" selected>انتخاب بسته</option>
															<?php
															$res2 = $db->get_select_query("select * from package");
															if(count($res2)) {
																foreach($res2 as $row2) {
																?>
																<option <?php if($row2['pk_id']==$pack){ echo "selected"; } ?> value="<?php echo $row2['pk_id']; ?>"><?php echo $row2['pk_name']; ?></option>
																<?php
																}	
															}
															?>
														</select>
														</h4>
													</div>
												</div>
											</div>
											<div class="row">	
												<div class="col-md-4">
													<label>میزان دقیقه</label>
													<input id="bp_time<?php echo $p_id; ?>" name="p_sharj" type="text" class="form-control" placeholder="میزان دقیقه">
												</div>
												<div class="col-md-4">
													<label>مدت اعتبار</label>
													<input id="bp_expire<?php echo $p_id; ?>" name="p_expire" type="text" class="form-control" placeholder="مدت اعتبار">
												</div>
												<div class="col-md-4">
													<label>مبلغ</label>
													<input id="bp_price<?php echo $p_id; ?>" name="pa_price" type="text" class="form-control" placeholder="مبلغ">
												</div>
												<input type="hidden" name="pa_type" value="فاکتور سیستم">
												<input type="hidden" name="p_id" value="<?php echo $p_id; ?>">
											</div>
											<br>	
											<div class="row">
												<div class="col-md-12">
													<button name="set_sharj" class="btn btn-success btn-lg">
														<span class="glyphicon glyphicon-ok"></span> شارژ اشتراک
													</button>
												</div>
											</div>
										</form>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-danger" data-dismiss="modal">بستن</button>
									</div>
								</div>
							</div>
						</div>
						<div id="pay_modal<?php echo $p_id; ?>" class="modal fade" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<label class="modal-title">پرداخت بدهی</label>
									</div>
									<div class="modal-body text-center">
										<form action="" method="post">
											<div class="row">
												<input type="hidden" name="p_id" value="<?php echo $p_id; ?>">
												<div class="col-md-6">
													<label>نوع پرداخت</label>
													<select name="pa_type" class="form-control">
														<option value="کارت">کارت</option>
														<option value="نقد">نقد</option>
													</select>
												</div>
												<div class="col-md-6">
													<label>مبلغ</label>
													<input type="text" class="form-control" name="pa_price">
												</div>
											</div><br>
											<div class="row">
												<div class="col-md-12">
													<label>توضیحات</label>
													<input type="text" class="form-control" name="pa_details">
												</div>
											</div> <br>	
											<div class="col-12">
												<div class="row">
													<div class="col-md-12">
														<button name="add_payment" class="btn btn-success btn-lg">
															<span class="glyphicon glyphicon-ok"></span> ثبت پرداخت
														</button>
													</div>
												</div>
											</div>
										</form>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-danger" data-dismiss="modal">بستن</button>
									</div>
								</div>
							</div>
						</div>
						<div id="edit_Modal<?php echo $p_id; ?>" class="modal fade" role="dialog">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<label class="modal-title">ویرایش شارژ</label>
									</div>
									<div class="modal-body text-center">
										<form action="" method="post">
											<div class="row">
											<?php
											$sharj = $db->get_var_query("select p_sharj from person where p_id = $p_id");
											$expire = $db->get_var_query("select p_expire from person where p_id = $p_id");
											$pack = $db->get_var_query("select p_pack from person where p_id = $p_id");
											$db = new database();
											if($pack != 0){
												$pack_name = $db->get_var_query("select pk_name from package where pk_id = $pack");
												$res = $db->get_select_query("select * from package where pk_id = $pack");
												$pk_price = $res[0]['pk_price'];
											}
											else {
												$pk_price = "";
												$pack_name = "آزاد";
											}
											$hour = floor($sharj / 60);
											$minute = $sharj % 60;
											?>
												
														
												<div class="col-md-4">
													<label> نام بسته : </label>
													<div class="alert alert-warning"><h5 style="margin: 0"><?php echo $pr->per_number($pack_name); ?></h5></div>
												</div>
												
												<div class="col-md-4">
														<label> شارژ فعلی :</label>
														<div class="alert alert-warning"><h5 style="margin: 0"><?php if($hour < 10){ $hour1 = '0' . $hour; } else { $hour1 = $hour; } if($minute < 10){ $minute1 = '0' . $minute; } else { $minute1 = $minute; } echo $pr->per_number($hour1) . ":" . $pr->per_number($minute1); ?></h5></div>
												</div>
												<div class="col-md-4">
														<label> اعتبار فعلی :</label>
														<div class="alert alert-warning"><h5 style="margin: 0"><?php   echo str_replace("-", "/", $expire); ?></h5></div>
												</div>
											</div> <br>
											<div class="row">	
												<div class="col-md-4">
													<label>دقیقه</label>
													<select name="p_sharj2" class="form-control select2" style="width:100%;" >
														<?php
															for($k=0 ; $k < 61 ; $k++) { ?>
																<option value="<?php echo $k; ?>"><?php if($k < 10){ echo '0' . $k; } else { echo $k; }  ?></option>
																<?php
															}
														?>
													</select>
												</div>
												<div class="col-md-4">
													<label>ساعت</label>
													<select name="p_sharj1" class="form-control select2" style="width:100%;">
														<?php
															for($p=0 ; $p <= 60 ; $p++) { ?>
																<option value="<?php  echo $p;  ?>" ><?php if($p < 10){ echo '0' . $p; } else { echo $p; }  ?></option>
																<?php
															}
														?>
													</select>
												</div>
												<div class="col-md-4">
													<label>مدت اعتبار</label>
													<input name="p_expire" type="text" class="form-control" placeholder="مدت اعتبار" value="<?php echo str_replace("-", "/", $expire); ?>">
												</div>
												<input type="hidden" name="p_id" value="<?php echo $p_id; ?>">
											</div>
											<br>	
											<div class="row">
												<div class="col-md-6 text-left">
													<button name="edit_sharj1" class="btn btn-success btn-lg">
														<span class="glyphicon glyphicon-ok"></span> +
													</button>
												</div>
												<div class="col-md-6 text-right">
													<button name="edit_sharj2" class="btn btn-success btn-lg">
														<span class="glyphicon glyphicon-ok"></span> -
													</button>
												</div>
											</div>
										</form>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-danger" data-dismiss="modal">بستن</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
</div>
<?php include"../../../footer.php"; ?>