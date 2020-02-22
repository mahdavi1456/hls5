<?php

class person
{
    public function get_person_name($p_id)
    {
        $db = new database();

        $res = $db->get_select_query("select p_name, p_family from person where p_id = $p_id");
        if (count($res) > 0) {
            return $res[0]['p_name'] . " " . $res[0]['p_family'];
        } else {
            return "نامعتبر";
        }
    }

    public function get_person_mobile($p_id)
    {
        $db = new database();

        $res = $db->get_select_query("select p_mobile from person where p_id = $p_id");
        if (count($res) > 0) {
            return $res[0]['p_mobile'];
        } else {
            return "نامعتبر";
        }
    }

    public function get_person_meta($p_id, $pm_meta)
    {
        $db = new database();

        $sql = "select pm_value from person_meta where p_id = $p_id and pm_meta = '$pm_meta'";
        $res = $db->get_var_query($sql);
        if ($res) {
            return $res;
        } else {
            return "";
        }
    }

    public function save_person_meta($p_id, $pm_meta, $pm_value)
    {
        $db = new database();

        if ($pm_meta != "p_id" && $pm_value != "") {
            $check = $db->get_select_query("select * from person_meta where p_id = $p_id and pm_meta = '$pm_meta'");
            if (count($check) > 0) {
                $db->ex_query("update person_meta set pm_value = '$pm_value' where pm_meta = '$pm_meta' and p_id = $p_id");
            } else {
                $db->ex_query("insert into person_meta(p_id, pm_meta, pm_value) values($p_id, '$pm_meta', '$pm_value')");
            }
        }
    }

    public function get_person_link($p_id)
    {
        return "payment.sql?p_id=" . $p_id . "&show-all=";
    }

    function get_person_status($p_id)
    {
		
		$total_all1 = 0;
		$total_all2 = 0;
		$total_all3 = 0;
        $db = new database();
		$res1 = $db->get_select_query("select * from game where p_id = $p_id");
		if(count($res1) > 0) {
			foreach($res1 as $row) {
				$total_all1 += $row['g_total_price'] + $row['g_total_vip_price'] + $row['g_extra_price'] + $row['g_login_price'] + $row['g_total_shop'] - $row['g_offer_price'];
			}
		}
		
		$res2 = $db->get_select_query("select * from payment where p_id = $p_id");
		if(count($res2) > 0) {
			foreach($res2 as $row) {
				$total_all2 += $row['pa_price'];
			}
		}
		
		$res3 = $db->get_select_query("select * from factor where p_id = $p_id");
		if(count($res3) > 0) {
			foreach($res3 as $row) {
				$total_all3 += $row['pr_price'];
			}
		}
		
       /* $bp_total = $db->get_var_query("select sum(pk_price) from package inner join buy_package on package.pk_id = buy_package.pk_id where p_id = $p_id");
        $f_total = $db->get_var_query("select sum(pr_price) from factor where p_id = $p_id and f_status = 1");
        $h_total = $db->get_var_query("select sum(g_price) from game where p_id = $p_id");
        $used_total = $bp_total + $f_total + $h_total;
        $p_total = $db->get_var_query("select sum(pa_price) from payment where p_id = $p_id");
        $o_total = $db->get_var_query("select sum(pa_offer) from payment where p_id = $p_id");
        $t = $p_total - $used_total; */
		$t = $total_all2 - ($total_all1 + $total_all3);
        return $t;
    }

    function calc_pay_status($p_id)
    {
        $db = new database();
        $pr = new prime();
		$game_price = 0;
        //$pk_price = $db->get_var_query("select sum(pk_price) from package inner join person on package.pk_id = person.p_pack where p_id = $p_id");
        $factor = $db->get_var_query("select sum(pr_price) from factor where p_id = $p_id and f_status = 1");
        $game = $db->get_var_query("select * from game where p_id = $p_id");
		if(count($game) > 0) {
			foreach($game as $row)
			{
				$game_price += $row['g_total_price'] + $row['g_total_vip_price'] + $row['g_extra_price'] - $row['g_offer_price'];
			}
		}

        $used_total = $game_price + $factor;

        $p_total = $db->get_var_query("select sum(pa_price) from payment where p_id = $p_id");
		
        $t = $p_total - $used_total;

        if($t < 0)
            echo "<span style='background: red; color: #fff'>" . $pr->per_number(number_format($t)) . "</span>";
        else
            echo "<span style='background: #00e732; color: #fff'>" . $pr->per_number(number_format($t)) . "</span>";
    }



