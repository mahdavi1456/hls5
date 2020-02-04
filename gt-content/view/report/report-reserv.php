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
                            <h3 class="card-title">گزارش رزرو غذاها</h3>
                        </div>
                        <div class="card-body">
                            <form method="get" action="">
                                <?php
                                $db = new database();
                                $prime = new prime();
								$p = new person();
                                ?>
                                <div class="row">
                                    <div class="col-md-3 col-sm-3">
                                        <label>تاریخ: </label>
										<input type="text" name="date" class="datepicker" value="<?php if(isset($_GET['date'])) echo $_GET['date']; else echo jdate('Y/m/d'); ?>" placeholder="تاریخ" autocomplete="off">
									</div>
									
                                    
									<div class="col-md-3 col-sm-3 text-center">
										<button name="set_date" class="btn btn-success" value="1">انتخاب</button>
									</div>
								</div>
                            </form>
							<form method="post" action="">
							<?php
							if(isset($_GET['date'])){ 
							$date = $_GET['date']; 
							$myDataArray1 = explode('/', $date);
							$myYear1 = $myDataArray1[0];
							$mymonth1 = $myDataArray1[1]; 
							$myday1 = $myDataArray1[2];
							
							if($mymonth1 < 10){
								$mymonth1 = "0" . $mymonth1;
							}
							if($myday1 < 10){
								$myday1 = "0" . $myday1;
							}

							$date = $myYear1 . "-" . $mymonth1 . "-" . $myday1;?>
								<hr>
								<div class="row" id="div_print">
									<div  class="col-12">
										<div class="panel panel-success table-responsive">
											<div class="panel-heading">
												<h4 class="panel-title">آمار غذاها</h4>
											</div>
											<table class="table table-striped text-center">
												<tr>
													<th>وعده</th>
													<th>نام غذا</th>
													<th>تعداد</th>
												</tr>
												<tr>
													<td>صبحانه</td>
													<td>
														<?php
														$total = 0; 
														$res = $db->get_select_query("select * from food");
														if(count($res) > 0) {
															foreach($res as $row) {
																$f_id = $row['f_id'];
																$res1 = $db->get_select_query("select f_id , fp_id from food_plan where fp_date = '$date' and f_id = $f_id ");
																if(count($res1) > 0){
																	$f_type = $row['f_type'];
																	if($f_type == "صبحانه") {
																		if($f_id == $res1[0]['f_id']){
																			$fp_id = $res1[0]['fp_id'];
																			$total = $db->get_var_query("select sum(fr_id) from food_reserv inner join food_plan on food_reserv.fp_id = food_plan.fp_id inner join food on food_plan.f_id = food.f_id where food_reserv.fp_id = $fp_id ");
																			if($total == "") { $total = 0;}
																			echo $row['f_name'];
																		}
																	}
																}
															}
														} ?>
													</td>
													<td>
														<?php
															echo $total;
														?>
													</td>
												</tr>
												<tr>
													<td>ناهار</td>
													<td>
														<?php
														$total = 0;
														$res = $db->get_select_query("select * from food");
														if(count($res) > 0) {
															foreach($res as $row) {
																$f_id = $row['f_id'];
																$res1 = $db->get_select_query("select f_id , fp_id from food_plan where fp_date = '$date' and f_id = $f_id ");
																if(count($res1) > 0){
																	$f_type = $row['f_type'];
																	if($f_type == "ناهار") {
																		if($f_id == $res1[0]['f_id']){
																			$fp_id = $res1[0]['fp_id'];
																			$total = $db->get_var_query("select sum(fr_id) from food_reserv inner join food_plan on food_reserv.fp_id = food_plan.fp_id inner join food on food_plan.f_id = food.f_id where food_reserv.fp_id = $fp_id ");
																			if($total == "") { $total = 0;}
																			echo $row['f_name'];
																		}
																	}
																}
															}
														} ?>
													</td>
													<td>
														<?php
															echo $total;
														?>
													</td>
												</tr>
												<tr>
													<td>میان وعده</td>
													<td>
														<?php
														$total = 0;
														$res = $db->get_select_query("select * from food");
														if(count($res) > 0) {
															foreach($res as $row) {
																$f_id = $row['f_id'];
																$res1 = $db->get_select_query("select f_id , fp_id from food_plan where fp_date = '$date' and f_id = $f_id ");
																if(count($res1) > 0){
																	$f_type = $row['f_type'];
																	if($f_type == "میان وعده") {
																		if($f_id == $res1[0]['f_id']){
																			$fp_id = $res1[0]['fp_id'];
																			$total = $db->get_var_query("select sum(fr_id) from food_reserv inner join food_plan on food_reserv.fp_id = food_plan.fp_id inner join food on food_plan.f_id = food.f_id where food_reserv.fp_id = $fp_id ");
																			if($total == "") { $total = 0;}
																			echo $row['f_name'];
																		}
																	}
																}
															}
														} ?>
													</td>
													<td>
														<?php
															echo $total;
														?>
													</td>
												</tr>
												<tr>
													<td>شام</td>
													<td>
														<?php
														$total = 0;
														$res = $db->get_select_query("select * from food");
														if(count($res) > 0) {
															foreach($res as $row) {
																$f_id = $row['f_id'];
																$res1 = $db->get_select_query("select f_id , fp_id from food_plan where fp_date = '$date' and f_id = $f_id ");
																if(count($res1) > 0){
																	$f_type = $row['f_type'];
																	if($f_type == "شام") {
																		if($f_id == $res1[0]['f_id']){
																			$fp_id = $res1[0]['fp_id'];
																			$total = $db->get_var_query("select count(fr_id) from food_reserv inner join food_plan on food_reserv.fp_id = food_plan.fp_id inner join food on food_plan.f_id = food.f_id where food_reserv.fp_id = $fp_id ");
																			if($total == "") { $total = 0;}
																			echo $row['f_name'];
																		}
																	}
																}
															}
														} ?>
													</td>
													<td>
														<?php
															echo $total;
														?>
													</td>
												</tr>
											</table>
										</div>
									</div>
									<hr>
									<div class="col-12">
										<div class="panel panel-success table-responsive">
											<div class="panel-heading">
												<h4 class="panel-title">لیست افراد</h4>
											</div>
											<table class="table table-striped text-center">
												<tr>
													<th>صبحانه</th>
													<th>ناهار</th>
													<th>میان وعده</th>
													<th>شام</th>
												</tr>
												<tr>
													<td>
														<?php
														$total = 0;
														$res = $db->get_select_query("select * from food");
														if(count($res) > 0) {
															foreach($res as $row) {
																$f_id = $row['f_id'];
																$res1 = $db->get_select_query("select f_id , fp_id from food_plan where fp_date = '$date' and f_id = $f_id ");
																if(count($res1) > 0){
																	$f_type = $row['f_type'];
																	if($f_type == "صبحانه") {
																		if($f_id == $res1[0]['f_id']){
																			$fp_id = $res1[0]['fp_id'];
																			$res4 = $db->get_select_query("select * from food_reserv inner join food_plan on food_reserv.fp_id = food_plan.fp_id inner join food on food_plan.f_id = food.f_id where food_reserv.fp_id = $fp_id ");
																			if(count($res4) > 0)
																			{
																				foreach($res4 as $row4) {
																					echo $p->get_person_name($row4['p_id']); ?>
																					<br>
																					<?php
																				}
																			}
																		}
																	}
																}
															}
														} ?>
													</td>
													<td>
														<?php
														$total = 0;
														$res = $db->get_select_query("select * from food");
														if(count($res) > 0) {
															foreach($res as $row) {
																$f_id = $row['f_id'];
																$res1 = $db->get_select_query("select f_id , fp_id from food_plan where fp_date = '$date' and f_id = $f_id ");
																if(count($res1) > 0){
																	$f_type = $row['f_type'];
																	if($f_type == "نهار") {
																		if($f_id == $res1[0]['f_id']){
																			$fp_id = $res1[0]['fp_id'];
																			$res4 = $db->get_select_query("select * from food_reserv inner join food_plan on food_reserv.fp_id = food_plan.fp_id inner join food on food_plan.f_id = food.f_id where food_reserv.fp_id = $fp_id ");
																			if(count($res4) > 0)
																			{
																				foreach($res4 as $row4) {
																					echo $p->get_person_name($row4['p_id']); ?>
																					<br>
																					<?php
																				}
																			}
																		}
																	}
																}
															}
														} ?>
													</td>
													<td>
														<?php
														$total = 0;
														$res = $db->get_select_query("select * from food");
														if(count($res) > 0) {
															foreach($res as $row) {
																$f_id = $row['f_id'];
																$res1 = $db->get_select_query("select f_id , fp_id from food_plan where fp_date = '$date' and f_id = $f_id ");
																if(count($res1) > 0){
																	$f_type = $row['f_type'];
																	if($f_type == "میان وعده") {
																		if($f_id == $res1[0]['f_id']){
																			$fp_id = $res1[0]['fp_id'];
																			$res4 = $db->get_select_query("select * from food_reserv inner join food_plan on food_reserv.fp_id = food_plan.fp_id inner join food on food_plan.f_id = food.f_id where food_reserv.fp_id = $fp_id ");
																			if(count($res4) > 0)
																			{
																				foreach($res4 as $row4) {
																					echo $p->get_person_name($row4['p_id']); ?>
																					<br>
																					<?php
																				}
																			}
																		}
																	}
																}
															}
														} ?>
													</td>
													<td>
														<?php
														$total = 0;
														$res = $db->get_select_query("select * from food");
														if(count($res) > 0) {
															foreach($res as $row) {
																$f_id = $row['f_id'];
																$res1 = $db->get_select_query("select f_id , fp_id from food_plan where fp_date = '$date' and f_id = $f_id ");
																if(count($res1) > 0){
																	$f_type = $row['f_type'];
																	if($f_type == "شام") {
																		if($f_id == $res1[0]['f_id']){
																			$fp_id = $res1[0]['fp_id'];
																			$res4 = $db->get_select_query("select * from food_reserv inner join food_plan on food_reserv.fp_id = food_plan.fp_id inner join food on food_plan.f_id = food.f_id where food_reserv.fp_id = $fp_id ");
																			if(count($res4) > 0)
																			{
																				foreach($res4 as $row4) {
																					echo $p->get_person_name($row4['p_id']); ?>
																					<br>
																					<?php
																				}
																			}
																		}
																	}
																}
															}
														} ?>
													</td>
												</tr>
											</table>
										</div>
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