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
                            <h3 class="card-title">تامین کننده ها</h3>
                        </div>
                        <div class="card-body">
                            <form method="post" action="" class="form">
                                <?php
                                $db = new database();
                                $prime = new prime();
								$aru = new aru();
								$u_id = $_SESSION['user_id'];
								
                                $p_name = "";
                                $p_family = "";
                                $p_mobile = "";
                                $p_gender = "";

                                if(isset($_POST['edit-item-table'])){
                                    $p_id = $_POST['edit-item-table'];
                                    $res = $db->get_select_query("select * from person where p_id = $p_id");
                                    $p_name = $res[0]['p_name'];
                                    $p_family = $res[0]['p_family'];
                                    $p_mobile = $res[0]['p_mobile'];
                                    $p_gender = $res[0]['p_gender'];
                                }
                                ?>
                                <div class="row">
									<input type="hidden" name="u_id" value="<?php echo $u_id; ?>" >
									<input type="hidden" name="p_type" value="تامین کننده">
									<input type="hidden" name="p_regdate" value="<?php echo jdate('Y-m-d'); ?>">
									<div class="col-md-3">
										<label>نام</label>
										<input name="p_name" class="form-control" type="text" placeholder="نام..." value="<?php echo $p_name; ?>">
									</div>
									<div class="col-md-3">
										<label>نام خانوادگی</label>
										<input id="p_family" name="p_family" class="form-control" type="text" placeholder="نام خانوادگی..." value="<?php echo $p_family; ?>" autocomplete="off">
										<div class="family-search-result"></div>
									</div>
									 <div class="col-md-3">
										<label>موبایل</label>
										<input name="p_mobile" class="form-control" type="text" placeholder="09xxxxxxxxx" value="<?php echo $p_mobile; ?>">
									</div>
									<div class="col-md-3">
										<label>جنسیت</label>
										<select name="p_gender" class="form-control">
											<option value="1" <?php if($p_gender == "1"){ echo 'selected'; } ?> >مرد</option>
											<option value="0" <?php if($p_gender == "0"){ echo 'selected'; } ?> >زن</option>
										</select>
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
                                            <button name="add-person" class="btn btn-success">ثبت اطلاعات</button>
                                            <?php
                                        } ?>
                                    </div>
                                    <div class="col-md-12">
                                        <?php
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
                                        if(isset($_POST['edit-item']))
                                        {
                                            $p_id = $_POST['edit-item'];
                                            $u_id = $_POST['u_id'];
                                            $p_type = $_POST['p_type'];
                                            $p_regdate = $_POST['p_regdate'];
                                            $p_name = $_POST['p_name'];
											$p_family = $_POST['p_family'];
											$p_mobile = $_POST['p_mobile'];
											$p_gender = $_POST['p_gender'];

                                            $db->ex_query("update person set u_id = $u_id, p_type = '$p_type', p_regdate = '$p_regdate', p_name = '$p_name', p_family = '$p_family', p_mobile = '$p_mobile', p_gender = $p_gender where p_id = $p_id");
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

                                        if(isset($_POST['del-item']))
                                        {
                                            $p_id = $_POST['del-item'];
                                            $db->ex_query("delete from person where p_id = $p_id");
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
                                            <h4 class="panel-title">جدول تامین کننده ها</h4>
                                        </div>
                                        <table class="table table-striped">
                                            <tr>
                                                <th>ردیف</th>
                                                <th>نام</th>
                                                <th>نام خانوادگی</th>
                                                <th>موبایل</th>
                                                <th>جنسیت</th>
                                                <th>مدیریت</th>
                                            </tr>
                                            <?php
                                            $i = 1;
                                            $res = $db->get_select_query("select * from person where p_type = 'تامین کننده' ");
                                            if(count($res)>0){
                                                foreach($res as $row) { ?>
                                                    <tr>
                                                        <td><?php echo $prime->per_number($i); ?></td>
                                                        <td><?php echo $row['p_name']; ?></td>
                                                        <td><?php echo $row['p_family']; ?></td>
                                                        <td><?php echo $prime->per_number($row['p_mobile']); ?></td>
                                                        <td><?php  if($row['p_gender'] == "1") { echo "مرد"; } else{ echo "زن"; } ?></td>
                                                        <td>
                                                            <form action="" method="post">
                                                                <button onclick="if(!confirm('آیا از انجام این عملیات اطمینان دارید؟')){return false;}" name="del-item" value="<?php echo $row['p_id']; ?>" class="btn btn-danger btn-sm">حذف</button>
                                                                <button name="edit-item-table" value="<?php echo $row['p_id']; ?>" class="btn btn-info btn-sm">ویرایش</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    <?php
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