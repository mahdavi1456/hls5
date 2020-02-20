<?php include "header.php"; ?>
    </head>
    <body class="hold-transition sidebar-mini <?php $opt = new option(); $opt->check_push(); ?>">
<div class="wrapper">
    <?php include "nav.php"; include "menu.php"; ?>
	<div class="content-wrapper">
		<div class="col-md-12">
	<?php
	if(isset($_POST['pause_game'])) {
        $g = new game();

        $g_id = $_POST['pause_game'];
        $g->set_change($g_id, 'pause', 1);
		?>
		<script type="text/javascript">
			window.location.href = "index.php";
		</script>
		<?php
    }

    if(isset($_POST['play_game'])) {
        $g = new game();
        $db = new database();

        $g_id = $_POST['play_game'];
        $prev_action = $db->get_select_query("select gm_key from game_meta where g_id = $g_id order by gm_id desc limit 2")[1][0];
        $g->set_change($g_id, $prev_action, 1);
		?>
		<script type="text/javascript">
			window.location.href = "index.php";
		</script>
		<?php
	}
	
	if(isset($_POST['offer'])) {
        $g = new game();
        $db = new database();
		
        $g_id = $_POST['g_id'];
		$offer_code = $_POST['offer'];
		$db->get_select_query("update game set g_offer_code = '$offer_code' where g_id = $g_id");
    }
	
	if(isset($_POST['add-course_ticket'])){
		$aru = new aru();
        $aru->add("course_ticket", $_POST);
		?>
		<br>
		<div class="alert alert-success">خرید بلیط با موفقیت انجام شد</div>
		<?php
    }
    ?>
	</div>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12 text-center">
						<?php
                        $db = new database();
                        $m = new modal();
                        ?>
                        <button id="desktop_login_btn" data-toggle="modal" data-target="#frmLogin"
                                class="btn btn-success btn-lg">
                            <i class="fa fa-sign-in"></i><br>ورود
                        </button>
                        <?php $m->show_modal("frmLogin", "ثبت ورود", "login"); ?>
						
						 <button id="desktop_login_btn2" data-toggle="modal" data-target="#frmLogin2"
                                class="btn btn-danger btn-lg">
                            <i class="fa fa-sign-in"></i><br>ثبت و ورود
                        </button>
                        <?php $m->show_modal("frmLogin2", "ثبت و ورود", "login2"); ?>
						
						<button data-toggle="modal" data-target="#userActivity"
                                class="btn btn-primary btn-lg">
                            <i class="fa fa-sign-out"></i><br>تردد پرسنل
                        </button>
                        <?php $m->show_modal("userActivity", "تردد پرسنل", "user_activity"); ?>
						
						<button data-toggle="modal" data-target="#courseTicket" class="btn btn-warning btn-lg">
                            <i class="fa fa-ticket"></i><br>فروش بلیط
                        </button>
                        <?php $m->show_modal("courseTicket", "فروش بلیط", "course_ticket"); ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header no-border">
                                <h3 class="card-title">افراد حاضر</h3>
                            </div>
                            <div class="card-body p-0 table-responsive">
                                <table class="table table-striped table-valign-middle">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>نام و نام خانوادگی</th>
                                        <th>ساعت ورود</th>
                                        <th>عملیات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i = 1;
                                    $db = new database();
                                    $p = new person();
                                    $pr = new prime();
                                    $res = $db->get_select_query("select * from game where g_status = 0");
                                    if (count($res) > 0) {
                                        foreach ($res as $row) {
                                            ?>
                                            <tr>
                                                <td><?php echo $pr->per_number($i); ?></td>
                                                <td><?php echo $p->get_person_name($row['p_id']); ?></td>
                                                <td><?php echo $row['g_in']; ?></td>
                                                <td>
                                                    <button data-toggle="modal"
                                                            data-target="#shop_modal<?php echo $row['g_id']; ?>"
                                                            data-pid="<?php echo $row['p_id']; ?>"
                                                            class="index-load-factor-btn btn btn-warning btn-sm">
                                                            <i data-toggle="tooltip" title="بوفه" class="fa fa-coffee"></i>
                                                    </button>
                                                    <?php $m->show_modal("shop_modal" . $row['g_id'], "ثبت بوفه", "shop", $row['g_id']); ?>

                                                    <button data-toggle="tooltip" title="استعلام"
                                                            data-p_id="<?php echo $row['p_id']; ?>"
                                                            data-g_id="<?php echo $row['g_id']; ?>"
                                                            class="load-game btn btn-info btn-sm">
                                                            <i class="fa fa-clock-o"></i>
                                                    </button>

                                                    <button data-toggle="modal"
                                                            data-target="#count_modal<?php echo $row['g_id']; ?>"
                                                            class="btn btn-danger btn-sm">
                                                            <i data-toggle="tooltip" title="تغییر تعداد" class="fa fa-edit"></i>
                                                    </button>
                                                    <?php $m->show_modal("count_modal" . $row['g_id'], "ثبت تغییرات", "count", $row['g_id']); ?>

                                                    <button data-toggle="modal"
                                                            data-target="#vip_modal<?php echo $row['g_id']; ?>"
                                                            class="btn btn-success btn-sm">
                                                            <i data-toggle="tooltip" title="تعداد ویژه" class="fa fa-star"></i>
                                                    </button>
                                                    <?php $m->show_modal("vip_modal" . $row['g_id'], "ثبت ویژه", "vip", $row['g_id']); ?>
													
													<button data-toggle="modal"
                                                            data-target="#offer_modal<?php echo $row['g_id']; ?>"
                                                            class="btn btn-dark btn-sm">
                                                            <i data-toggle="tooltip" title="تخفیف" class="fa fa-minus"></i>
                                                    </button>
                                                    <?php $m->show_modal("offer_modal" . $row['g_id'], "تخفیف", "offer", $row['g_id']); ?>

                                                    <form action="" method="post" style="display: inline-block">
                                                        <?php
                                                        $g_id = $row['g_id'];
                                                        $last_action = $db->get_var_query("select gm_key from game_meta where g_id = $g_id order by gm_id desc limit 1");
                                                        if($last_action == "pause") { ?>
                                                            <button type="submit"
                                                                    name="play_game"
                                                                    value="<?php echo $row['g_id']; ?>"
                                                                    class="btn btn-default btn-sm">
                                                                <i data-toggle="tooltip" title="ادامه"
                                                                   class="fa fa-play"></i>
                                                            </button>

                                                            <?php
                                                        } else {
                                                            ?>
                                                            <button type="submit"
                                                                    name="pause_game"
                                                                    value="<?php echo $row['g_id']; ?>"
                                                                    class="btn btn-default btn-sm">
                                                                <i data-toggle="tooltip" title="توقف"
                                                                   class="fa fa-pause"></i>
                                                            </button>
                                                            <?php
                                                        }
                                                            ?>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php
                                            $i++;
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td class="text-center" colspan="4">موردی جهت نمایش موجود نیست</td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col-md-6 -->
                    <div class="col-lg-6">
                        <div class="card table-responsive">
                            <div class="card-body p-0" id="load-game-result"></div>
                            <div id="login-overly" class="overlay">
                                <i class="fa fa-refresh fa-spin"></i>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-md-6 -->
                </div>
            </div>
        </div>
    </div>
    
    <aside class="control-sidebar control-sidebar-dark"></aside>
    
    <footer class="main-footer"></footer>
</div>
<?php include "footer.php"; ?>