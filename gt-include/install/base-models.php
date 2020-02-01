<?php include "../../gt-include.php"; ?>
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
    <script>
        function copyDivToClipboard() {
            var range = document.createRange();
            range.selectNode(document.getElementById("pre"));
            window.getSelection().removeAllRanges(); // clear current selection
            window.getSelection().addRange(range); // to select text
            document.execCommand("copy");
            window.getSelection().removeAllRanges();// to deselect
            alert("کپی شد..");
        }
    </script>
</head>
<body>
	<div class="wrapper">
		<div class="content">
			<div class="container">
				<div class="row">
					<div class="col-lg-12"><br>
						<?php
                        if(isset($_POST['run-step1'])) {
                            
                            $f = file_put_contents("latest.zip", fopen("http://www.gratech.ir/heliup/latest.zip", 'r'), LOCK_EX);
                            
                            if(FALSE === $f)
                                die("Couldn't write to file.");
                                
                            $zip = new ZipArchive;
                            $res = $zip->open('latest.zip');    
                            if ($res === TRUE) {
                                $zip->extractTo('hls5');
                                $zip->close();
                                echo "extracted";
                                //
                            } else {
                                //
                                echo "i cant open this file!";
                            }
                        }
                        ?>
                        <form action="" method="post">
                        <div class="card">
                            <div class="card-header no-border">
                                <div class="d-flex justify-content-between">
                                    <h3 class="card-title">مرحله اول: دانلود فایل های نرم افزار</h3>
                                    <button class="btn btn-success btn-sm" name="run-step1">اجرای مرحله اول</button>
                                </div>
                            </div>
                        </div>
                        </form>
                        <div class="card">
							<div class="card-header no-border">
								<div class="d-flex justify-content-between">
									<h3 class="card-title">کد ساختار ساز دیتابیس</h3>
									<button class="btn btn-info btn-sm" onclick="copyDivToClipboard()">COPY</button>
								</div>
							</div>
							<div class="card-body">
                                <pre id="pre">
                                <?php
                                echo file_get_contents("base/adjective/tables/adjective.sql");

                                echo file_get_contents("base/course/tables/course.sql");
                                echo file_get_contents("base/course/tables/course_cost.sql");
                                echo file_get_contents("base/course/tables/course_ticket.sql");

                                echo file_get_contents("base/game/tables/game_meta.sql");

                                echo file_get_contents("base/kitchen/tables/food.sql");
                                echo file_get_contents("base/kitchen/tables/food_plan.sql");
                                echo file_get_contents("base/kitchen/tables/food_reserv.sql");

                                echo file_get_contents("base/library/tables/book.sql");
                                echo file_get_contents("base/library/tables/loan.sql");

                                echo file_get_contents("base/offer/tables/offer.sql");

                                echo file_get_contents("base/package/tables/package.sql");

                                echo file_get_contents("base/person/tables/person_meta.sql");

                                echo file_get_contents("base/product/tables/product.sql");

                                echo file_get_contents("base/report/tables/factor.sql");
                                echo file_get_contents("base/report/tables/payment.sql");

                                echo file_get_contents("base/setting/tables/setting.sql");

                                echo file_get_contents("base/sms/tables/sms_log.sql");

                                echo file_get_contents("base/user/tables/user_activity.sql");
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