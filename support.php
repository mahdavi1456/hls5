<?php include "header.php"; ?>
    </head>
    <body class="hold-transition sidebar-mini <?php $opt = new option(); $opt->check_push(); ?>">
<div class="wrapper">
    <?php include "nav.php";
    include "menu.php"; ?>

    <div class="content-wrapper">
        <br>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- COLOR PALETTE -->
                <div class="card card-default color-palette-box">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fa fa-tag"></i>
                            پشتیبانی
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6"><h3>نرم افزار کنترل از راه دور</h3></div>
                            <div class="col-md-6">
                                <a rel="download" href="https://download.anydesk.com/AnyDesk.exe"><img
                                            src="<?php echo ASSET_URL; ?>images/AnyDesk.png"></a>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6"><h3>تماس با شرکت</h3></div>
                            <div class="col-md-6">
                                <h4>تلفن: ۲۸۴۲۱۴۵۶-۰۲۱ گویا</h4>
                                <br>
                                <h4>موبایل: ۰۹۱۳۸۶۳۰۳۴۱ (ساعات غیراداری)</h4>
                                <br>
                                <h4>ایمیل: info.gratech@gmail.com</h4>
                                <br>
                                <h4><a target="_blank" href="http://cp.gratech.ir/submitticket.php">ارسال درخواست
                                        پشتیبانی</a> (هر ۲۴ ساعت شبانه روز)</h4>
                                <br>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6"><h3>آدرس شرکت</h3></div>
                            <div class="col-md-6">
                                <p>کرمان، رفسنجان، خیابان طالقانی، کوچه ۶۲، شرکت طراحی و توسعه وب گراتک</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6"><h3>بروزرسانی نرم افزار</h3></div>
                            <div class="col-md-6">
                                <div class="alert alert-success">شما از آخرین نسخه نرم افزار استفاده می کنید</div>
                                <!--form action="update/run.php" method="post">
                                <button class="btn btn-success" name="update">شروع عملیات بروزرسانی</button>
                                </form-->
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<?php include "footer.php"; ?>