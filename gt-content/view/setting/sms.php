<?php include "../../../header.php"; ?>
    </head>
    <body class="hold-transition sidebar-mini <?php $opt = new option(); $opt->check_push(); ?>">
<div class="wrapper">
    <!-- Navbar -->
    <?php include "../../../nav.php";
    include "../../../menu.php"; ?>
    <div class="content-wrapper">
        <br>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">تنظیمات پیامک</h3>
                            </div>
                            <form method="post" role="form">
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
                                        <div class="col-md-2"><label>نام کاربری پنل پیامک</label></div>
                                        <div class="col-md-3">
                                            <input style="direction: ltr;" name="sms_user"
                                                   value="<?php echo $opt->get_option('sms_user'); ?>"
                                                   class="form-control" type="text" placeholder="نام کاربری پنل پیامک">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-2"><label>رمز پنل پیامک</label></div>
                                        <div class="col-md-3">
                                            <input style="direction: ltr;" name="sms_pass"
                                                   value="<?php echo $opt->get_option('sms_pass'); ?>"
                                                   class="form-control" type="password" placeholder="رمز پنل پیامک">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-2"><label>شماره خط ارسال پیامک</label></div>
                                        <div class="col-md-3">
                                            <select name="sms_line" class="form-control">
                                                <option value="-">-</option>
                                                <option <?php if ($opt->get_option('sms_line') == "+985000125475") echo "selected"; ?>
                                                        value="+985000125475">5000125475
                                                </option>
                                                <option <?php if ($opt->get_option('sms_line') == "+9810009589") echo "selected"; ?>
                                                        value="+9810009589">10009589
                                                </option>
                                                <option <?php if ($opt->get_option('sms_line') == "+985000107070") echo "selected"; ?>
                                                        value="+985000107070">5000107070
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-2"><label>متن پیشفرض پیامک تبریک تولد</label></div>
                                        <div class="col-md-3">
                                            <textarea rows="10" class="form-control"
                                                      name="happy_text"><?php echo $opt->get_option('happy_text'); ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button name="save_opt" type="submit" class="btn btn-primary">ذخیره</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<?php include "../../../footer.php"; ?>