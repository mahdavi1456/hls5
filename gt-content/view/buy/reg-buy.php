<?php include"../../../header.php"; ?>
</head>
    <body class="hold-transition sidebar-mini <?php $opt = new option(); $opt->check_push(); ?>">
<div class="wrapper">
    <?php include"../../../nav.php"; include"../../../menu.php"; ?>
	 <?php
		$db = new database();
		$prime = new prime();
		$cost = new cost();
		$product = new product();

		if(isset($_POST['add-factor'])){
			$p_id = $_POST['p_id'];
			$f_date = $_POST['f_date'];
			$u_id = $_POST['u_id'];
			$f_VAT_status = $_POST['f_VAT_status'];
			$f_payment = $_POST['f_payment'];
			$f_id = $db->ex_query("insert into factor_buy(p_id, f_date, u_id, f_VAT_status, f_payment) values($p_id, '$f_date', $u_id, $f_VAT_status, '$f_payment')");
			$url = VIEW_URL . "buy/reg-buy.php?f_id=" . $f_id;
			?>
			<script type="text/javascript">
				window.location.href = "<?php echo $url; ?>";
			</script>
			<?php
		}
		
		if(isset($_GET['f_id'])){
			$f_id = $_GET['f_id'];
			$sql1 = "select * from factor_buy where f_id = $f_id";
			$res1 = $db->get_select_query($sql1);
			if(count($res1) > 0){
				$f_VAT_status = $res1[0]['f_VAT_status'];
				$p_id = $res1[0]['p_id'];
				$f_date = $res1[0]['f_date'];
				$f_payment = $res1[0]['f_payment'];
			}
		} else {
			$f_payment = "";
			$f_VAT_status = "";
			$p_id = "";
			$f_date = "";
			$st_id_to = "";
		}
		
		
		if(isset($_GET['fb_id'])){
			$f_id = $_GET['f_id'];
			$fb_id = $_GET['fb_id'];
			$sql1 = "select * from factor_buy_body where f_id = $f_id and fb_id = $fb_id";
			$res1 = $db->get_select_query($sql1);
			if(count($res1) > 0){
				$pr_id = $res1[0]['pr_id'];
				$fb_quantity = $res1[0]['fb_quantity'];
				$fb_price = $res1[0]['fb_price'];
				$total_price = $res1[0]['total_price'];
				$fb_discount = $res1[0]['fb_discount'];
				$fb_details = $res1[0]['fb_details'];
				$ba_id = $res1[0]['ba_id'];
			}
		} else {
			$pr_id = "";
			$fb_quantity = "";
			$fb_price = "";
			$total_price ="";
			$fb_discount = "";
			$fb_details = "";
			$ba_id = "";
		}
		?>
    <div class="content-wrapper">
        <br>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">ثبت فاکتور خرید</h3>
                        </div>
                        <div class="card-body">
                            <form method="post" action="" class="form">
                                <div class="row">
									<input type="hidden" name="u_id" value="<?php echo $_SESSION['user_id']; ?>">
                                    <div class="col-md-3 col-sm-6">
                                        <label>نام تامین کننده</label>
										<select class="form-control" name="p_id" id="p_id">
											<?php
											$res = 0;
											$res = $db->get_select_query("select * from person where p_type= 'تامین کننده' ");
											if(count($res) > 0){
												foreach($res as $row){ ?>
													<option value="<?php echo $row['p_id']; ?>" <?php if($row['p_id']==$p_id) echo "selected"; ?> ><?php echo $row['p_name'] . " " .$row['p_family']; ?></option>
												<?php
												}
											}
											?>
										</select>
                                    </div>
                                    <div class="col-md-3 col-sm-6">
                                        <label>تاریخ</label>
                                        <input type="text" name="f_date" class="form-control datepicker" value="<?php if(isset($_GET['f_id'])){ echo $f_date; } else{ echo jdate('Y/m/d'); } ?>" placeholder="تاریخ..." autocomplete="off">
                                    </div>
                                    <div class="col-md-3 col-sm-6">
                                        <label>نحوه پرداخت</label>
                                       	<select class="form-control" name="f_payment">
											<option value="نقدی" <?php if(isset($_GET['f_id'])){ if($res1[0]['f_payment'] == 'نقدی') { echo 'selected';} }?> >نقدی</option>
											<option value="غیر نقدی" <?php if(isset($_GET['f_id'])){ if($res1[0]['f_payment'] == 'غیر نقدی') { echo 'selected';} }?> >غیر نقدی</option>
										</select>
                                    </div>
									<div class="col-md-3 col-sm-6">
										 <label>ارزش افزوده</label>
										<select class="form-control" name="f_VAT_status">
											<option value="1" <?php if(isset($_GET['f_id'])){ if($res1[0]['f_VAT_status'] == 1) { echo 'selected';} }?> >دارد</option>
											<option value="0" <?php if(isset($_GET['f_id'])){ if($res1[0]['f_VAT_status'] == 0) { echo 'selected';} }?> >ندارد</option>
										</select>
									</div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <?php
                                        if(isset($_GET['edit'])){ ?>
                                            <button value="<?php echo $_GET['f_id']; ?>" name="edit-item" class="btn btn-warning">ویرایش سرفاکتور</button>
                                            <?php
                                        } else {
                                            ?>
                                            <button type="submit" name="add-factor" class="btn btn-success">ثبت سرفاکتور</button>
                                            <?php
                                        } ?>
                                    </div>
									<div class="col-md-12">
										<?php
										if(isset($_POST['edit-item'])){
											$f_id = $_POST['edit-item'];
											$p_id = $_POST['p_id'];
											$f_date = $_POST['f_date'];
											$u_id = $_POST['u_id'];
											$f_VAT_status = $_POST['f_VAT_status'];
											$f_payment = $_POST['f_payment'];
											$db->ex_query("update factor_buy set p_id = $p_id, f_date = '$f_date', u_id = $u_id, f_VAT_status = $f_VAT_status, f_payment = '$f_payment' where f_id = $f_id");
											$url = VIEW_URL . "buy/reg-buy.php?f_id=" . $f_id . "&edit=1";
											?><br>
											<div class="alert alert-success">
												سرفاکتور با موفقیت ویرایش شد
											</div>
											<script type="text/javascript">
												window.location.href = "<?php echo $url; ?>";
											</script>
											<?php
										} ?>
									</div>
								</div>
							</form>
							<?php
							if(isset($_GET['f_id'])){ 
								$f_id = $_GET['f_id'];?>
								<hr>
								<form method="post" action="" class="form">
									<div class="row"   id="result">
										<div class="col-md-4 col-sm-4">
											<label>نام محصول</label>
											<select class="form-control" name="pr_id" id="pr_id">
												<?php
												$res = 0;
												$res = $db->get_select_query("select * from product");
												if(count($res) > 0){
													foreach($res as $row){ ?>
														<option value="<?php echo $row['pr_id']; ?>" ><?php echo $row['pr_name']; ?></option>
													<?php
													}
												}
												?>
											</select>
										</div>
										<div class="col-md-4 col-sm-4">
											<label>مقدار</label>
											<input id="fb_quantity" type="text" name="fb_quantity" placeholder="مقدار..." class="form-control"  value="<?php echo $fb_quantity;  ?>" autocomplete="off" required>
										</div>
										<div class="col-md-4 col-sm-4">
											<label>قیمت به ریال</label>
											<input id="fb_price" type="text" name="fb_price" placeholder="قیمت به ریال..." class="form-control" value="<?php echo $fb_price;  ?>" autocomplete="off" required>
										</div>
									</div>
									</br>
									<div class="row">
										<div class="col-md-4 col-sm-4">
											<label>قیمت کل</label>
											<input  id="total_price" type="text" name="total_price" placeholder="قیمت کل..." class="form-control"  value="<?php echo $total_price;  ?>" autocomplete="off" readonly>
										</div>
										<div class="col-md-4 col-sm-4">
											<label>مبلغ تخفیف</label>
											<input id="fb_discount" type="text" name="fb_discount" placeholder="مبلغ تخفیف..." class="form-control" value="<?php echo $fb_discount;  ?>" autocomplete="off">
										</div>
										<div class="col-md-4 col-sm-4">
											<label>برداشت از</label>
											<select class="form-control" name="ba_id" id="ba_id">
												<option value="0"></option>
												<?php
												$res = 0;
												$res = $db->get_select_query("select * from bank_account");
												if(count($res) > 0){
													foreach($res as $row){ ?>
														<option value="<?php echo $row['ba_id']; ?>" ><?php echo $row['ba_account_owner']  . " " . $row['ba_account_number'] . " " . $row['ba_name']; ?></option>
													<?php
													}
												}
												?>
											</select>
										</div>
									</div>
									</br>
									<div class="row">
										<div class="col-md-12 col-sm-12">
											<label>توضیحات</label>
											<input type="text" id="fb_details" name="fb_details" placeholder="توضیحات..." class="form-control">
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
												<button type="submit" name="set-item" class="btn btn-success">ثبت فاکتور</button>
												<?php
											} ?>
										</div>
										<div class="col-md-12">
											<?php
											if(isset($_POST['set-item'])){
												$f_id = $_GET['f_id'];
												$pr_id = $_POST['pr_id'];
												$fb_quantity = $_POST['fb_quantity'];
												$fb_price = $_POST['fb_price'];
												$total_price = $_POST['total_price'];
												$fb_discount = $_POST['fb_discount'];
												$fb_details = $_POST['fb_details'];
												$ba_id = $_POST['ba_id'];
												$db->ex_query("insert into factor_buy_body(f_id, pr_id, ba_id, fb_quantity, fb_price, total_price, fb_discount, fb_details) values($f_id, $pr_id, $ba_id, '$fb_quantity', '$fb_price', '$total_price', '$fb_discount', '$fb_details')");
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

											if(isset($_POST['del-fb']))
											{
												$fb_id = $_POST['del-fb'];
												$db->ex_query("delete from factor_buy_body where fb_id = $fb_id");
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
											<h4 class="panel-title">بدنه فاکتور</h4>
										</div>
										<table class="table table-striped">
											<tr>
												<th>ردیف</th>
												<th>نام محصول</th>
												<th>مقدار</th>
												<th>قیمت  واحد</th>
												<th>قیمت کل</th>
												<th>مبلغ تخفیف</th>
												<th>توضیحات</th>
												<th>برداشت از</th>
												<th>حذف</th>
											</tr>
											
											
											<?php
											$i = 1;
											$f_id = $_GET['f_id'];
											$list = $db->get_select_query("select * from factor_buy inner join factor_buy_body on factor_buy.f_id = factor_buy_body.f_id where factor_buy.f_id = $f_id");
											if(count($list)> 0){
												foreach($list as $l){ 
													$ba_id = $l['ba_id']; ?>
													<tr>                   
														<td><?php echo $prime->per_number($i);?></td>
														<td><?php echo $product->get_product_name($l['pr_id']); ?></td>
														<td><?php echo $prime->per_number(number_format($l['fb_quantity'])); ?></td>
														<td><?php echo $prime->per_number(number_format($l['fb_price'])); ?></td>
														<td><?php echo $prime->per_number(number_format($l['total_price'])); ?></td>
														<td><?php echo $prime->per_number(number_format($l['fb_discount'])); ?></td>
														<td><?php $ba_id2 = $cost->get_bank_name($ba_id); echo $prime->per_number($ba_id2);  ?></td>
														<td><?php echo $prime->per_number($l['fb_details']); ?></td>
														<td>
															<form onSubmit="if(!confirm('آیا از انجام این عملیات اطمینان دارید؟')){return false;}" action="" method="post">
																<input type="hidden" name="u_id" value="<?php echo $_SESSION['user_id']; ?>">
																<button name="del-fb" value="<?php echo $l['fb_id']; ?>" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i></button>
															</form>
														</td>
													</tr>
													<?php
													$i++;
												}
											} else { ?>
												<tr>                   
													<tr><td class="text-center" colspan="9">موردی جهت نمایش موجود نیست</td>
												</tr>
												<?php												
											} ?>
										</table>
									</div>
								</div>
								<?php
							} ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<script type="text/javascript">
	$('#result').mouseover(function(){
		$('#total_price').val("Loading...");
		var fb_quantity = $('#fb_quantity').val();
		var fb_price = $('#fb_price').val();
		$.post("back1.php", {load_data:1 ,fb_quantity:fb_quantity, fb_price:fb_price}, function(data){
			$('#total_price').val(data);
		});
	});
</script>

<?php include "../../../footer.php"; ?>