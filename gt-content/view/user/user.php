<?php include "../../../header.php"; ?>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <?php include "../../../nav.php"; include "../../../menu.php"; ?>
    <div class="content-wrapper">
        <br>
        <?php
		$a_id = $_SESSION['account_id'];
		$aru = new aru();
        if(isset($_POST['add-user'])){
            $aru->add("user", $_POST, 1);
        }
        if(isset($_POST['del-user'])){
            $u_id = $_POST['del-user'];
            $aru->remove("user", "u_id", $u_id, "int", 1);
        }
        if(isset($_POST['update-user'])){
            $u_id = $_GET['edit-user'];
            $aru->update("user", $_POST, "u_id", $u_id, 1);
        }
        if(isset($_GET['edit-user'])){
            $eu = $_GET['edit-user'];
        } else {
            $eu = 0;
        }
        ?>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">تعریف کاربر</h3>
                            </div>
                            <div class="card-body">
                                <form class="form-horizontal" method="post">
									<input type="hidden" name="a_id" value="<?php echo $a_id; ?>">
                                    <div class="col-sm-12">
                                        <label class="control-label">نام</label>
                                        <input name="u_name" value="<?php echo $aru->field_for_edit("user", "u_name", "u_id", $eu , 1); ?>" type="text" class="form-control" placeholder="نام">
                                    </div><br>
                                    <div class="col-sm-12">
                                        <label class="control-label">نام خانوادگی</label>
                                        <input name="u_family" value="<?php echo $aru->field_for_edit("user", "u_family", "u_id", $eu, 1); ?>" type="text" class="form-control" placeholder="نام خانوادگی">
                                    </div><br>
                                    <div class="col-sm-12">
                                        <label class="control-label">کد پرسنلی</label>
                                        <input name="u_code" value="<?php echo $aru->field_for_edit("user", "u_code", "u_id", $eu, 1); ?>" type="text" class="form-control" placeholder="کد پرسنلی">
                                    </div><br>
                                    <div class="col-sm-12">
                                        <label class="control-label">نام کاربری</label>
                                        <input name="u_username" value="<?php echo $aru->field_for_edit("user", "u_username", "u_id", $eu, 1); ?>" type="text" class="form-control" placeholder="نام کاربری">
                                    </div><br>
                                    <div class="col-sm-12">
                                        <label class="control-label">رمز ورود</label>
                                        <input name="u_password" value="<?php echo $aru->field_for_edit("user", "u_password", "u_id", $eu, 1); ?>" type="password" class="form-control" placeholder="رمز ورود">
                                    </div><br>
                                    <?php $u_level = $aru->field_for_edit("user", "u_level", "u_id", $eu, 1);  ?>
                                    <div class="col-sm-12">
                                        <label class="control-label">سطح دسترسی</label>
                                        <select name="u_level" class="form-control">
                                            <option <?php if($u_level=="مدیر")echo "selected"; ?>>مدیر</option>
                                            <option <?php if($u_level=="مالی")echo "selected"; ?>>مالی</option>
											<option <?php if($u_level=="اپراتور")echo "selected"; ?>>اپراتور</option>
                                        </select>
                                    </div><br>
                                    <div class="col-sm-12">
                                        <label class="control-label">رمز ورود</label>
                                        <input name="u_mobile" value="<?php echo $aru->field_for_edit("user", "u_mobile", "u_id", $eu, 1); ?>" type="text" class="form-control" placeholder="موبایل">
                                    </div><br>
                                    <div class="col-ms-10">
                                        <?php
                                        if(isset($_GET['edit-user'])){ ?>
                                            <button name="update-user" value="<?php echo $_GET['edit-user']; ?>" class="btn btn-warning btn-lg">ویرایش اطلاعات</button>
                                            <a class="btn btn-danger btn-lg" href="<?php echo get_theme_dir() ?>user/users.php">انصراف از ویرایش</a>
                                            <?php
                                        } else { ?>
                                            <button name="add-user" class="btn btn-success">ثبت اطلاعات</button>
                                            <?php
                                        } ?>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">لیست کاربران</h3>
                            </div>
                            <div class="card-body p-0 table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th>ردیف</th>
                                        <th>نام</th>
                                        <th>نام خانوادگی</th>
                                        <th>کد پرسنلی</th>
                                        <th>نام کاربری</th>
                                        <th>رمز ورود</th>
                                        <th>دسترسی</th>
                                        <th>موبایل</th>
                                        <th>عملیات</th>
                                    </tr>
                                    <?php
                                    $db = new database();
                                    $prime = new prime();
                                    $i = 1;
                                    $list = $db->get_select_query("select * from user where a_id = $a_id" , 1);
                                    if(count($list)>0){
                                        foreach($list as $l){ ?>
                                            <tr>
                                                <td><?php echo $prime->per_number($i); ?></td>
                                                <td><?php echo $l['u_name']; ?></td>
                                                <td><?php echo $l['u_family']; ?></td>
                                                <td><?php echo $l['u_code']; ?></td>
                                                <td><?php echo $prime->per_number($l['u_username']); ?></td>
                                                <td>*****</td>
                                                <td><?php echo $l['u_level']; ?></td>
                                                <td><?php echo $prime->per_number($l['u_mobile']); ?></td>
                                                <td>
                                                    <?php //if($_SESSION['level'] == "مدیر") { ?>
                                                        <form class="miniform" action="" method="post" style="display: inline-block">
                                                            <button name="del-user" onclick="if(!confirm('آیا از انجام این عملیات اطمینان دارید؟')){return false;}" value="<?php echo $l['u_id']; ?>" class="btn btn-danger btn-sm">حذف</button>
                                                        </form>
                                                        <form class="miniform" action="" method="get" style="display: inline-block">
                                                            <button name="edit-user" value="<?php echo $l['u_id']; ?>" class="btn btn-info btn-sm">ویرایش</button>
                                                        </form>
                                                    <?php //} else {
                                                        ?>
                                                        <!--button disabled class="btn btn-dark btn-xs">عدم دسترسی</button-->
                                                        <?php
                                                    //} ?>
                                                </td>
                                            </tr>
                                            <?php
                                            $i++;
                                        }
                                    }else{ ?>
                                        <tr>
                                            <td colspan="8">بدون کاربر</td>
                                        </tr>
                                        <?php
                                    } ?>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
            </div>
        </section>
    </div>
    <footer class="main-footer"></footer>
    <aside class="control-sidebar control-sidebar-dark"></aside>
</div>
<?php include "../../../footer.php"; ?>