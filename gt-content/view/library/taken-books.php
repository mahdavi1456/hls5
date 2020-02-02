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
		?>
		</div>
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">کتب در دست امانت</h3>
                        </div>
                        <div class="card-body p-md-0">
                                <div class="panel panel-success table-responsive">			
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
										</tr>
										<?php
										$i = 1;
										$res = $db->get_select_query("select * from loan where l_todate = '0000-00-00'");
										if(count($res)>0) {
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
												</tr>
												<?php
												$i++;
											}
										} else { ?>
											<tr><td class="text-center" colspan="8">موردی جهت نمایش موجود نیست</td></tr>
											<?php
										}
										?>
									</table>
                                </div>
                         
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<?php include "../../../footer.php"; ?>