<?php include"../../../header.php"; ?>
</head>
<body class="hold-transition sidebar-mini <?php $opt = new option(); $opt->check_push(); ?>">
<div class="wrapper">
    <?php include "../../../nav.php"; include"../../../menu.php"; ?>
    <div class="content-wrapper">
        <br>
		<div class="col-md-12">
        <?php
        $db = new database();
        $gd = new gdate();
		$aru = new aru();
        $person = new person();
		
		if(isset($_POST['save-card'])){
            $p_code = $_POST['p_code'];
			$p_id = $_POST['p_id'];
            $db->ex_query("update person set p_code = $p_code where p_id = $p_id");
			?><br>
            <div class="alert alert-success">
                کارت با موفقیت برای <?php echo $person->get_person_name($p_id); ?> ذخیره شد
            </div>
            <script type="text/javascript">
                window.location.reload();
                return;
            </script>
            <?php
        }
		if(isset($_POST['add-person'])){
            $aru->add('person', $_POST);
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
		if(isset($_POST['update-person'])){
            $aru->update('person', $_POST, 'p_id', $_POST['p_id']);
        }
        if(isset($_POST['remove-person'])){
            $p_id = $_POST['remove-person'];
            $aru->remove('person', 'p_id', $p_id, 'int');
        }

        if(isset($_POST['save-person_meta'])){
            $person = new person();
            $p_id = $_POST['p_id'];
            foreach($_POST as $key => $value){
                if($key != "save-person_meta"){
                    $person->save_person_meta($p_id, $key, $value);
                }
            }
            ?><br>
            <div class="alert alert-success">
                اطلاعات تکمیلی با موفقیت ذخیره شدند
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
                            <h3 class="card-title">اشخاص
                                <!--a href="<?php //echo INC_URL; ?>lib/excel.php?create_report=1"><img style="margin-right: 10px;" class="icon pull-left" src="<?php //echo ASSET_URL; ?>images/icons/excel.png"></a-->
								<button type="button" data-toggle="modal" data-target="#personModal" class="pull-left btn btn-success btn-sm">+ شخص جدید</button>
							</h3>
                        </div>
                        <?php
						$m = new modal();
						$m->show_modal("personModal", "تعریف شخص جدید", "person");
						?>

                        <div class="card-body p-md-0">
                            <div class="table-responsive">
                                <table id="myTable" class="table table-bordered table-striped">
                                    <?php
                                    $db = new database();
                                    $prime = new prime();
                                    $person = new person();

                                    if (isset($_GET['pageno'])) {
                                        $pageno = $_GET['pageno'];
                                    } else {
                                        $pageno = 1;
                                    }

                                    $no_of_records_per_page = 10;
                                    $offset = ($pageno - 1) * $no_of_records_per_page;

                                    if(isset($_GET['s'])) {
                                        $s = $_GET['s'];
                                        $search_type = $_GET['search_type'];
                                        $order_by = $_GET['order_by'];
                                        $sql_f = "select * from person ";
                                        $sql_w = "where  p_type = 'مشتری' and $search_type like '%" . $s . "%' ";
                                        $sql_o = "order by $order_by asc ";
                                        $sql_l = "limit $offset, $no_of_records_per_page";
                                        $sql = $sql_f . $sql_w . $sql_o . $sql_l;

                                        $sql_f_all = "select count(p_id) from person ";
                                        $sql_f_all .= $sql_w;
                                        $total_rows = $db->get_var_query($sql_f_all);
                                    } else {
                                        $sql = "select * from person where p_type = 'مشتری' order by p_id desc limit $offset, $no_of_records_per_page";

                                        $sql_f_all = "select count(p_id) from person ";
                                        $total_rows = $db->get_var_query($sql_f_all);
                                    }
                                    $res = $db->get_select_query($sql);
                                    $c = count($res);
                                    ?>
                                    <tr>
                                        <td colspan="16">
                                            <form action="" method="get">
                                                <label>جستجو بر اساس
                                                    <select name="search_type">
                                                        <option <?php if(isset($_GET['search_type']) && $_GET['search_type'] == "p_family") echo "selected"; ?> value="p_family">نام خانوادگی</option>
                                                        <option <?php if(isset($_GET['search_type']) && $_GET['search_type'] == "p_name") echo "selected"; ?> value="p_name">نام</option>
                                                        <option <?php if(isset($_GET['search_type']) && $_GET['search_type'] == "p_mobile") echo "selected"; ?> value="p_mobile">موبایل</option>
                                                    </select> :
                                                </label>
                                                <input type="text" name="s" value="<?php if(isset($_GET['s'])) echo $_GET['s']; ?>" style="color: #000;" >
                                                <button name="search" class="btn btn-warning btn-sm">جستجو</button>
                                                <a href="<?php VIEW_URL; ?>person.php" class="btn btn-info btn-sm">نمایش همه</a>

                                                <div class="pull-left">
                                                    مرتب سازی:
                                                    <select name="order_by" onchange="this.form.submit()">
                                                        <option <?php if(isset($_GET['order_by']) && $_GET['order_by'] == "p_id") echo "selected"; ?> value="p_id">عضویت</option>
                                                        <option <?php if(isset($_GET['order_by']) && $_GET['order_by'] == "p_family") echo "selected"; ?> value="p_family">نام خانوادگی</option>
                                                    </select>
                                                    <?php
                                                    $total_pages = ceil($total_rows / 10);
                                                    if(isset($_GET['pageno'])){
                                                        $current = $_GET['pageno'];
                                                    } else {
                                                        $current = 1;
                                                    }
                                                    ?>
                                                    صفحه:
                                                    <select onchange="this.form.submit()" name="pageno" style="display: inline-block">
                                                        <?php
                                                        $prime = new prime();
                                                        for($i = 1; $i <= $total_pages; $i++){ ?>
                                                            <option <?php if($i == $current)echo "selected"; ?> value="<?php echo $i; ?>"><?php echo $prime->per_number($i); ?></option>
                                                            <?php
                                                        } ?>
                                                    </select>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>ردیف</th>
                                        <th>شماره عضویت</th>
                                        <th>ثبت نام</th>
                                        <th>نام</th>
                                        <th>نام خانوادگی</th>
                                        <th>تاریخ تولد</th>
                                        <th>کد اشتراک</th>
                                        <th>جنسیت</th>
                                        <th>موبایل</th>
                                        <th>تعهدنامه</th>
                                        <th>مدیریت</th>
                                    </tr>
                                    <?php
                                    $i = 1;
                                    if($c > 0){
                                        foreach($res as $row){
                                            $p_pack = $row['p_pack'];
                                            $pack_name = $db->get_var_query("select pk_name from package where pk_id = $p_pack");
                                            $p_id = $row['p_id'];
                                            ?>
                                            <tr>
                                                <td><?php echo $prime->per_number($i); ?></td>
                                                <td><?php echo $prime->per_number($row['p_id']); ?></td>
                                                <td><?php echo $prime->per_number(str_replace('-', '/', $row['p_regdate'])); ?></td>
                                                <td><?php echo $row['p_name']; ?></td>
                                                <td><?php echo $row['p_family']; ?></td>
                                                <td><?php echo $prime->per_number(str_replace('-', '/', $row['p_birth'])); ?></td>
                                                <td><?php echo $prime->per_number($row['p_code']); ?></td>
                                                <td><?php if($row['p_gender'] == 1){ echo "پسر"; } else { echo "دختر"; } ?></td>
                                                <td><?php echo $prime->per_number($row['p_mobile']); ?></td>
                                                <td><?php echo $prime->per_number(str_replace('-', '/', $row['p_commitment'])); ?></td>
                                                <td>
                                                    <form action="" method="post">
                                                        <button data-toggle="modal" type="button" data-target="#editModal<?php echo $row['p_id']; ?>" class="btn btn-info btn-sm load-person-edit-form-btn" data-p_id="<?php echo $row['p_id']; ?>"><i data-toggle="tooltip" title="ویرایش" class="fa fa-edit"></i></button>
                                                        <button data-toggle="modal" type="button" data-target="#myModal<?php echo $row['p_id']; ?>" class="btn btn-default btn-sm load-person-extra-form-btn" data-p_id="<?php echo $row['p_id']; ?>"><i data-toggle="tooltip" title="اطلاعات تکمیلی" class="fa fa-plus"></i></button>
                                                        <button data-toggle="modal" type="button" class="btn btn-primary btn-sm load-set-card" data-p_id="<?php echo $row['p_id']; ?>" data-target="#cardModal<?php echo $row['p_id']; ?>"><i data-toggle="tooltip" title="تخصیص کارت" class="fa fa-credit-card"></i></button>
														<a data-toggle="tooltip" title="تعهدنامه" href="<?php echo VIEW_URL; ?>person/commitment.php?p_id=<?php echo $row['p_id']; ?>" class="btn btn-warning btn-sm"><i class="fa fa-check"></i></a>
														<button data-toggle="tooltip" title="حذف" onclick="if(!confirm('آیا از انجام این عملیات اطمینان دارید؟')){ return false; }" name="remove-person" value="<?php echo $row['p_id']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i></button>
													</form>
                                                    <div id="editModal<?php echo $row['p_id']; ?>" class="modal fade" role="dialog">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <label class="modal-title">ویرایش اطلاعات</label>
                                                                </div>
                                                                <div class="modal-body" id="load-person-edit-form<?php echo $row['p_id']; ?>"></div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
													<div id="myModal<?php echo $row['p_id']; ?>" class="modal fade" role="dialog">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <label class="modal-title">اطلاعات تکمیلی</label>
                                                                </div>
                                                                <div class="modal-body" id="load-person-extra-form<?php echo $row['p_id']; ?>">

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="cardModal<?php echo $row['p_id']; ?>" class="modal fade" role="dialog">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <label class="modal-title">مدیریت کارت</label>
                                                                </div>
                                                                <div class="modal-body text-center">
                                                                    <form action="" method="post">
																		<label>تخصیص کارت</label>
																		<input style="width: 100%!important" name="p_code" class="form-control" placeholder="اینجا کلیک کنید سپس کارت را به دستگاه نزدیک کنید"><br>
																		<button name="save-card" class="btn btn-success">ذخیره</button>
																		<input type="hidden" name="p_id" value="<?php echo $row['p_id']; ?>">
																	</form>
																</div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">بستن</button>
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
                                        <tr><td class="text-center" colspan="16">موردی جهت نمایش موجود نیست</td></tr>
                                        <?php
                                    } ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <footer class="main-footer"></footer>
    <aside class="control-sidebar control-sidebar-dark"></aside>
</div>
<?php include"../../../footer.php"; ?>