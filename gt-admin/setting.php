<?php include"header.php"; ?>
	<section id="login">
		<div class="container-fluid">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<?php
				$aru = new aru();
				if(isset($_POST['save-config'])){
					$data = $_POST['config-data'];
					$myfile = fopen("super-config.txt", "w") or die("Unable to open asset!");
					fwrite($myfile, $data);
					fclose($myfile);
					
					$now = date('Y/m/d H:i');
					send_sms_super_admin("09138630341", "اطلاعات فایل سوپر کانفیگ ویرایش شد $now");
					?>
					<div class="alert alert-success">اطلاعات با موفقیت بروزرسانی شد</div>
					<?php
					echo "<meta http-equiv='refresh' content='2'/>";
				}
				?>
				<div class="text-center well well-lg">
					<h3>DATABASE</h3>
					<hr>
					<form class="form-horizontal form-simple" method="post" action="" id="myForm">
						<?php
						$r = file_get_contents("super-config.txt");
						?>
						<textarea style="direction: ltr!important; text-align: left;" rows="20" name="config-data" class="form-control"><?php echo $r; ?></textarea>		
						<button name="save-config" type="submit" class="btn btn-success btn-lg btn-block"><i class="icon-unlock2"></i>ویرایش</button>
					</form>
				</div>
			</div>
			<div class="col-md-2">
				
			</div>
		</div>
	</section>
<?php include"footer.php"; ?>