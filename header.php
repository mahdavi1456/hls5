<?php include "gt-include.php";
if (isset($_GET['logout']) || !isset($_SESSION['account_id'])) {
    $_SESSION = [];
    header("location: login.php");
} ?>
<!DOCTYPE html>
<html lang="fa">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet" href="<?php echo ASSET_URL; ?>plugins/select2/select2.min.css">
    <link rel="stylesheet" href="<?php echo ASSET_URL; ?>css/lib/persianDatepicker-default.css">
    <link rel="stylesheet" href="<?php echo ASSET_DIR; ?>plugins/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo ASSET_DIR; ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <link rel="stylesheet" href="<?php echo ASSET_DIR; ?>dist/css/adminlte.min.css">
    <link rel="stylesheet" href="<?php echo ASSET_DIR; ?>dist/css/bootstrap-rtl.min.css">
    <link rel="stylesheet" href="<?php echo ASSET_URL; ?>dist/css/custom-style.css">
    <link rel="stylesheet" href="<?php echo ASSET_URL; ?>css/style.css">
    <script src="<?php echo ASSET_DIR; ?>plugins/jquery/jquery.min.js"></script>