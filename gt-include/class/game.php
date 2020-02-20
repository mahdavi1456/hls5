<?php

class game
{

    public function load_game($g_id)
    {
        $db = new database();
        $person = new person();
        $prime = new prime();
        $opt = new option();
        $gdate = new gdate();
        $pack = new package();
        $price = new price();
        $factor = new factor();
        $adj = new adjective();
		$offer = new offer();

        $p_id = $db->get_var_query("select p_id from game where g_id = $g_id");
		
		$p_fullname = $person->get_person_name($p_id);
        $p_mobile = $person->get_person_mobile($p_id);

        $this->set_end($g_id);
        ?>
		<div id="printarea">
        <table class="no-screen table text-center  table-bordered">
            <tr>
                <td class="titr"><h3><?php echo $opt->get_option('opt_name'); ?></h3></td>
            </tr>
        </table>
        <table class="table text-center table-bordered">
            <tr>
                <th colspan="6" class="text-center"><h5><b>صورت حساب:</b> <a
                                href="<?php echo $person->get_person_link($p_id); ?>"
                                target="_blank"><?php echo $p_fullname; ?></a> - <b> موبایل:</b> <?php echo $prime->per_number($p_mobile); ?></h5></th>
            </tr>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">شروع</th>
                <th class="text-center">پایان</th>
                <th class="text-center">مدت زمان</th>
                <th class="text-center">تعداد</th>
                <th class="text-center">وضعیت</th>
            </tr>
            <?php
            $sql2 = "select * from game_meta where g_id = $g_id";
            $res2 = $db->get_select_query($sql2);
            $j = 1;
            $total = 0;
			$total_price = 0;
            $total_vip = 0;
			$total_vip_price = 0;
            $total_extra = 0;
			$extra_time = 0;
			$used_sharj = 0;
			$login_price = 0;
			$offer_price = 0;
			$total_all_prices = 0;

			foreach ($res2 as $row2) { ?>
                <tr>
                    <td><?php echo $prime->per_number($j); ?></td>
                    <td><?php echo $prime->per_number($row2['gm_time']); ?></td>
                    <td><?php echo $prime->per_number($row2['gm_time_end']); ?></td>
                    <td>
                        <?php
                        $diff = ($gdate->new_diff($row2['gm_time'], $row2['gm_time_end'])) * $row2['gm_value'];
                        if ($row2['gm_key'] != "pause" && $row2['gm_key'] != "vip") {
                            $total += $gdate->convert_per_to_min($diff);
                        }
                        if ($row2['gm_key'] == "vip") {
                            $total_vip += $gdate->convert_per_to_min($diff);
                        }
                        echo $prime->per_number($gdate->new_convert_time($diff));
                        ?>
                    </td>
                    <td><?php echo $prime->per_number($row2['gm_value']); ?></td>
                    <td>
                        <?php
                        if ($row2['gm_key'] == "count") {
                            echo "تعداد";
                        }
                        if ($row2['gm_key'] == "pause") {
                            echo "توقف";
                        }
                        if ($row2['gm_key'] == "play") {
                            echo "ادامه";
                        }
                        if ($row2['gm_key'] == "vip") {
                            echo "ویژه";
                        }
                        ?>
                    </td>
                </tr>
                <?php
                $j++;
            }
            ?>
        </table>
		<?php
		$p_expire = $db->get_var_query("select p_expire from person where p_id = $p_id");
        $p_pack = $db->get_var_query("select p_pack from person where p_id = $p_id");
        $p_sharj = $db->get_var_query("select p_sharj from person where p_id = $p_id");

        $now = jdate('Y-m-d');
		
        if ($p_expire == "" || $p_expire == 0) {
            $diff = 0;
        } else {
            $diff = $gdate->timeDiff($p_expire, $now);
        }
		
        if ($p_pack > 0 && $diff > 0) {
			?>
			<table class="table text-center table-bordered koodak">
				<tr>
					<th class="text-center">شارژ استفاده شده:</th>
					<td colspan="2" class="text-center"><h3><?php echo $gdate->convert_min_to_hour($total); ?></h3></td>
				</tr>
				<tr>
					<th class="text-center">شارژ قبل از ورود</th>
					<th class="text-center">بسته</th>
					<th class="text-center">تاریخ اعتبار</th>
				</tr>
				<tr>
					<td><?php echo $prime->per_number($gdate->convert_minute($p_sharj)); ?></td>
					<td><?php echo $prime->per_number($pack->get_package_name($p_pack)); ?></td>
					<td><?php echo $prime->per_number($p_expire); ?></td>
				</tr>
			</table>
			<?php
			if($total >= $p_sharj) {
				$extra_time = abs($total - $p_sharj);
				$used_sharj = $p_sharj;
				$total = 0;
				$total_price = 0;
				?>
				<table class="table table-bordered">
					<tr>
						<th class="text-center">جمع عادی:</th>
						<td class="text-center"><h3><?php echo $gdate->convert_min_to_hour($extra_time); ?></h3></td>
						<th class="text-center">مبلغ:</th>
						<td class="text-center">
							<h3><?php echo $prime->per_number(number_format($price->calc_normal_price($extra_time))); ?></h3>
						</td>
					</tr>
					<tr>
						<th colspan="2" class="text-center">جمع کل:</th>
						<td colspan="2"
							class="text-center">
							<h3><?php echo $prime->per_number(number_format($price->calc_normal_price($total) + $price->calc_vip_price($total_vip) + $price->calc_normal_price($extra_time)));; ?></h3></td>
					</tr>
				</table>
			<?php
				$total_extra = $price->calc_normal_price($extra_time);
			} else {
				$used_sharj = $total;
				$total = 0;
				$total_price = 0;
			}
			$total_all_prices = $price->calc_normal_price($extra_time) + $price->calc_vip_price($total_vip);
		} else {
			$free_time = $opt->get_option('free_time');
            if (($total + $total_vip) <= $free_time) { ?>
                <br>
                <div class="no-print col-md-12">
                    <div class="no-print text-center alert alert-info">محاسبه رایگان تا
                        <b><?php echo $prime->per_number($opt->get_option('free_time')); ?></b> دقیقه
                    </div>
				</div>
                <?php
            } else {
				$total_price = $price->calc_normal_price($total);
				$total_vip_price = $price->calc_vip_price($total_vip);
			?>
			<table class="table table-bordered">
				<tr>
					<th class="text-center">جمع عادی:</th>
					<td class="text-center"><h3><?php echo $gdate->convert_min_to_hour($total); ?></h3></td>
					<th class="text-center">مبلغ:</th>
					<td class="text-center"><h3><?php echo $prime->per_number(number_format($total_price)); ?></h3></td>
				</tr>
				<tr>
					<th class="text-center">جمع ویژه:</th>
					<td class="text-center"><h3><?php echo $gdate->convert_min_to_hour($total_vip); ?></h3></td>
					<th class="text-center">مبلغ:</th>
					<td class="text-center">
						<h3><?php echo $prime->per_number(number_format($total_vip_price)); ?></h3></td>
				</tr>
				
				<?php
				$login_price = $price->calc_login_price($total + $total_vip);
				if($login_price > 0) { ?>
				<tr>
					<th colspan="2" class="text-center">نرخ ورودی: </th>
					<th colspan="2" class="text-center"><h3><?php echo $prime->per_number(number_format($login_price)); ?></h3></th>
				</tr>
				<?php
				} else {
					$login_price = 0;
				}
				
				$total_all_prices = $total_price + $total_vip_price;
				$g_offer_code = $db->get_var_query("select g_offer_code from game where g_id = $g_id");
				if($g_offer_code > 0) {
					$offer_price = $offer->calc_offer($g_offer_code, $total_all_prices);
					?>
				<tr>
					<th colspan="2" class="text-center">تخفیف: </th>
					<th colspan="2" class="text-center"><h3><?php echo $prime->per_number(number_format($offer_price)); ?></h3></th>
				</tr>
				<?php
				} else {
					$offer_price = 0;
				} ?>
					
				<tr>
					<th colspan="2" class="text-center">جمع کل:</th>
					<td colspan="2" class="text-center">
						<h3><?php echo $prime->per_number(number_format($total_price + $total_vip_price + $login_price - $offer_price)); ?></h3>
					</td>
				</tr>
			</table>
        <?php
			}
		}
        
        $total_shop = $factor->shop_factor($p_id, 0);
			
        //total_shop is ready for use
		
		$total_all_prices += $total_shop;
		
        $opt->load_sign();
        $adj->load_adjective($g_id);
        
		$m = new modal();
		?>
		</div>
        <div class="col-md-12">
            <div class="row">
                <div class="no-print col-4 text-center"><br>
                    <button id="start-pay" class="btn btn-success btn-lg" data-toggle="modal" data-target="#pay_modal">پرداخت</button>
                </div>
                <?php $m->show_modal("pay_modal", "ثبت پرداخت", "pay", $g_id, $total_all_prices - $offer_price + $login_price); ?>
				
                <div class="no-print col-4 text-center"><br>
                    <button id="print" class="btn btn-info btn-lg">چاپ</button>
                </div>
                <div class="no-print col-4 text-center"><br>
                    <button id="set-out" class="btn btn-danger btn-lg"
                            data-g_id="<?php echo $g_id; ?>"
							data-total="<?php echo $total; ?>"
                            data-total_vip="<?php echo $total_vip; ?>"
                            data-extra="<?php echo $extra_time; ?>"
							data-total_price="<?php echo $total_price; ?>"
                            data-total_vip_price="<?php echo $price->calc_vip_price($total_vip); ?>"
                            data-extra_price="<?php echo $price->calc_normal_price($extra_time); ?>"
							data-used_sharj="<?php echo $used_sharj; ?>"
							data-login_price="<?php echo $login_price; ?>"
                            data-total_shop="<?php echo $total_shop; ?>"
							data-offer="<?php echo $offer_price; ?>">ثبت خروج</button>
                </div>
            </div>
            <br>
        </div>
        <?php
    }