    public function create_person_form()
    {
		$u_id = $_SESSION['user_id'];
        ?>
        <div class="row">
            <div class="col-md-6">
                <label>نام</label>
                <input name="p_name" class="form-control" type="text" placeholder="نام..." value="">
            </div>
            <div class="col-md-6">
                <label>نام خانوادگی</label>
                <input id="p_family" name="p_family" class="form-control" type="text" placeholder="نام خانوادگی..." value="" autocomplete="off">
                <div class="family-search-result"></div>
            </div>
        </div><br>
        <div class="row">
            <div class="col-md-4">
                <label>موبایل</label>
                <input name="p_mobile" class="form-control" type="text" placeholder="09xxxxxxxxx" value="">
            </div>
            <div class="col-md-4">
                <label>تاریخ تولد</label>
                <input name="p_birth" class="form-control datepicker" type="text" autocomplete="off" placeholder="تاریخ تولد..." value="">
            </div>
            <div class="col-md-4">
                <label>جنسیت</label>
                <select name="p_gender" class="form-control">
                    <option value="1">پسر</option>
                    <option value="0">دختر</option>
                </select>
            </div>
        </div><br>
		<input type="hidden" name="u_id" value="<?php echo $u_id; ?>" >
		<input type="hidden" name="p_type" value="مشتری" >
        <div class="row">
            <div class="col-md-12 text-center">
                <button name="add-person" class="btn btn-success add-person">ثبت شخص</button>
            </div>
        </div>
		<input type="hidden" name="p_regdate" value="<?php echo jdate('Y-m-d'); ?>">
	<?php
    }

    public function create_person_extra_form($p_id)
    {
        ?>
        <input type="hidden" name="p_id" value="<?php echo $p_id; ?>">
        <label>مشخصات پدر:</label>
        <table class="table">
            <tr>
                <td>
                    <label>نام پدر</label>
                    <input name="father_name" type="text" class="form-control" placeholder="نام پدر" value="<?php echo $this->get_person_meta($p_id, 'father_name'); ?>">
                </td>
                <td>
                    <label>شغل پدر</label>
                    <input name="father_job" type="text" class="form-control" placeholder="شغل پدر" value="<?php echo $this->get_person_meta($p_id, 'father_job'); ?>">
                </td>
                <td>
                    <label>تحصیلات پدر</label>
                    <input name="father_edu" type="text" class="form-control" placeholder="تحصیلات پدر" value="<?php echo $this->get_person_meta($p_id, 'father_edu'); ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <label>تاریخ تولد</label>
                    <input name="father_birthday" type="text" class="form-control datepicker" placeholder="تاریخ تولد" value="<?php echo $this->get_person_meta($p_id, 'father_birthday'); ?>" autocomplete="off">
                </td>
                <td>
                    <label>کد ملی</label>
                    <input name="father_mellicode" type="text" class="form-control" placeholder="کد ملی" value="<?php echo $this->get_person_meta($p_id, 'father_mellicode'); ?>">
                </td>
                <td>
                    <label>شماره همراه</label>
                    <input name="father_mobile" type="text" class="form-control" placeholder="شماره همراه" value="<?php echo $this->get_person_meta($p_id, 'father_mobile'); ?>">
                </td>
            </tr>
        </table>
        <label>مشخصات مادر:</label>
        <table class="table">
            <tr>
                <td>
                    <label>نام مادر</label>
                    <input name="mother_name" type="text" class="form-control" placeholder="نام مادر" value="<?php echo $this->get_person_meta($p_id, 'mother_name'); ?>">
                </td>
                <td>
                    <label>شغل مادر</label>
                    <input name="mother_job" type="text" class="form-control" placeholder="شغل مادر" value="<?php echo $this->get_person_meta($p_id, 'mother_job'); ?>">
                </td>
                <td>
                    <label>تحصیلات مادر</label>
                    <input name="mother_edu" type="text" class="form-control" placeholder="تحصیلات مادر" value="<?php echo $this->get_person_meta($p_id, 'mother_edu'); ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <label>تاریخ تولد</label>
                    <input name="mother_birthday" type="text" class="form-control datepicker" placeholder="تاریخ تولد" value="<?php echo $this->get_person_meta($p_id, 'mother_birthday'); ?>" autocomplete="off">
                </td>
                <td>
                    <label>تاریخ ازدواج</label>
                    <input name="marry_date" type="text" class="form-control datepicker" placeholder="تاریخ ازدواج" value="<?php echo $this->get_person_meta($p_id, 'marry_date'); ?>" autocomplete="off">
                </td>
            </tr>
        </table>
        <label>اطلاعات تماس:</label>
        <table class="table">
            <tr>
                <td colspan="2">
                    <label>آدرس منزل</label>
                    <input name="home_address" type="text" class="form-control" placeholder="آدرس منزل" value="<?php echo $this->get_person_meta($p_id, 'home_address'); ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <label>تلفن منزل</label>
                    <input name="home_phone" type="text" class="form-control" placeholder="تلفن منزل" value="<?php echo $this->get_person_meta($p_id, 'home_phone'); ?>">
                </td>
                <td>
                    <label>تلفن همراه مادر</label>
                    <input name="mother_mobile" type="text" class="form-control" placeholder="تلفن همراه مادر" value="<?php echo $this->get_person_meta($p_id, 'mother_mobile'); ?>">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label>کودک شما با چه کسی زندگی می کند؟</label>
                    <textarea name="who_lived" class="form-control" placeholder="کودک شما با چه کسی زندگی می کند؟" value="<?php echo $this->get_person_meta($p_id, 'who_lived'); ?>"><?php echo $this->get_person_meta($p_id, 'who_lived'); ?></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <label>آیا کودک شما به خوراکی یا داروی خاصی حساسیت دارد؟</label>
                    <textarea name="sensetive" class="form-control" placeholder="آیا کودک شما به خوراکی یا داروی خاصی حساسیت دارد؟" value="<?php echo $this->get_person_meta($p_id, 'sensetive'); ?>"><?php echo $this->get_person_meta($p_id, 'sensetive'); ?></textarea>
                </td>
            </tr>
        </table>
        <label>آشناها:</label>
        <table class="table">
            <tr>
                <td>
                    <label>نام آشنا ۱</label>
                    <input name="familar_name1" type="text" class="form-control" placeholder="نام آشنا ۱" value="<?php echo $this->get_person_meta($p_id, 'familar_name1'); ?>">
                </td>
                <td>
                    <label>نسبت آشنا ۱</label>
                    <input name="familar_rel1" type="text" class="form-control" placeholder="نسبت آشنا ۱" value="<?php echo $this->get_person_meta($p_id, 'familar_rel1'); ?>">
                </td>
                <td>
                    <label>تلفن تماس ۱</label>
                    <input name="familar_phone1" type="text" class="form-control" placeholder="تلفن تماس ۱" value="<?php echo $this->get_person_meta($p_id, 'familar_phone1'); ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <label>نام آشنا ۲</label>
                    <input name="familar_name2" type="text" class="form-control" placeholder="نام آشنا ۲" value="<?php echo $this->get_person_meta($p_id, 'familar_name2'); ?>">
                </td>
                <td>
                    <label>نسبت آشنا ۲</label>
                    <input name="familar_rel2" type="text" class="form-control" placeholder="نسبت آشنا ۲" value="<?php echo $this->get_person_meta($p_id, 'familar_rel2'); ?>">
                </td>
                <td>
                    <label>تلفن تماس ۲</label>
                    <input name="familar_phone2" type="text" class="form-control" placeholder="تلفن تماس ۲" value="<?php echo $this->get_person_meta($p_id, 'familar_phone2'); ?>">
                </td>
            </tr>
        </table>
        <button class="btn btn-success" type="submit" name="save-person_meta">ذخیره اطلاعات</button>
    <?php
    }
	
