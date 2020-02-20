<?php include "../../../header.php"; ?>
    </head>
    <body class="hold-transition sidebar-mini <?php $opt = new option(); $opt->check_push(); ?>">
<div class="wrapper">
    <!-- Navbar -->
    <?php include "../../../nav.php";
    include "../../../menu.php"; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <br>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">

                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">تنظیمات تعرفه</h3>
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
                                        <div class="col-md-2"><label>میزان رایگان به دقیقه</label></div>
                                        <div class="col-md-3">
                                            <input style="direction: ltr;" name="free_time"
                                                   value="<?php echo $opt->get_option('free_time'); ?>"
                                                   class="form-control" type="text" placeholder="میزان رایگان به دقیقه">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-2"><label>مبلغ ورودی به تومان</label></div>
                                        <div class="col-md-3">
                                            <input style="direction: ltr;" name="login_price"
                                                   value="<?php echo $opt->get_option('login_price'); ?>"
                                                   class="form-control" type="text" placeholder="مبلغ ورودی به تومان">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-2"><label>سقف محاسبه ورودی به دقیقه</label></div>
                                        <div class="col-md-3">
                                            <input style="direction: ltr;" name="login_deadline"
                                                   value="<?php echo $opt->get_option('login_deadline'); ?>"
                                                   class="form-control" type="text"
                                                   placeholder="سقف محاسبه ورودی به دقیقه">
                                        </div>
                                    </div>
                                    <hr>
                                    <h3>تعرفه ثابت</h3>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label>زیر یک ساعت</label><br>
                                            <input style="direction: ltr;" name="price_down_60"
                                                   value="<?php echo $opt->get_option('price_down_60'); ?>"
                                                   class="form-control" type="text" placeholder="تعرفه زیر یک ساعت">
                                        </div>
                                        <div class="col-md-3">
                                            <label>هر یک ساعت</label><br>
                                            <input style="direction: ltr;" name="price_up_60"
                                                   value="<?php echo $opt->get_option('price_up_60'); ?>"
                                                   class="form-control" type="text" placeholder="تعرفه بالای یک ساعت">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label>زیر یک ساعت VIP</label><br>
                                            <input style="direction: ltr;" name="vip_price_down_60"
                                                   value="<?php echo $opt->get_option('vip_price_down_60'); ?>"
                                                   class="form-control" type="text" placeholder="زیر یک ساعت VIP">
                                        </div>
                                        <div class="col-md-3">
                                            <label>هر یک ساعت VIP</label><br>
                                            <input style="direction: ltr;" name="vip_price_up_60"
                                                   value="<?php echo $opt->get_option('vip_price_up_60'); ?>"
                                                   class="form-control" type="text" placeholder="هر یک ساعت VIP">
                                        </div>
                                    </div>
                                    <br>
                                    <h3>روندکردن مبالغ</h3>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-2"><label>نوع روند کردن مبالغ</label></div>
                                        <div class="col-md-3">
                                            <select name="round_type" class="form-control">
                                                <option <?php if ($opt->get_option('round_type') == 'normal') echo 'selected'; ?>
                                                        value="normal">عادی
                                                </option>
                                                <option <?php if ($opt->get_option('round_type') == 'baloon') echo 'selected'; ?>
                                                        value="baloon">بالونی
                                                </option>
                                                <option <?php if ($opt->get_option('round_type') == 'quarter') echo 'selected'; ?>
                                                        value="quarter">ربعی
                                                </option>
												<option <?php if ($opt->get_option('round_type') == 'chiko') echo 'selected'; ?>
                                                        value="chiko">چیکو
                                                </option>
												<option <?php if ($opt->get_option('round_type') == 'melody') echo 'selected'; ?>
                                                        value="melody">ملودی
                                                </option>
                                            </select>
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