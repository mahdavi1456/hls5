<?php include"../../../header.php"; ?>
</head>
    <body class="hold-transition sidebar-mini <?php $opt = new option(); $opt->check_push(); ?>">
<div class="wrapper">
    <?php include"../../../nav.php"; include"../../../menu.php"; 
	$year = jdate('Y'); 
	$year1 = $year-2;
	$year2 = $year-1;
	$year3 = $year+1;
	$year4 = $year+2;
	
	$month = jdate('m');
	$month1 = $month-2;
	$month2 = $month-1;
	$month3 = $month+1;
	$month4 = $month+2; 
	
	if($month1 < 1 && $month2 == 1) { $month1 = 12; }
	if($month1 < 1 && $month2 < 1) { $month1 = 11; }
	if($month2 < 1) { $month2 = 12; }
	
	if($month4 > 12 && $month3 == 12) { $month4 = 1; }
	if($month4 > 12 && $month3 > 12) { $month4 = 2; }
	if($month3 > 12) { $month3 = 1; } ?>

    <div class="content-wrapper">
        <br>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">رزرو غذا</h3>
                        </div>
                        <div class="card-body">
                            <form method="get" action="">
                                <?php
                                $db = new database();
                                $prime = new prime();
								$date = new gdate();
								
                                $fp_year = "";
                                $fp_month = "";
                                $fp_week = "";
								$p_id = "";

                                if(isset($_GET['set_date'])){
                                    $fp_year = $_GET['year'];
                                    $fp_month = $_GET['month'];
                                    $fp_week = $_GET['week'];
									$p_id = $_GET['p_id'];
                                }
                                ?>
                                <div class="row">
									<div class="col-md-3 col-sm-3">
										<label>شخص</label>
										<select id="p_id" name="p_id" class="form-control select2">
											<?php
											$res = $db->get_select_query("select p_id, p_name, p_family from person where p_type = 'مشتری' ");
											if(count($res) > 0) {
												foreach($res as $row) {
													?>
													<option value="<?php echo $row['p_id']; ?>" <?php if($p_id == $row['p_id']) { echo 'selected'; } ?> ><?php echo $row['p_name'] . " " . $row['p_family']; ?></option>
													<?php
												}
											}
											?>
										</select>
									</div>
                                    <div class="col-md-3 col-sm-3">
                                        <label>سال</label>
										 <select id="year" name="year" class="form-control">
											<option value="<?php echo $year1; ?>" <?php if($fp_year == $year1) { echo 'selected'; } ?>><?php echo $year1; ?></option>
											<option value="<?php echo $year2; ?>" <?php if($fp_year == $year2) { echo 'selected'; } ?>><?php echo $year2; ?></option>
											<option value="<?php echo $year; ?>" <?php if(isset($_GET['year'])){ if($fp_year == $year) { echo 'selected'; } }  else {  echo 'selected'; } ?>><?php echo $year; ?></option>
											<option value="<?php echo $year3; ?>" <?php if($fp_year == $year3) { echo 'selected'; } ?>><?php echo $year3; ?></option>
											<option value="<?php echo $year4; ?>" <?php if($fp_year == $year4) { echo 'selected'; } ?>><?php echo $year4; ?></option>
										</select>
									</div>
									 <div class="col-md-3 col-sm-3">
                                        <label>ماه</label>
										 <select id="month" name="month" class="form-control">
											<option value="<?php echo $month1; ?>" <?php if($fp_month == $month1) { echo 'selected'; } ?>><?php echo $date->get_name_month($month1); ?></option>
											<option value="<?php echo $month2; ?>" <?php if($fp_month == $month2) { echo 'selected'; } ?>><?php echo $date->get_name_month($month2); ?></option>
											<option value="<?php echo $month; ?>" <?php if(isset($_GET['month'])){ if($fp_month == $month) { echo 'selected'; } } else {  echo 'selected'; } ?>><?php echo $date->get_name_month($month); ?></option>
											<option value="<?php echo $month3; ?>" <?php if($fp_month == $month3) { echo 'selected'; } ?>><?php echo $date->get_name_month($month3); ?></option>
											<option value="<?php echo $month4; ?>" <?php if($fp_month == $month4) { echo 'selected'; } ?>><?php echo $date->get_name_month($month4); ?></option>
										</select>
									</div>
									 <div class="col-md-3 col-sm-3">
                                        <label>هفته</label>
										 <select id="week" name="week" class="form-control">
											<option value="1" <?php if($fp_week == "1") { echo 'selected'; } ?>>اول</option>
											<option value="8" <?php if($fp_week == "8") { echo 'selected'; } ?>>دوم</option>
											<option value="16" <?php if($fp_week == "16") { echo 'selected'; } ?>>سوم</option>
											<option value="24" <?php if($fp_week == "24") { echo 'selected'; } ?>>چهارم</option>
										</select>
									</div>
                                    
									<div class="col-md-12 text-center"><br>
										<button name="set_date" class="btn btn-success" value="1">انتخاب</button>
									</div>
								</div>
								<div class="col-md-12">
									<?php
									if(isset($_POST['set_item'])){
										for($i=0 ; $i < 8 ; $i++) {
											if($_POST['set_item'] == $i){
												$fp_id1 = $_POST['f_id1' . $i];
												$fp_id2 = $_POST['f_id2' . $i];
												$fp_id3 = $_POST['f_id3' . $i];
												$fp_id4 = $_POST['f_id4' . $i];
												$p_id = $_POST['p_id'];
												$year = $_POST['year'];
												$month = $_POST['month'];
												$week = $_POST['week'];
												$fp_date = $_POST['fp_date' . $i];
												$res5 = $db->get_select_query("select * from food_plan where fp_date = '$fp_date'");
												if(count($res5) > 0) {
													foreach($res5 as $row) {
														$fp_id = $row['fp_id'];
														$db->ex_query("delete from food_reserv where fp_id = $fp_id and p_id = $p_id");
													}
												}
												if($fp_id1 != "0") {
													$db->ex_query("insert into food_reserv(p_id, fp_id) values($p_id, $fp_id1)");
												}
												if($fp_id2 != "0") {
													$db->ex_query("insert into food_reserv(p_id, fp_id) values($p_id, $fp_id2)");
												}
												if($fp_id3 != "0") {
													$db->ex_query("insert into food_reserv(p_id, fp_id) values($p_id, $fp_id3)");
												}
												if($fp_id4 != "0") {
													$db->ex_query("insert into food_reserv(p_id, fp_id) values($p_id, $fp_id4)");
												}
											}
										}
										?><br>
										<div class="alert alert-success">
											مورد با موفقیت ثبت شد
										</div>
										<script type="text/javascript">
											window.location.href = 'food_reserv.php?p_id=' + <?php echo $p_id; ?> + '&year=' + <?php echo $year; ?> + '&month=' + <?php echo $month; ?> + '&week=' + <?php echo $week; ?>;
											return;
										</script>
										<?php
									}
									
									?>
								</div>
                            </form>
							<form method="post" action="">
							<?php
							if(isset($_GET['set_date'])){ 
							?>
								<hr>
								<div class="row" id="div_print">
									<div class="panel panel-success table-responsive">
										<div class="panel-heading">
											<h4 class="panel-title">جدول رزرو غذا</h4>
										</div>
										<table class="table table-striped text-center">
											<tr>
												<th>#</th>
												<th>تاریخ</th>
												<th>صبحانه</th>
												<th>ناهار</th>
												<th>میان وعده</th>
												<th>شام</th>
												<th>وضعیت</th>
											</tr>
												<?php
												for($i=0 ; $i < 8 ; $i++) { 
													//$day = jdate('d');
													$fp_year = $_GET['year'];
													$fp_month = $_GET['month'];
													$fp_week = $_GET['week'];
													$p_id = $_GET['p_id'];
													$myday = $fp_week + $i;
													if($myday < 10) { $myday = '0' . $myday; }
													if($fp_month < 10) { $fp_month = '0' . $fp_month; }
													$mydate = $fp_year . "/" . $fp_month . "/" . $myday ;
													$mydate1 = $fp_year . "-" . $fp_month . "-" . $myday ;
													if($myday <= 31) { ?>
														<tr>
															<td><?php echo $prime->per_number($i+1); ?></td>
															<td><?php echo $prime->per_number($mydate); ?></td>
															<td>
																<select id="f_id" name="f_id1<?php echo $i; ?>" class="form-control">
																	<option value="0"></option>
																	<?php
																	$res = $db->get_select_query("select * from food");
																	if(count($res) > 0) {
																		foreach($res as $row) {
																			$f_id = $row['f_id'];
																			$res1 = $db->get_select_query("select f_id , fp_id from food_plan where fp_date = '$mydate1' and f_id = $f_id ");
																			$f_type = $row['f_type'];
																			if($f_type == "صبحانه") {
																				if($f_id == $res1[0]['f_id']){
																					$total = $db->get_var_query("select count(fr_id) from food_reserv inner join food_plan on food_reserv.fp_id = food_plan.fp_id inner join food on food_plan.f_id = food.f_id where food_plan.f_id = $f_id ");
																					if($total == "") { $total = 0;}
																					$supply = $db->get_var_query("select f_supply from food where f_id = $f_id ");
																					if($total < $supply) {
																						$fp_id = $res1[0]['fp_id'];
																						$res4 = $db->get_select_query("select * from food_reserv where fp_id = $fp_id and p_id = $p_id");
																						?>
																						<option value="<?php echo $fp_id; ?>" <?php if(count($res4) >0) { echo 'selected'; } ?>><?php echo $row['f_name']; ?></option>
																						<?php
																					}
																					else {
																						?>
																						<option value="0"><?php echo $row['f_name'] . " موجودی ندارد"; ?></option>
																						<?php
																					}
																				}
																			}
																		}
																	} ?>
																</select>
															</td>
															<td>
																<select id="f_id" name="f_id2<?php echo $i; ?>" class="form-control">
																	<option value="0"></option>
																	<?php
																	$res = $db->get_select_query("select * from food");
																	if(count($res) > 0) {
																		foreach($res as $row) {
																			$f_id = $row['f_id'];
																			$res1 = $db->get_select_query("select f_id , fp_id from food_plan where fp_date = '$mydate1' and f_id = $f_id ");
																			$f_type = $row['f_type'];
																			if($f_type == "ناهار") {
																				if($f_id == $res1[0]['f_id']){
																					$total = $db->get_var_query("select count(fr_id) from food_reserv inner join food_plan on food_reserv.fp_id = food_plan.fp_id inner join food on food_plan.f_id = food.f_id where food_plan.f_id = $f_id ");
																					$supply = $db->get_var_query("select f_supply from food where f_id = $f_id ");
																					if($total < $supply) {
																						$fp_id = $res1[0]['fp_id'];
																						$res4 = $db->get_select_query("select * from food_reserv where fp_id = $fp_id and p_id = $p_id");
																						?>
																						<option value="<?php echo $res1[0]['fp_id']; ?>" <?php if(count($res4) >0) { echo 'selected'; } ?> ><?php echo $row['f_name']; ?></option>
																						<?php
																					}
																					else {
																						?>
																						<option value="0"><?php echo $row['f_name'] . " موجودی ندارد"; ?></option>
																						<?php
																					}
																				}
																			}
																		}
																	} ?>
																</select>
															</td>
															<td>
																<select id="f_id" name="f_id3<?php echo $i; ?>" class="form-control">
																	<option value="0"></option>
																	<?php
																	$res = $db->get_select_query("select * from food");
																	if(count($res) > 0) {
																		foreach($res as $row) {
																			$f_id = $row['f_id'];
																			$res1 = $db->get_var_query("select f_id , fp_id from food_plan where fp_date = '$mydate1' and f_id = $f_id ");
																			$f_type = $row['f_type'];
																			if($f_type == "میان وعده") {
																				if($f_id == $res1[0]['f_id']){
																					$total = $db->get_var_query("select count(fr_id) from food_reserv inner join food_plan on food_reserv.fp_id = food_plan.fp_id inner join food on food_plan.f_id = food.f_id where food_plan.f_id = $f_id ");
																					$supply = $db->get_var_query("select f_supply from food where f_id = $f_id ");
																					if($total < $supply) {
																						$fp_id = $res1[0]['fp_id'];
																						$res4 = $db->get_select_query("select * from food_reserv where fp_id = $fp_id and p_id = $p_id");
																						?>
																						<option value="<?php echo $res1[0]['fp_id']; ?>" <?php if(count($res4) >0) { echo 'selected'; } ?> ><?php echo $row['f_name']; ?></option>
																						<?php
																					}
																					else {
																						?>
																						<option value="0"><?php echo $row['f_name'] . " موجودی ندارد"; ?></option>
																						<?php
																					}
																				}
																			}
																		}
																	} ?>
																</select>
															</td>
															<td>
																<select id="f_id" name="f_id4<?php echo $i; ?>" class="form-control">
																	<option value="0"></option>
																	<?php
																	$res = $db->get_select_query("select * from food");
																	if(count($res) > 0) {
																		foreach($res as $row) {
																			$f_id = $row['f_id'];
																			$res1 = $db->get_select_query("select f_id , fp_id from food_plan where fp_date = '$mydate1' and f_id = $f_id ");
																			$f_type = $row['f_type'];
																			if($f_type == "شام") {
																				if($f_id == $res1[0]['f_id']){
																					$total = $db->get_var_query("select count(fr_id) from food_reserv inner join food_plan on food_reserv.fp_id = food_plan.fp_id inner join food on food_plan.f_id = food.f_id where food_plan.f_id = $f_id ");
																					$supply = $db->get_var_query("select f_supply from food where f_id = $f_id ");
																					if($total < $supply) {
																						$fp_id = $res1[0]['fp_id'];
																						$res4 = $db->get_select_query("select * from food_reserv where fp_id = $fp_id and p_id = $p_id");
																						?>
																						<option value="<?php echo $res1[0]['fp_id']; ?>" <?php if(count($res4) >0) { echo 'selected'; } ?> ><?php echo $row['f_name']; ?></option>
																						<?php
																					}
																					else {
																						?>
																						<option value="0"><?php echo $row['f_name'] . " موجودی ندارد"; ?></option>
																						<?php
																					}
																				}
																			}
																		}
																	} ?>
																</select>
															</td>
															<td>
																<button name="set_item" class="btn btn-success btn-xs" value="<?php echo $i; ?>">رزرو</button>
															</td>
														</tr>
														<input type="hidden" name="fp_date<?php echo $i; ?>" value="<?php echo $mydate1; ?>">
														<input type="hidden" name="p_id" value="<?php echo $p_id; ?>">
														<input type="hidden" name="year" value="<?php echo $fp_year; ?>">
														<input type="hidden" name="month" value="<?php echo $fp_month; ?>">
														<input type="hidden" name="week" value="<?php echo $fp_week; ?>">
														<?php
													}
												} ?>
										</table>
									</div>
								</div>
								<div class="item col-md-12 text-center">
									<input name="b_print" type="button" class="ipt btn btn-info" onClick="printdiv('div_print');" value=" چاپ ">
								</div>
								<?php
							} ?>
							</form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<script>		
	function printdiv(printpage)
	{
		var headstr = "<html><head></head><body>";
		var footstr = "</body>";
		var newstr = document.all.item(printpage).innerHTML;
		var oldstr = document.body.innerHTML;
		document.body.innerHTML = headstr+newstr+footstr;
		window.print();
		document.body.innerHTML = oldstr;
		return false;
	}
</script>
<?php include "../../../footer.php"; ?>