	public function create_person_edit_form($p_id)
	{
		$db = new database();
		$u_id = $_SESSION['user_id'];
		$res = $db->get_select_query("select p_name, p_family, p_mobile, p_birth, p_gender from person where p_id = $p_id");
		if(count($res) > 0) {
			$p_name = $res[0]['p_name'];
			$p_family = $res[0]['p_family'];
			$p_mobile = $res[0]['p_mobile'];
			$p_birth = $res[0]['p_birth'];
			$p_gender = $res[0]['p_gender'];
		} else {
			$p_name = "";
			$p_family = "";
			$p_mobile = "";
			$p_birth = "";
			$p_gender = "";
		}
		?>
        <div class="row">
            <div class="col-md-6">
                <label>نام</label>
                <input name="p_name" class="form-control" type="text" placeholder="نام..." value="<?php echo $p_name; ?>">
            </div>
            <div class="col-md-6">
                <label>نام خانوادگی</label>
                <input id="p_family" name="p_family" class="form-control" type="text" placeholder="نام خانوادگی..." value="<?php echo $p_family; ?>" autocomplete="off">
                <div class="family-search-result"></div>
            </div>
        </div><br>
        <div class="row">
            <div class="col-md-4">
                <label>موبایل</label>
                <input name="p_mobile" class="form-control" type="text" placeholder="09xxxxxxxxx" value="<?php echo $p_mobile; ?>">
            </div>
            <div class="col-md-4">
                <label>تاریخ تولد</label>
                <input name="p_birth" class="form-control datepicker pdp-el" type="text" autocomplete="off" placeholder="تاریخ تولد..." value="<?php echo $p_birth; ?>">
            </div>
            <div class="col-md-4">
                <label>جنسیت</label>
                <select name="p_gender" class="form-control">
                    <option <?php if($p_gender == 1) echo "selected"; ?> value="1">پسر</option>
                    <option <?php if($p_gender == 0) echo "selected"; ?> value="0">دختر</option>
                </select>
            </div>
        </div><br>
		<input type="hidden" name="u_id" value="<?php echo $u_id; ?>" >
        <div class="row">
            <div class="col-md-12 text-center">
                <button name="update-person" class="btn btn-warning">ویرایش اطلاعات</button>
            </div>
        </div>
		<input type="hidden" name="p_id" value="<?php echo $p_id; ?>">
		<?php
	}

}