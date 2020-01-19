<?php include "../../../header.php"; ?>
    </head>
    <body class="hold-transition sidebar-mini">
<div class="wrapper">
    <?php include "../../../nav.php"; include "../../../menu.php"; ?>

    <div class="content-wrapper">
        <br>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">تنظیمات عمومی</h3>
                            </div>
                            <form action="" method="post" role="form">
                                <div class="card-body">
                                    <?php
                                    $opt = new option();

                                    if (isset($_POST['save_opt'])) {
                                        foreach ($_POST as $key => $value) {
                                            $opt->save_option($key, $value);
                                        }
                                        ?>
                                        <div class="alert alert-success">تنظیمات با موفقیت ذخیره شد</div>
                                        <?php
                                    }
                                    ?>
                                    <div class="row">
                                        <div class="col-md-2"><label>نام مجموعه</label></div>
                                        <div class="col-md-3">
                                            <input name="opt_name" value="<?php echo $opt->get_option('opt_name'); ?>"
                                                   class="form-control" type="text" placeholder="نام مجموعه...">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-2"><label>آدرس و تلفن</label></div>
                                        <div class="col-md-3">
                                            <input name="opt_address"
                                                   value="<?php echo $opt->get_option('opt_address'); ?>"
                                                   class="form-control" type="text" placeholder="آدرس و تلفن...">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-2"><label>متن پایین چاپ</label></div>
                                        <div class="col-md-3">
                                            <input name="opt_sign" value="<?php echo $opt->get_option('opt_sign'); ?>"
                                                   class="form-control" type="text" placeholder="متن پایین چاپ...">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-2"><label>آدرس سایت</label></div>
                                        <div class="col-md-3">
                                            <input readonly style="direction: ltr;" name="opt_home" value="<?php ?>"
                                                   class="form-control" type="text" placeholder="نام مجموعه...">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-2"><label>صفحه بندی مشتریان</label></div>
                                        <div class="col-md-3">
                                            <input style="direction: ltr;" name="ppp"
                                                   value="<?php echo $opt->get_option('ppp'); ?>" class="form-control"
                                                   type="number" placeholder="صفحه بندی مشتریان">
                                        </div>
                                    </div>
									<br>
									<div class="row">
                                        <div class="col-md-2"><label>قوانین مجموعه</label></div>
                                        <div class="col-md-10">
                                            <textarea name="roles"
                                                   value="<?php echo $opt->get_option('roles'); ?>" class="rich form-control"
                                                   placeholder="قوانین مجموعه"><?php echo $opt->get_option('roles'); ?></textarea>
                                        </div>
                                    </div>
									<br>
                                    <div class="row">
                                        <div class="col-md-2"><label>دیتابیس</label></div>
                                        <div class="col-md-3">
                                            <?php $db = new database(); ?>
                                            <input readonly="readonly" style="direction: ltr;" value="<?php echo $db->get_db_arg($_SESSION['account_id'], 'a_db_name'); ?>" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button name="save_opt" type="submit" class="btn btn-primary">ذخیره</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
</div>
<?php include "../../../footer.php"; ?>