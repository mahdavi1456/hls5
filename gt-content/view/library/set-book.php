<?php include"../../../header.php"; ?>
</head>
    <body class="hold-transition sidebar-mini">
<div class="wrapper">
    <?php include"../../../nav.php"; include"../../../menu.php"; ?>

    <div class="content-wrapper">
        <br>
		<div class="col-md-12">
		<?php
		$db = new database();
		$pr = new prime();
		$aru = new aru();
        if(isset($_POST['add-book'])){
            $aru->add("book", $_POST);
        }
        if(isset($_POST['del-book'])){
            $b_id = $_POST['del-book'];
            $aru->remove("book", "b_id", $b_id, "int");
        }
        if(isset($_POST['update-book'])){
            $b_id = $_GET['edit-book'];
            $aru->update("book", $_POST, "b_id", $b_id);
        }
        if(isset($_GET['edit-book'])){
            $eu = $_GET['edit-book'];
        } else {
            $eu = 0;
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
									<div class="col-md-3 col-sm-6">
										<label>نام کتاب <span class="red">*</span></label>
										<input name="b_name" class="form-control" type="text" placeholder="نام کتاب..." value="<?php echo $aru->field_for_edit("book", "b_name", "b_id", $eu); ?>">
									</div>
									<div class="col-md-3 col-sm-6">
										<label>قفسه <span class="red">*</span></label>
										<input name="b_cage" class="form-control" type="text" placeholder="قفسه..." value="<?php echo $aru->field_for_edit("book", "b_cage", "b_id", $eu); ?>">
									</div>
									<div class="col-md-3 col-sm-6">
										<label>نویسنده <span class="red">*</span></label>
										<input name="b_author" class="form-control" type="text" placeholder="نویسنده..." value="<?php echo $aru->field_for_edit("book", "b_author", "b_id", $eu); ?>">
									</div>
									<div class="col-md-3 col-sm-6">
										<label>ناشر <span class="red">*</span></label>
										<input name="b_publisher" class="form-control" type="text" placeholder="ناشر..." value="<?php echo $aru->field_for_edit("book", "b_publisher", "b_id", $eu); ?>">
									</div>
								</div><br>
								<div class="row">
									<div class="col-md-12 text-center">
										<?php
                                        if(isset($_GET['edit-book'])){ ?>
                                            <button name="update-book" value="<?php echo $_GET['edit-book']; ?>" class="btn btn-warning">ویرایش اطلاعات</button>
                                            <a class="btn btn-danger" href="<?php echo VIEW_URL; ?>library/set-book.php">انصراف از ویرایش</a>
                                            <?php
                                        } else { ?>
                                            <button name="add-book" class="btn btn-success">ثبت اطلاعات</button>
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
											<th>نام کتاب</th>
											<th>قفسه</th>
											<th>نویسنده</th>
											<th>ناشر</th>
											<th>مدیریت</th>
										</tr>
										<?php
										$i = 1;
										$res = $db->get_select_query("select * from book");
										if(count($res)>0) {
											foreach($res as $row) { ?>
											<tr>
												<td><?php echo $pr->per_number($i); ?></td>
												<td><?php echo $row['b_name']; ?></td>
												<td><?php echo $row['b_cage']; ?></td>
												<td><?php echo $pr->per_number($row['b_author']); ?></td>
												<td><?php echo $pr->per_number($row['b_publisher']); ?></td>
												<td>
													<form class="miniform" action="" method="post" style="display: inline-block">
                                                        <button name="del-book" onclick="if(!confirm('آیا از انجام این عملیات اطمینان دارید؟')){return false;}" value="<?php echo $row['b_id']; ?>" class="btn btn-danger btn-sm">حذف</button>
                                                    </form>
													<form class="miniform" action="" method="get" style="display: inline-block">
                                                        <button name="edit-book" value="<?php echo $row['b_id']; ?>" class="btn btn-info btn-sm">ویرایش</button>
                                                    </form>
												</td>
											</tr>
											<?php
											$i++;
											}
										} else { ?>
											<tr><td class="text-center" colspan="5">موردی جهت نمایش موجود نیست</td></tr>
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