    public function new_change($g_id, $gm_key, $gm_value)
    {
        $db = new database();
        $gd = new gdate();
		
        $gm_date = $gd->jdate('Y-m-d');
        $gm_time = date('H:i:s');
        $sql = "insert into game_meta(g_id, gm_key, gm_value, gm_date, gm_time) values($g_id, '$gm_key', '$gm_value', '$gm_date', '$gm_time');";
        $db->ex_query($sql);
    }

    public function set_end($g_id)
    {
        $db = new database();

        $sql = "select gm_id from game_meta where g_id = $g_id order by gm_id desc limit 1";
        $gm_id = $db->get_var_query($sql);
        $gm_time_end = jdate('H:i');
        $sql_update = "update game_meta set gm_time_end = '$gm_time_end' where gm_id = $gm_id";
        $db->ex_query($sql_update);
    }

    public function set_change($g_id, $gm_key, $gm_value)
    {
        $db = new database();

        $this->set_end($g_id);
        $gm_time = jdate('H:i');
        $gm_date = jdate('Y/m/d');
        $sql = "insert into game_meta(g_id, gm_key, gm_value, gm_date, gm_time) values($g_id, '$gm_key', '$gm_value', '$gm_date', '$gm_time')";
        $db->ex_query($sql);
    }

}