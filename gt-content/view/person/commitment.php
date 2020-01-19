<?php include"../../../header.php"; ?>
		<style type="text/css">
			@page {
				size: A4;
				margin: 0;
			}
			.page {
				margin: 20px;
				padding: 20px;
				border: initial;
				border-radius: initial;
				width: initial;
				min-height: initial;
				box-shadow: initial;
				background: initial;
				page-break-after: always;
				border: 1px solid #000;
				border-radius: 12px;
			}
		</style>
	</head>
	<body>
		<?php
        $db = new database();
		$pr = new prime();
		$per = new person();
		$opt = new option();

        $p_id = $_GET['p_id'];
		///$account_id = get_var_query("select a_id from person where p_id = $p_id");
		$opt_name = $db->get_var_query("select meta_value from setting where meta_key = 'opt_name'"); ?>
		<div class="text-center">
			<?php
			if(isset($_POST['set'])){
				$p_commitment = jdate('Y/m/d');
				$db->ex_query("update person set p_commitment = '$p_commitment' where p_id = $p_id");
				?>
				<div class="alert alert-success">دریافت تعهدنامه با موفقیت ثبت شد</div>
				<?php
			}
			?>
		</div>
		<?php
		$p_name = $db->get_var_query("select p_name from person where p_id = $p_id");
		$p_family = $db->get_var_query("select p_family from person where p_id = $p_id");
		$p_fname = $db->get_var_query("select p_fname from person where p_id = $p_id");
		$p_birth = $db->get_var_query("select p_birth from person where p_id = $p_id");
		$p_phone = $db->get_var_query("select p_phone from person where p_id = $p_id");
		$p_mobile = $db->get_var_query("select p_mobile from person where p_id = $p_id");
		$p_address = $db->get_var_query("select p_address from person where p_id = $p_id");
		?>
		<div class="page a4">
			<table class="com-table">
				<tr><th colspan="6"><h4 class="text-center">اطلاعات فردی:</h4></th></tr>
				<tr>
					<td>
						<b>نام: </b><?php echo $p_name; ?>
					</td>
					<td>
						<b>نام خانوادگی: </b><?php echo $p_family; ?>
					</td>
					<td>
						<b>نام پدر: </b><?php echo $p_fname; ?>
					</td>
					<td>
						<b>تاریخ تولد: </b><?php echo $pr->per_number($p_birth); ?>
					</td>
					<td>
						<b>تلفن: </b><?php echo $pr->per_number($p_phone); ?></td>
					<td>
						<b>موبایل: </b><?php echo $pr->per_number($p_mobile); ?>
					</td>
				</tr>
				<tr>
					<td colspan="6">
						<b>آدرس: </b><?php echo $pr->per_number($p_address); ?>
					</td>
				</tr>
			</table>
			<hr>
			<table class="com-table">
				<tr><th colspan="6"><h4 class="text-center">مشخصات پدر:</h4></th></tr>
				<tr>
					<td><b>نام پدر: </b><?php echo $per->get_person_meta($p_id, 'father_name'); ?></td>
					<td><b>شغل پدر: </b><?php echo $per->get_person_meta($p_id, 'father_job'); ?></td>
					<td><b>تحصیلات پدر: </b><?php echo $per->get_person_meta($p_id, 'father_edu'); ?></td>
					<td><b>تاریخ تولد: </b><?php echo $per->get_person_meta($p_id, 'father_birthday'); ?></td>
					<td><b>کد ملی: </b><?php echo $per->get_person_meta($p_id, 'father_mellicode'); ?></td>
					<td><b>تلفن همراه پدر: </b><?php echo $per->get_person_meta($p_id, 'father_mobile'); ?></td>
				</tr>
			</table>
			<hr>
			<table class="com-table">
				<tr><th colspan="6"><h4 class="text-center">مشخصات مادر:</h4></th></tr>
				<tr>
					<td><b>نام مادر: </b><?php echo $per->get_person_meta($p_id, 'mother_name'); ?> &nbsp&nbsp</td>
					<td><b>شغل مادر: </b><?php echo $per->get_person_meta($p_id, 'mother_job'); ?> &nbsp&nbsp</td>
					<td><b>تحصیلات مادر: </b><?php echo $per->get_person_meta($p_id, 'mother_edu'); ?> &nbsp&nbsp</td>
					<td><b>تاریخ تولد: </b><?php echo $per->get_person_meta($p_id, 'mother_birthday'); ?> &nbsp&nbsp</td>
					<td><b>تاریخ ازدواج: </b><?php echo $per->get_person_meta($p_id, 'marry_date'); ?> &nbsp&nbsp</td>
					<td><b>تلفن همراه مادر: </b><?php echo $pr->per_number($per->get_person_meta($p_id, 'mother_mobile')); ?> &nbsp&nbsp</td>
				</tr>
			</table>
			<hr>
			<table class="com-table">
				<tr><th colspan="3"><h4 class="text-center titr">اطلاعات تماس:</h4></th></tr>
				<tr>
					<td><b>آدرس منزل: </b><?php echo $pr->per_number($per->get_person_meta($p_id, 'home_address')); ?></td>
					<td><b>تلفن منزل: </b><?php echo $pr->per_number($per->get_person_meta($p_id, 'home_phone')); ?></td>
					<td><b>کودک شما با چه کسی زندگی می کند؟: </b><?php echo $per->get_person_meta($p_id, 'who_lived'); ?></td>
				</tr>
			</table>
			<hr>
			<table class="com-table">
				<tr><th colspan="6"><h4 class="text-center titr">آشناها:</h4></th></tr>
				<tr>
					<td><b>نام آشنا ۱: </b><?php echo $per->get_person_meta($p_id, 'familar_name1'); ?></td>
					<td><b>نسبت آشنا ۱: </b><?php echo $per->get_person_meta($p_id, 'familar_rel1'); ?></td>
					<td><b>تلفن تماس ۱: </b><?php echo $pr->per_number($per->get_person_meta($p_id, 'familar_phone1')); ?></td>
					<td><b>نام آشنا ۲: </b><?php echo $per->get_person_meta($p_id, 'familar_name2'); ?></td>
					<td><b>نسبت آشنا ۲: </b><?php echo $per->get_person_meta($p_id, 'familar_rel2'); ?></td>
					<td><b>تلفن تماس ۲: </b><?php echo $pr->per_number($per->get_person_meta($p_id, 'familar_phone2')); ?></td>
				</tr>
			</table>
			<hr>
			<table class="com-table">
				<tr>
					<td><b>آیا کودک شما به خوراکی یا داروی خاصی حساسیت دارد؟ </b><?php echo $per->get_person_meta($p_id, 'sensetive'); ?></td>
				</tr>
			</table>
			<hr>
			<p class="text-left">امضاء و اثر انگشت ولی نوآموز <br> تاریخ <?php echo $pr->per_number(jdate('Y/m/d')); ?></p>
			</div>
			<?php
			$p_id = $_GET['p_id'];
			$fullname = $per->get_person_name($p_id);
			$father = $per->get_person_meta($p_id, 'father_name');
			$mother = $per->get_person_meta($p_id, 'mother_name');
			?>
			<div class="page a4">
			<h1 class="titr text-center">تعهدنامه:</h1>
			<p class="koodak">آقای <?php echo $father; ?> و خانم <?php echo $mother; ?> ولی نوآموز <?php echo $fullname; ?>، لطفا پس از مطالعه و قبول قوانین و مقررات این مرکز، برگه را امضاء و اثرانگشت نمایید.</p>
			<div class="koodak"><?php echo $opt->get_option('roles'); ?></div>
			<br>
			<p class="text-left">امضاء و اثر انگشت ولی نوآموز <br> تاریخ <?php echo $pr->per_number(jdate('Y/m/d')); ?></p>
		</div>
		<div class="text-center no-print">
			<?php
			$p_commitment = $db->get_var_query("select p_commitment from person where p_id = $p_id");
			if($p_commitment > 0){ ?>
				<button class="btn btn-success btn-lg">تعهدنامه در تاریخ <?php echo $pr->per_number(str_replace('-', '/', $p_commitment)); ?> گرفته شده</button>
				<a href="person.php" class="btn btn-info btn-lg">بازگشت</a>
				<button class="btn btn-primary btn-lg" type="button" onclick="window.print()">چاپ تعهدنامه</button>
			<?php
			} else { ?>
			<form action="" method="post" onSubmit="if(!confirm('آیا از انجام این عملیات اطمینان دارید؟')){return false;}">
				<button class="btn btn-danger btn-lg" name="set">تایید دریافت تعهدنامه</button>
				<a href="person.php" class="btn btn-info btn-lg">بازگشت</a>
				<button class="btn btn-primary btn-lg" type="button" onclick="window.print()">چاپ تعهدنامه</button>
			</form>
			<?php
			}
			?><br><br>
		</div>
	</body>
</html>