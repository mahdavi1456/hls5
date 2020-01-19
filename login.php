<?php include "gt-include.php"; ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">	
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>پنل مدیریت | صفحه ورود</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo ASSET_DIR; ?>dist/css/adminlte.min.css">
    <link rel="stylesheet" href="<?php echo ASSET_DIR; ?>dist/plugins/iCheck/square/blue.css">
    <link rel="stylesheet" href="<?php echo ASSET_DIR; ?>dist/css/bootstrap-rtl.min.css">
    <link rel="stylesheet" href="<?php echo ASSET_DIR; ?>dist/css/custom-style.css">
</head>
<body class="hold-transition login-page" style="background: url(<?php echo ASSET_DIR; ?>images/wall2.jpg) 100% 100%;">
<div class="login-box">
    <div class="login-logo"></div>
    <div class="card">
        <div class="card-body login-card-body text-center">
            <img src="<?php echo ASSET_DIR; ?>images/heli-logo.png"><hr>
            <form action="" method="post">
                <div class="input-group mb-3">
                    <input name="gt-user" type="text" class="form-control" placeholder="نام کاربری">
                    <div class="input-group-append">
                        <span class="fa fa-envelope input-group-text"></span>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input name="gt-password" type="password" class="form-control" placeholder="رمز عبور">
                    <div class="input-group-append">
                        <span class="fa fa-lock input-group-text"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button name="gt-login" type="submit" class="btn btn-primary btn-block btn-flat">ورود</button>
                    </div>
                </div>
                <?php if (isset($_GET['action']) && $_GET['action'] == "out") {
                    $_SESSION = "";
                }
                if (isset($_POST['gt-login'])) {
                    $username = $_POST['gt-user'];
                    $password = $_POST['gt-password'];
                    $db = new database();
                    $st = $db->check_login($username, $password);
					if ($st == "no") {
                        ?>
                        <br>
                        <div class="alert alert-danger text-center">نام کاربری یا رمز وارد شده صحیح نمی باشد</div>
                        <?php
                    } else {
						$user = new user();
						$_SESSION['account_id'] = $st;
						$_SESSION['user_id'] = $st;
						echo '<script> window.location = "index.php"; </script>';
                    }
                }
                ?>
            </form>
        </div>
    </div>
</div>
<script src="<?php echo ASSET_DIR; ?>dist/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo ASSET_DIR; ?>dist/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo ASSET_DIR; ?>dist/plugins/iCheck/icheck.min.js"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        })
    })
</script>
</body>
</html>