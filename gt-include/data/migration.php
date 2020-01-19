<?php include"../../header.php"; ?>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo ASSET_DIR; ?>dist/plugins/datatables/dataTables.bootstrap4.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo ASSET_DIR; ?>dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- bootstrap rtl -->
    <link rel="stylesheet" href="<?php echo ASSET_DIR; ?>dist/css/bootstrap-rtl.min.css">
    <!-- template rtl version -->
    <link rel="stylesheet" href="<?php echo ASSET_DIR; ?>dist/css/custom-style.css">
    </head>
    <body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Navbar -->
    <?php include"../../nav.php"; ?>

    <!-- Main Sidebar Container -->
    <?php include"../../menu.php"; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <br>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">همگام سازی</h3>
                        </div>
                        <div class="card-body">
                            <pre style="direction: ltr; text-align: left; background: #eee">
                                <?php
                                $mig = new migration();
                                $mig->migrate_person();
                                ?>
                            </pre>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong>CopyLeft &copy; 2018 <a href="http://github.com/hesammousavi/">حسام موسوی</a>.</strong>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?php echo ASSET_DIR; ?>dist/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo ASSET_DIR; ?>dist/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="<?php echo ASSET_DIR; ?>dist/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo ASSET_DIR; ?>dist/plugins/datatables/dataTables.bootstrap4.js"></script>
<!-- SlimScroll -->
<script src="<?php echo ASSET_DIR; ?>dist/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo ASSET_DIR; ?>dist/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo ASSET_DIR; ?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo ASSET_DIR; ?>dist/js/demo.js"></script>
<!-- page script -->
<script>
    $(function () {
        $("#example1").DataTable({
            "language": {
                "paginate": {
                    "next": "بعدی",
                    "previous" : "قبلی"
                }
            },
            "info" : false,
        });
        $('#example2').DataTable({
            "language": {
                "paginate": {
                    "next": "بعدی",
                    "previous" : "قبلی"
                }
            },
            "info" : false,
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "autoWidth": false
        });
    });
</script>
<?php include "../../footer.php"; ?>