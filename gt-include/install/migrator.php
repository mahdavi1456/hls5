<?php include "../../gt-include.php";
include "function.php"; ?>
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
    <link rel="stylesheet" href="<?php echo ASSET_DIR; ?>dist/css/adminlte.min.css">
    <link rel="stylesheet" href="<?php echo ASSET_DIR; ?>dist/css/bootstrap-rtl.min.css">
    <link rel="stylesheet" href="<?php echo ASSET_URL; ?>dist/css/custom-style.css">
    <link rel="stylesheet" href="<?php echo ASSET_URL; ?>css/style.css">
    <script src="<?php echo ASSET_DIR; ?>plugins/jquery/jquery.min.js"></script>
    <style type="text/css">
        pre{
            font-family: SFMono-Regular,Menlo,Monaco,Consolas,"Liberation Mono","Courier New",monospace;
            direction: ltr;
            text-align: left;
            font-size: 87.5%;
            color: #e83e8c;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header no-border">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">کد هماهنگ کننده دیتابیس</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <pre>
                                <?php
                                $db = new database();
                                $sql = "select * from old_game";
                                $res = $db->get_select_query($sql);
                                if(count($res) > 0){
                                    foreach($res as $row){
                                        $g_id = $row['g_id'];
                                        $u_id = 1;
                                        $p_id = $row['p_id'];
                                        $g_type = $row['g_type'];
                                        $g_count = $row['g_count'];
                                        $g_in = $row['g_in'];
                                        $g_out = $row['g_out'];
                                        $g_date = $row['g_date'];
                                        $g_total_price = $g_price = $row['g_price'];
                                        $g_extra_price = $g_ez = $row['g_ez'];
                                        $g_status = $row['g_status'];
                                        $g_adjective = $row['g_adjective'];

                                        $sql_ins = "insert into game(u_id, p_id, g_count, g_in, g_out, g_date, g_total, g_total_vip, g_extra, g_total_price, g_total_vip_price, g_extra_price, g_used_sharj, g_login_price, g_total_shop, g_offer_code, g_offer_price, g_status, g_adjective) ";
                                        $sql_ins .= "values($u_id, $p_id, $g_count, '$g_in', '$g_out', '$g_date', 0, 0, 0, $g_total_price, 0, $g_extra_price, 0, 0, 0, 0, 0, 1, '$g_adjective')";
                                        echo $sql_ins . "<hr>";
                                        $new_g_id = $db->ex_query($sql_ins);

                                        echo $g_id . "<br>";
                                        $sql2 = "select * from old_game_meta where g_id = $g_id";
                                        $res2 = $db->get_select_query($sql2);
                                        if(count($res2) > 0){
                                            foreach($res2 as $row2){
                                                echo "<span style='margin-left: 20px; color: blue;'>" . $row2['gm_id'] . "</span><br>";

                                                $gm_key = $row2['gm_key'];
                                                $gm_value = $row2['gm_value'];
                                                $gm_date = $row2['gm_date'];
                                                $gm_time = $row2['gm_time'];
                                                $gm_time_end = $row2['gm_time_end'];

                                                $sql_ins_meta = "insert into game_meta(g_id, gm_key, gm_value, gm_date, gm_time, gm_time_end) ";
                                                $sql_ins_meta .= "values($new_g_id, '$gm_key', '$gm_value', $gm_date, $gm_time, $gm_time_end)";
                                                $db->ex_query($sql_ins_meta);
                                            }
                                        }
                                        echo "<hr>";
                                    }
                                } else {
                                    echo "error!";
                                }
                                ?>
                            </pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo ASSET_URL; ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo ASSET_URL; ?>dist/js/pages/dashboard3.js"></script>
<script src="<?php echo ASSET_URL; ?>plugins/select2/select2.full.min.js"></script>
<script src="<?php echo ASSET_URL; ?>js/lib/persianDatepicker.min.js"></script>
<!--script src="<?php //echo ASSET_URL; ?>dist/js/demo.js"></script-->
<script src="<?php echo ASSET_URL; ?>dist/js/adminlte.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".datepicker").persianDatepicker();
        $('.select2').select2();
        $('.modal').on('shown.bs.modal', function() {
            $(this).find('[autofocus]').focus();
        });
    });
</script>
</body>
</html>