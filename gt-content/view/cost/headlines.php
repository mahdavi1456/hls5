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
                            <h3 class="card-title">سرفصل ها</h3>
                        </div>
                        <div class="card-body">
                            <form method="post" action="" class="form">
                                <?php
                                $db = new database();
                                $prime = new prime();
								$cost = new cost();
								
                                $h_name = "";
                                $h_code = "";
                                $h_details = "";

                                if(isset($_POST['edit-item-table'])){
                                    $h_id = $_POST['edit-item-table'];
                                    $res = $db->get_select_query("select * from headlines where h_id = $h_id");
                                    $h_name = $res[0]['h_name'];
                                    $h_code = $res[0]['h_code'];
                                    $h_details = $res[0]['h_details'];
                                }
                                ?>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <label>نام سرفصل</label><span class="necessary"> *</span>
                                        <input name="h_name" class="form-control" type="text" placeholder="نام سرفصل..." value="<?php echo $h_name; ?>" required>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label>سرفصل والد</label><span class="necessary"> *</span>
										<select class="form-control" name="h_code" id="h_code">
											<option value="0"></option>
											<?php
											$res = 0;
											$res = $db->get_select_query("select * from headlines");
											if(count($res) > 0){
												foreach($res as $row){ ?>
													<option value="<?php echo $row['h_id']; ?>" <?php if($row['h_id'] == $h_code) { echo 'selected'; }  ?> ><?php echo $row['h_name']; ?></option>
												<?php
												}
											}
											?>
										</select>
									</div>
								</div><br>
								<div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <label>توضیحات</label>
                                        <input name="h_details" class="form-control" type="text" placeholder="توضیحات..." value="<?php echo $h_details; ?>">
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <?php
                                        if(isset($_POST['edit-item-table'])){ ?>
                                            <button value="<?php echo $_POST['edit-item-table']; ?>" name="update-headlines" class="btn btn-warning">ویرایش اطلاعات</button>
                                            <?php
                                        } else {
                                            ?>
                                            <button name="add-headlines" class="btn btn-success">ذخیره</button>
                                            <?php
                                        } ?>
                                    </div>
                                    <div class="col-md-12">
                                        <?php
										if(isset($_POST['add-headlines'])) {
											$k = 0;
											$h_name = $_POST['h_name'];
											$h_code = $_POST['h_code'];
											$h_details = $_POST['h_details'];
											$res = $db->get_select_query("select * from headlines");
											if(count($res) > 0){
												foreach($res as $row){
													if($row['h_name'] == $_POST['h_name']) {
														$k = 1;
														?><br>
														<div class="alert alert-error">
															نام سرفصل وجود دارد
														</div>
														<script type="text/javascript">
															window.location.reload();
															return;
														</script>
														<?php
													}
												}
											}
											if($k == 0){
												$db->ex_query("insert into headlines(h_name, h_code, h_details) values('$h_name', $h_code, '$h_details')");
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
										}

										
										if(isset($_POST['update-headlines'])) {
											$h_id = $_POST['update-headlines'];
											$h_name = $_POST['h_name'];
											$h_code = $_POST['h_code'];
											$h_details = $_POST['h_details'];
											$k = 0;
											$res = $db->get_select_query("select * from headlines");
											if(count($res) > 0){
												foreach($res as $row){
													if($row['h_name'] == $_POST['h_name']) {
														$k = 1;
														?><br>
														<div class="alert alert-error">
															نام سرفصل وجود دارد
														</div>
														<script type="text/javascript">
															window.location.reload();
															return;
														</script>
														<?php
													}
												}
											}
											if($k == 0){
												$db->ex_query("update headlines set h_name = '$h_name', h_code = $h_code, h_details = '$h_details' where h_id = $h_id");
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
										}

                                        if(isset($_POST['del-item']))
                                        {
                                            $h_id = $_POST['del-item'];
                                            $db->ex_query("delete from headlines where h_id = $h_id");
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
                                            <h4 class="panel-title">جدول سرفصل ها</h4>
                                        </div>
                                        <table class="table table-striped">
                                            <tr>
                                                <th colspan="2">ردیف</th>
												<th colspan="2">کد سرفصل</th>
												<th colspan="2">نام سرفصل</th>
												<th colspan="2">سرفصل والد</th>
												<th colspan="2">توضیحات</th>
												<th colspan="2">مدیریت</th>
                                            </tr>
                                            <?php
                                            $i = 1;
                                            $res = $db->get_select_query("select * from headlines where h_code = 0");
                                            if(count($res)>0){
                                                foreach($res as $row) { ?>
                                                    <tr>
                                                        <td colspan="2"><?php echo $prime->per_number($i); ?></td>
                                                        <td colspan="2"><?php echo $prime->per_number($row['h_id']); ?></td>
                                                        <td colspan="2"><?php echo $prime->per_number($row['h_name']); ?></td>
                                                        <td colspan="2"><?php $h_code = $cost->get_headlines_name($row['h_code']); echo $prime->per_number($h_code); ?></td>
                                                        <td colspan="2"><?php echo $prime->per_number($row['h_details']); ?></td>
                                                        <td colspan="2">
                                                            <form action="" method="post">
                                                                <button onclick="if(!confirm('آیا از انجام این عملیات اطمینان دارید؟')){return false;}" name="del-item" value="<?php echo $row['h_id']; ?>" class="btn btn-danger btn-sm">حذف</button>
                                                                <button name="edit-item-table" value="<?php echo $row['h_id']; ?>" class="btn btn-info btn-sm">ویرایش</button>
                                                            </form>
                                                        </td>
                                                    </tr>
													<?php
													$j =  $i + 1;
													$h_id = $row['h_id'];
													$res2 = $db->get_select_query("select * from headlines where h_code = $h_id");
													if(count($res2)>0){
														foreach($res2 as $row2) { ?>
															<tr>
																<td colspan="1"></td>
																<td colspan="1"><?php echo $prime->per_number($j); ?></td>
																<td colspan="1"></td>
																<td colspan="1"><?php echo $prime->per_number($row2['h_id']); ?></td>
																<td colspan="1"></td>
																<td colspan="1"><?php echo $prime->per_number($row2['h_name']); ?></td>
																<td colspan="1"></td>
																<td colspan="1"><?php $h_code = $cost->get_headlines_name($row2['h_code']); echo $prime->per_number($h_code); ?></td>
																<td colspan="1"></td>
																<td colspan="1"><?php echo $prime->per_number($row2['h_details']); ?></td>
																<td colspan="1"></td>
																<td colspan="1">
																	<form action="" method="post">
																		<button onclick="if(!confirm('آیا از انجام این عملیات اطمینان دارید؟')){return false;}" name="del-item" value="<?php echo $row2['h_id']; ?>" class="btn btn-danger btn-sm">حذف</button>
																		<button name="edit-item-table" value="<?php echo $row2['h_id']; ?>" class="btn btn-info btn-sm">ویرایش</button>
																	</form>
																</td>
															</tr>
															<?php
															$j++;
														}
														$i =  $j - 1;
													}
                                                    $i++;
                                                }
                                            } else { ?>
                                                <tr><td class="text-center" colspan="6">موردی جهت نمایش موجود نیست</td></tr>
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