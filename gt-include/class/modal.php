<?php

class modal
{
    public function show_modal($id, $title, $type, $g_id = 0, $pa_price = 0)
    {
        $db = new database();
        ?>
        <div id="<?php echo $id; ?>" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <label class="modal-title"><?php echo $title; ?></label>
                    </div>
                    <div class="modal-body text-center">
                        <?php
                        switch ($type) {
                            case "login":
                                $this->login_modal();
                                break;
							case "login2":
                                $this->login_modal2();
                                break;
                            case "count":
                                $this->count_modal($g_id);
                                break;
                            case "vip":
                                $this->vip_modal($g_id);
                                break;
							case "offer":
                                $this->offer_modal($g_id);
                                break;
                            case "shop":
                            {
                                $p_id = $db->get_var_query("select p_id from game where g_id = $g_id");
								$this->shop_modal($p_id);
                                break;
                            }
							case "pay":
								$this->pay_modal($g_id, $pa_price);
								break;
							case "person":
								$this->person_modal();
								break;
							case "ajax_person":
								$this->ajax_person_modal();
								break;
							case "user_activity":
								$this->user_activity($g_id);
								break;
							case "course_ticket":
								$this->course_ticket();
								break;
						}
                        ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    public function login_modal()
    {
        $db = new database();
        ?>
        <div class="row">
            <div class="col-md-12 text-center">
                <label>ثبت لیست امانتی ها</label>
                <select id="g_adj" class="form-control select2" multiple="multiple"
                        style="width: 100%">
                    <?php
                    $res_a = $db->get_select_query("select * from adjective");
                    foreach ($res_a as $row_a) { ?>
                        <option><?php echo $row_a['ad_name']; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>
		<hr>
		<div class="row">
			<div class="col-md-12 text-center">
                <label>ثبت کارت</label>
                <input autofocus placeholder="جهت ورود کارت بزنید.." type="text" autocomplete="off" id="p_code" class="form-control" style="width: 100%">
			</div>
		</div>
        <br>
        <div class="row">
			<div id="login-p-name-container" class="col-md-6 text-center">
                <label>انتخاب شخص</label>
                <input type="text" placeholder="سه حرف اول فامیل..." autocomplete="off" id="p_family" class="form-control" style="width: 100%">
				<div class="family-search-result"></div>
				<input type="hidden" id="p_id">
				<!--select id="p_id" class="form-control select2">
					<?php
					/*$res = $db->get_select_query("select p_id, p_name, p_family from person");
					if(count($res) > 0) {
						foreach($res as $row) {
							?>
							<option value="<?php echo $row['p_id']; ?>"><?php echo $row['p_name'] . " " . $row['p_family']; ?></option>
							<?php
						}
					}*/
					?>
				</select-->
			</div>
            <div class="col-md-6">
                <label>تعداد</label>
                <select id="g_count" name="g_count" class="form-control">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select>
            </div>
			<div class="col-md-6">
                <label>ساعت ورود</label>
                <input id="g_in" name="g_in" class="form-control" value="<?php echo jdate('H:i'); ?>" type="text" placeholder="ساعت ورود...">
            </div>
            <div class="col-md-6">
                <label>نوع ورود</label>
                <select id="g_type" name="g_type" class="form-control">
                    <option value="خانه بازی">خانه بازی</option>
                    <option value="کافی نت">کافی نت</option>
                    <option value="مهدکودک ساعتی">مهدکودک ساعتی</option>
                </select>
            </div>
        </div>
        <br>
        <button id="set-desktop-login" class="btn btn-success">ثبت ورود</button>
        <br>
        <div id="set-desktop-login-result"></div>
		<?php
    }


	public function login_modal2()
    {
		$u_id = $_SESSION['user_id'];
		$db = new database();
        ?>
        <div class="row">
            <div class="col-md-6">
                <label>نام</label>
                <input id="p_name" name="p_name" class="form-control" type="text" placeholder="نام...">
            </div>
            <div class="col-md-6">
                <label>نام خانوادگی</label>
                <input id="p_family1" name="p_family1" class="form-control" type="text" placeholder="نام خانوادگی...">
            </div>
        </div><br>
        <div class="row">
            <div class="col-md-4">
                <label>موبایل</label>
                <input id="p_mobile" class="form-control" type="text" placeholder="09xxxxxxxxx">
            </div>
            <div class="col-md-4">
                <label>تاریخ تولد</label>
                <input id="p_birth" class="form-control datepicker" type="text" autocomplete="off" placeholder="تاریخ تولد...">
            </div>
            <div class="col-md-4">
                <label>جنسیت</label>
                <select id="p_gender" class="form-control">
                    <option value="1">پسر</option>
                    <option value="0">دختر</option>
                </select>
            </div>
        </div><br>
		<input type="hidden" id="u_id" value="<?php echo $u_id; ?>" >
		<input type="hidden" id="p_regdate" value="<?php echo jdate('Y-m-d'); ?>">
		<hr>
        <div class="row">
            <div class="col-md-6">
                <label>نوع ورود</label>
                <select id="g_type1" name="g_type1" class="form-control">
                    <option value="خانه بازی">خانه بازی</option>
                    <option value="کافی نت">کافی نت</option>
                    <option value="مهدکودک ساعتی">مهدکودک ساعتی</option>
                </select>
            </div>
			<div class="col-md-6">
                <label>ساعت ورود</label>
                <input id="g_in" name="g_in" class="form-control" value="<?php echo jdate('H:i'); ?>" type="text" placeholder="ساعت ورود...">
            </div>
			<div class="col-md-6 text-center">
                <label>ثبت لیست امانتی ها</label>
                <select id="g_adj1" class="form-control select2" multiple="multiple"
                        style="width: 100%">
                    <?php
                    $res_a = $db->get_select_query("select * from adjective");
                    foreach ($res_a as $row_a) { ?>
                        <option><?php echo $row_a['ad_name']; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
			 <div class="col-md-6">
                <label>تعداد</label>
                <select id="g_count1" name="g_count1" class="form-control">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select>
            </div>
        </div>
        <br>
        <button id="set-desktop-login2" class="btn btn-success">ثبت ورود</button>
        <br>
        <div id="set-desktop-login-result2"></div>
		<?php
    }
	
    public function shop_modal($p_id)
    {
        $db = new database();

        $items = $db->get_select_query("select * from product");
        foreach ($items as $item) { ?>
            <button style="margin-bottom: 5px;" data-pid="<?php echo $p_id; ?>"
                    class="btn btn-warning btn-lg set-pro-to-cart"
                    value="<?php echo $item['pr_id']; ?>"><?php echo $item['pr_name']; ?></button>
            <?php
        } ?>
        <hr>
        <div id="set-factor-result<?php echo $p_id; ?>"></div>
        <?php
    }

    public function count_modal($g_id)
    {
        $db = new database();

        $gm_g_count = $db->get_var_query("select gm_value from game_meta where gm_key = 'count' and g_id = $g_id order by gm_id DESC limit 1");
        ?>
        <label>تعداد</label>
        <select class="form-control gm_g_count" data-g_id="<?php echo $g_id; ?>">
            <option <?php if ($gm_g_count == 1) echo "selected"; ?> value="1">1</option>
            <option <?php if ($gm_g_count == 2) echo "selected"; ?> value="2">2</option>
            <option <?php if ($gm_g_count == 3) echo "selected"; ?> value="3">3</option>
            <option <?php if ($gm_g_count == 4) echo "selected"; ?> value="4">4</option>
            <option <?php if ($gm_g_count == 5) echo "selected"; ?> value="5">5</option>
            <option <?php if ($gm_g_count == 6) echo "selected"; ?> value="6">6</option>
            <option <?php if ($gm_g_count == 7) echo "selected"; ?> value="7">7</option>
            <option <?php if ($gm_g_count == 8) echo "selected"; ?> value="8">8</option>
            <option <?php if ($gm_g_count == 9) echo "selected"; ?> value="9">9</option>
            <option <?php if ($gm_g_count == 10) echo "selected"; ?> value="10">10</option>
        </select>
        <?php
    }

    public function vip_modal($g_id)
    {
        $db = new database();

        $gm_vip_res = $db->get_select_query("select gm_value, gm_key from game_meta where g_id = $g_id order by gm_id DESC limit 1");
        $gm_vip_count = $gm_vip_res[0]['gm_value'];
        $gm_vip_key = $gm_vip_res[0]['gm_key'];
        if ($gm_vip_key == "count") {
            $sel = 0;
        } else {
            $sel = $gm_vip_count;
        }
        ?>
        <label>تعداد</label>
        <select class="form-control gm_vip_count" data-g_id="<?php echo $g_id; ?>">
            <option <?php if ($sel == 0) echo "selected"; ?> value="0">0</option>
            <option <?php if ($sel == 1) echo "selected"; ?> value="1">1</option>
            <option <?php if ($sel == 2) echo "selected"; ?> value="2">2</option>
            <option <?php if ($sel == 3) echo "selected"; ?> value="3">3</option>
            <option <?php if ($sel == 4) echo "selected"; ?> value="4">4</option>
            <option <?php if ($sel == 5) echo "selected"; ?> value="5">5</option>
            <option <?php if ($sel == 6) echo "selected"; ?> value="6">6</option>
            <option <?php if ($sel == 7) echo "selected"; ?> value="8">7</option>
            <option <?php if ($sel == 8) echo "selected"; ?> value="9">8</option>
            <option <?php if ($sel == 9) echo "selected"; ?> value="10">9</option>
            <option <?php if ($sel == 10) echo "selected"; ?> value="10">10</option>
        </select>
        <?php
    }
	
	public function offer_modal($g_id)
    {
		$db = new database();
		
		$current_offer = $db->get_var_query("select g_offer_code from game where g_id = $g_id");
		?>
		<form action="" method="post">
			<label>کد تخفیف</label>
			<select name="offer" class="form-control select2" style="width: 100%" onchange="this.form.submit()">
				<option value="0">-</option>
				<?php
				$res_offer = $db->get_select_query("select * from offer order by o_code asc");
				if (count($res_offer) > 0) {
					foreach ($res_offer as $row_offer) { ?>
						<option <?php if($row_offer['o_id'] == $current_offer) echo 'selected'; ?> value="<?php echo $row_offer['o_id']; ?>"><?php echo $row_offer['o_code']; ?></option>
						<?php
					}
				}
				?>
			</select>
			<input type="hidden" name="g_id" value="<?php echo $g_id; ?>">
		</form>
		<?php
	}
	
	public function pay_modal($g_id = 0, $pa_price = 0)
	{
		$db = new database();
		
		$pa_details = $db->get_var_query("select g_type from game where g_id = $g_id");
		$p_id = $db->get_var_query("select p_id from game where g_id = $g_id"); ?>
		<div class="row">
			<input type="hidden" id="pay_p_id" value="<?php echo $p_id; ?>">
			<div class="col-md-6 col-sm-12 col-xs-12">
				<label>نوع پرداخت</label>
				<select id="pa_type" class="form-control">
					<option value="کارت">کارت</option>
					<option value="نقد">نقد</option>
				</select>
			</div>
			<div class="col-md-6 col-sm-12 col-xs-12">
				<label>مبلغ</label>
				<input style="direction: ltr;" type="text" class="form-control" id="pa_price" value="<?php echo $pa_price; ?>">
			</div>
			<input type="hidden" id="pa_details" value="<?php echo $pa_details; ?>"><br>
		</div>
		<div class="col-12">
			<br><button id="pay" class="btn btn-success">ثبت پرداخت</button>
		</div>
		<div class="col-12">
			<br><div id="pay-result"></div>
		</div>
		<?php
	}
	
	public function person_modal()
	{
        $person = new person();
        ?>
		<form action="" method="post">
			<?php $person->create_person_form(); ?>
		</form>
		<?php
	}
	
	public function user_activity($g_id)
	{
		$db = new database();
		
		$pa_details = $db->get_var_query("select g_type from game where g_id = $g_id");
		$p_id = $db->get_var_query("select p_id from game where g_id = $g_id");
		?>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12 text-center">
                <label>لطفا کارت بزنید</label>
                <input autofocus type="text" class="form-control text-center" id="u_code" placeholder="لطفا در این قسمت کارت خود را بزنید" style="width: 100%">
            </div><br>
			<div class="col-12">
				<br><button id="set-activity" class="btn btn-success">ثبت</button>
			</div>
			<div class="col-12">
				<div id="set-activity-result"></div>
			</div>
        </div>
		<?php
	}
	
	public function course_ticket()
	{
		$db = new database();
		
		?>
		<form action="" method="post">
			<div class="row">
				<div class="col-md-6 col-sm-12 col-xs-12 text-center">
					<label>کارگاه <span class="red">*</span></label>
					<select name="c_id" id="buy_ticket_c_id" class="form-control select2" style="width: 100%">
						<option value="0">-</option>
						<?php
						$list = $db->get_select_query("select * from course order by c_id desc");
						if(count($list) > 0) {
							foreach($list as $l) { ?>
							<option value="<?php echo $l['c_id']; ?>"><?php echo $l['c_name']; ?></option>
							<?php
							}
						}
						?>
					</select>
				</div>
				<div class="col-md-6">
					<label>نام شرکت کننده <span class="red">*</span></label>
					<input type="text" name="ct_name" class="form-control">
				</div>
			</div><br>
			<div class="row">
				<div class="col-md-4">
					<label>مبلغ <span class="red">*</span></label>
					<input type="number" id="ct_price" name="ct_price" class="form-control" readonly>
				</div>
				<div class="col-md-4">
					<label>تخفیف</label>
					<input type="number" name="ct_disprice" class="form-control" value="0">
				</div>
				<div class="col-md-4">
					<label>تعداد <span class="red">*</span></label>
					<input type="number" name="ct_num" class="form-control" value="1">
				</div>
			</div><br>
			<div class="row">
				<div class="col-12">
					<button name="add-course_ticket" class="btn btn-success">ثبت بلیط</button>
				</div>
			</div>
			<input type="hidden" name="ct_date" value="<?php echo jdate('Y/m/d'); ?>">
		</form>
		<?php
	}

}